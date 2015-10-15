<?php

require_once dirname(__FILE__).'/../lib/accountentryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/accountentryGeneratorHelper.class.php';

/**
 * accountentry actions.
 *
 * @package    sf_sandbox
 * @subpackage accountentry
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountentryActions extends autoAccountentryActions
{
  public function executeNew(sfWebRequest $request){$this->redirect($request->getReferer());}
  public function executeEdit(sfWebRequest $request){$this->redirect($request->getReferer());}
  public function executeUpdate(sfWebRequest $request){$this->redirect($request->getReferer());}
  public function executeList(sfWebRequest $request){$this->redirect($request->getReferer());}
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $requestparam=$request->getParameter('accountentry');
    $account=AccountTable::fetchById($requestparam['account_id']);

    $qty=$requestparam['qty'];
    $date=$requestparam['date']['year']."-".$requestparam['date']['month']."-".$requestparam['date']['day'];
    //$ref_class=$requestparam['ref_class'];
    //$ref_id=$requestparam['ref_id'];
    $type=$requestparam['type']!=""?$requestparam['type']:'Adjustment';
    //$priority=0;
    $description=$requestparam['description'];

    if($qty==0)
      $this->redirect('home/error?msg="Invalid Qty"');


    $accountentry=$account->addEntry($date, $qty, null, null ,$type,$description);

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $accountentry)));

      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('account/view?id='.$accountentry->getaccountId());
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

    $accountentry=$this->getRoute()->getObject();
    $account=$accountentry->getAccount();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($accountentry->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect($request->getReferer());
  }
}

