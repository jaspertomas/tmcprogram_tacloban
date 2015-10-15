<?php

require_once dirname(__FILE__).'/../lib/stockGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stockGeneratorHelper.class.php';

/**
 * stock actions.
 *
 * @package    sf_sandbox
 * @subpackage stock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockActions extends autoStockActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->stock = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->stock);
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->stock = new stock();
    $this->stock->setDate(MyDate::today());
    $this->form = $this->configuration->getForm($this->stock);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $stock = $form->save();
        $stock->calc($stock->getDate());
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $stock)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@stock_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect("stock/view?id=".$stock->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  public function executeCalc(sfWebRequest $request)
  {
    $this->stock = $this->getRoute()->getObject();
    $this->stock->calc($this->stock->getDate());
    $this->redirect($request->getReferer());
    
  }
  public function executeStats(sfWebRequest $request)
  {
    /*
      SELECT *
      FROM `stock` , `product`
      WHERE product.monitored = true
      AND stock.currentqty <= stock.quota
    */
    $this->stocks=Doctrine_Query::create()
        ->from('Stock s, s.Product p, s.Warehouse w')
        ->where('p.monitored = true')
        ->andWhere('s.currentqty <= s.quota')
        ->execute();
  }
}
