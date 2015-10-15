<?php

require_once dirname(__FILE__).'/../lib/accountGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/accountGeneratorHelper.class.php';

/**
 * account actions.
 *
 * @package    sf_sandbox
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountActions extends autoAccountActions
{
  public function executeViewbydate(sfWebRequest $request)
  {
    $this->redirect("account/view?id=".$request->getParameter("id")."&startdate=".$request->getParameter("startdate")."&enddate=".$request->getParameter("enddate"));
  }
  public function executeView(sfWebRequest $request)
  {
    $this->account = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->account);
    $this->startdate=$request->getParameter("startdate")?$request->getParameter("startdate"):MyDateTime::today()->getstartofmonth()->tomysql();
    $this->enddate=$request->getParameter("enddate")?$request->getParameter("enddate"):MyDateTime::today()->getendofmonth()->tomysql();

    $startentry=new AccountEntry();
    $startentry->setDate($this->startdate);
    $this->startdateform=new AccountentryForm($startentry);
    
    $endentry=new AccountEntry();
    $endentry->setDate($this->enddate);
    $this->enddateform=new AccountentryForm($endentry);

    //$accountentries=$account->getAccountEntriesDesc();
    $this->accountentries=$this->account->getAccountEntriesDescByDate($this->startdate,$this->enddate);
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->account = new account();
    $this->account->setDate(MyDate::today());
    $this->form = $this->configuration->getForm($this->account);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $account = $form->save();
        $account->calc($account->getDate());
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $account)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@account_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect("account/view?id=".$account->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  public function executeCalc(sfWebRequest $request)
  {
    $this->account = $this->getRoute()->getObject();
    $this->account->calc($this->account->getDate());
    $this->redirect($request->getReferer());
    
  }
  public function executeStats(sfWebRequest $request)
  {
    /*
      SELECT *
      FROM `account` , `product`
      WHERE product.monitored = true
      AND account.currentqty <= account.quota
    */
    $this->accounts=Doctrine_Query::create()
        ->from('Account s, s.Product p, s.Warehouse w')
        ->where('p.monitored = true')
        ->andWhere('s.currentqty <= s.quota')
        ->execute();
  }
}
