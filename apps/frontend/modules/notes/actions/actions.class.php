<?php

require_once dirname(__FILE__).'/../lib/notesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/notesGeneratorHelper.class.php';

/**
 * notes actions.
 *
 * @package    sf_sandbox
 * @subpackage notes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class notesActions extends autoNotesActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->notes = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->notes);
    $this->levels=$request->getParameter("levels");
    if($this->levels=="")$this->levels=5;
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->notes = new Notes();
    $this->notes->setParentId($request->getParameter("parent_id"));
    $this->form = $this->configuration->getForm($this->notes);
  }
  public function executeEdit(sfWebRequest $request)
  {
    $this->notes = $this->getRoute()->getObject();
    //prevent edit of home page
    if($this->notes->isHome())$this->redirect("notes/view?id=1");
    $this->form = $this->configuration->getForm($this->notes);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $notes = $form->save();
      
        //custom calculation
        $notes->getParent()->calc();
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $notes)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@notes_new?parent_id='.$notes->getParentId());
     }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('notes/edit?id='.$notes->getId());
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

    $parent=$this->getRoute()->getObject()->getParent();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->isRoot())
    {
      $this->getUser()->setFlash('error', 'Cannot delete root node');
    }
    elseif ($this->getRoute()->getObject()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect($request->getReferer());
  }
  public function executeMassoper(sfWebRequest $request)
  {
    $parent_id=$request->getParameter("parent_id");
    $parent=NotesTable::fetch($parent_id);
	  $children=$parent->getChildren();
	  $priority=$children[count($children)-1]->getPriority()+2;
    
  	$ids=$request->getParameter("ids");
  	
  	if($request->getParameter("submit")=="Copy")
  	{
    	foreach($ids as $id)
    	{
    	  $notes=NotesTable::fetch($id);
    	  $newnotes=$notes->copyNotes();

    	  $newnotes->setParentId($parent_id);
    	  $newnotes->setPriority($priority);$priority+=2;
    	  $newnotes->save();
    	}
  	}
  	else //move
  	{
    	foreach($ids as $id)
    	{
    	  $notes=NotesTable::fetch($id);
    	  $notes->setParentId($parent_id);
    	  $notes->setPriority($priority);$priority+=2;
    	  $notes->save();
    	}
  	}
  	$parent->calc();
    $this->redirect($request->getReferer());
  }
  public function executeSort(sfWebRequest $request)
  {
  	$priority= $request->getParameter("priority");
  	$id= $request->getParameter("id");
  	
    $note=NotesTable::fetch($id);

		if(!$note)$this->redirect("home/error?msg=Note with ID ".$id." not found");
    
    $parent=NotesTable::fetch($note->getParentId());

		$note->setPriority($priority);
		$note->save();
		$parent->calc();

		$this->redirect($request->getReferer());
    
  }
  public function executeAutogenchildren(sfWebRequest $request)
  {
    $notes=NotesTable::fetch($request->getParameter("id"));
    $notes->getName();

		$childrennames=explode("\n",$request->getParameter("text"));
		$priority=2;
		foreach($childrennames as $childname)
		{
			if(trim($childname)=="")continue;
		
			$child=new Notes();
			$child["name"]=$childname;
			$child["content"]=$childname;
			$child["parent_id"]=$notes->getId();
			$child["priority"]=$priority;
			$child->save();

			$priority+=2;
		}
		$this->redirect($request->getReferer());

    
  }
  public function executeSetstatus(sfWebRequest $request)
  {
    $notes=NotesTable::fetch($request->getParameter("id"));

    $notes->setStatus($request->getParameter("color"));
    $notes->save();

		$this->redirect($request->getReferer());
	}
}
