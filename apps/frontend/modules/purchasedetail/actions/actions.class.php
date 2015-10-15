<?php

require_once dirname(__FILE__).'/../lib/purchasedetailGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/purchasedetailGeneratorHelper.class.php';

/**
 * purchasedetail actions.
 *
 * @package    sf_sandbox
 * @subpackage purchasedetail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class purchasedetailActions extends autoPurchasedetailActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->purchasedetail = new Purchasedetail();
    $purchase_id=$request->getParameter("purchase_id");
    $this->purchasedetail->setPurchaseId($purchase_id);
    $purchase=$this->purchasedetail->getPurchase();
    $this->purchasedetail->setQty(1);
    $this->purchasedetail->setDiscrate($purchase->getDiscrate());
    $this->form = $this->configuration->getForm($this->purchasedetail);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $requestparamspurchase=$request->getParameter("purchase");
    $requestparams=$request->getParameter($form->getName());
    $barcoderoot=$requestparams["product_id"].str_pad($requestparamspurchase["pono"],5,"0",STR_PAD_LEFT);
    $requestparams["barcode"]=MyBarcode::standardize($barcoderoot);
    $form->bind($requestparams);
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $purchasedetail = $form->save();
        $purchasedetail->updateStockentry();
        $purchasedetail->updateProduct();
      
        //custom calculation
        if($purchasedetail->getDescription()=="")
          $purchasedetail->setDescription($purchasedetail->getProduct()->getDescription());
        $purchasedetail->calc();
        $purchasedetail->save();
        $purchase=$purchasedetail->getPurchase();
        $purchase->calc();
        $purchase->save();
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $purchasedetail)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@purchasedetail_new?purchase_id='.$purchase->getId());
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('purchase/view?id='.$purchasedetail->getPurchaseId());
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

    $purchase=$this->getRoute()->getObject()->getPurchase();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->cascadeDelete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $purchase->calc();
    $purchase->save();
    $this->redirect('purchase/view?id='.$purchase->getId());
  }
}
