<?php

require_once dirname(__FILE__).'/../lib/stockentryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stockentryGeneratorHelper.class.php';

/**
 * stockentry actions.
 *
 * @package    sf_sandbox
 * @subpackage stockentry
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockentryActions extends autoStockentryActions
{
  public function executeNew(sfWebRequest $request){$this->redirect($request->getReferer());}
  public function executeEdit(sfWebRequest $request){$this->redirect($request->getReferer());}
  public function executeUpdate(sfWebRequest $request){$this->redirect($request->getReferer());}
  public function executeList(sfWebRequest $request){$this->redirect($request->getReferer());}
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $requestparam=$request->getParameter('stockentry');
    $stock=StockTable::fetchById($requestparam['stock_id']);

    $qty=$requestparam['qty'];
    $date=$requestparam['date']['year']."-".$requestparam['date']['month']."-".$requestparam['date']['day'];
    //$ref_class=$requestparam['ref_class'];
    //$ref_id=$requestparam['ref_id'];
    $type=$requestparam['type']!=""?$requestparam['type']:'Adjustment';
    //$priority=0;
    $description=$requestparam['description'];

    if($qty==0)
      $this->redirect('home/error?msg="Invalid Qty"');


    $stockentry=$stock->addEntry($date, $qty, null, null ,$type,$description);

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $stockentry)));

      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('stock/view?id='.$stockentry->getstockId());
    }
    else
    {
      if($form['qty']->getError())
        $this->redirect('home/error?msg="Invalid Qty: '.$qty.'"');
      if($form['date']->getError())
        $this->redirect('home/error?msg="Invalid Date: '.$date.'"');

      //$this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $stockentry=$this->getRoute()->getObject();
    $stock=$stockentry->getStock();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($stockentry->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    //$stock->calc($stockentrydate);
    $this->redirect('stock/view?id='.$stock->getId());
  }
}

