<?php

require_once dirname(__FILE__).'/../lib/invoicedetailGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/invoicedetailGeneratorHelper.class.php';

/**
 * invoicedetail actions.
 *
 * @package    sf_sandbox
 * @subpackage invoicedetail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class invoicedetailActions extends autoInvoicedetailActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->invoicedetail = new Invoicedetail();
    $invoice_id=$request->getParameter("invoice_id");
    $this->invoicedetail->setInvoiceId($invoice_id);
    $invoice=$this->invoicedetail->getInvoice();
    $this->invoicedetail->setQty(1);
    $this->invoicedetail->setDiscrate($invoice->getDiscrate());
    $this->form = $this->configuration->getForm($this->invoicedetail);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    //if barcode exists, extract product id and purchase no.
    $requestparams=$request->getParameter("invoicedetail");
    $barcode=$requestparams["barcode"];
    $product_code="";
    $product_id="";
    $pono="";
    
    //process barcode if exists
    if($barcode)
    {
      $barcode=str_pad($barcode,13,"0",STR_PAD_LEFT);
      $strlen=strlen($barcode);
      $product_id=substr($barcode,0,$strlen-6);
      $pono=substr($barcode,$strlen-6,5);
      $requestparams["product_id"]=$product_id;
    }
    else
    {
      $barcode=str_pad($requestparams["product_id"],7,"0",STR_PAD_LEFT)."00000";
      $barcode=MyBarcode::standardize($barcode);
      $requestparams["barcode"]=$barcode;
    }

    
    $form->bind($requestparams);
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $invoicedetail = $form->save();
        $invoice=$invoicedetail->getInvoice();
        if(!$invoice->isCancelled())
        {
		      $invoicedetail->updateProduct();
        }
        
        //if invoicedetail is edited while invoice is closed
        if($invoice->getIsTemporary()==0)
        {
		      $invoicedetail->updateStockentry();
        }
        
        //custom calculation
        if($invoicedetail->getDescription()=="")
          $invoicedetail->setDescription($invoicedetail->getProduct()->getDescription());
        $invoicedetail->calc();
        $invoicedetail->save();
      $invoice->calc();
      $invoice->save();
        
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $invoicedetail)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@invoicedetail_new?invoice_id='.$invoice->getId());
     }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('invoice/view?id='.$invoicedetail->getInvoiceId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $invoice=$this->getRoute()->getObject()->getInvoice();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->cascadeDelete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
      $invoice->calc();
      $invoice->save();
    }

    $this->redirect('invoice/view?id='.$invoice->getId());
  }
}
