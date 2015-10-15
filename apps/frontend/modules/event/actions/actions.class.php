<?php

require_once dirname(__FILE__).'/../lib/eventGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/eventGeneratorHelper.class.php';

/**
 * event actions.
 *
 * @package    sf_sandbox
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends autoEventActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->event = new Event();

    //set Default Data
    $this->event->setParentClass($request->getParameter("parent_class"));
    $this->event->setParentId($request->getParameter("parent_id"));

    $parent = $this->event->getParent();

    //validate parent is not cancelled, do nothing
    if($parent->isCancelled())
    {
      $this->redirect("home/error?msg='Cannot create event. This transaction has been cancelled.'");
    }
    
    //validate parent is not fully paid
    if($this->event->getParentClass()=="Invoice")
    {
    		$invoice=$this->event->getParent();
    		if($invoice->getStatus()=="Paid")
    		{
      		//new invno not unique: error msg and quit
            $message="Invoice is fully paid";
            $this->getUser()->setFlash('error', $message);
            return $this->redirect($request->getReferer());
    		}
    }

    $this->event->setParentName($parent->getName());
    $this->event->setType($request->getParameter("type"));
    $this->event->setDate(MyDate::today());

    if(
      $request->getParameter("type")=="stockin" or
      $request->getParameter("type")=="stockout" or
      $request->getParameter("type")=="stocktrans"
    )
    {
      EventTable::generate($this->event);
      $this->redirect($request->getReferer());
    }

    
    $this->form = $this->configuration->getForm($this->event);
  }
  //modify processForm such that it posts / updates account entries
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $isnew=$form->getObject()->isNew();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $event = $form->save();
        $event->updateAccountentries();
        $event->updateParent();
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $event)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@event_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        if($event->getParentClass()=="Invoice")
          $this->redirect('invoice/events?id='.$event->getParentId());
        else if($event->getParentClass()=="Purchase")
          $this->redirect('purchase/events?id='.$event->getParentId());
        //
        else
          $this->redirect(array('sf_route' => 'event_edit', 'sf_subject' => $event));
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

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $object=$this->getRoute()->getObject();
    $parent=$object->getParent();
    

    if ($object->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    if(get_class($parent)=="Invoice" or get_class($parent)=="Purchase"){$parent->getUpdateChequedata();$parent->save();}

    $this->redirect($request->getReferer());
  }
}
