<?php

/**
 * Notes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Notes extends BaseNotes
{
  public function getParent()
  {
    return Doctrine_Query::create()
      ->from('Notes f')
      ->where('f.id='.$this->getParentId())
      ->fetchOne();
  }
  public function getChildren()
  {
    return Doctrine_Query::create()
      ->from('Notes f')
      ->where('f.parent_id='.$this->getId())
      ->andWhere('f.id!=1') //not root
      ->orderBy('f.priority')
      ->execute();
  }
  public function isHome()
  {
    return $this->getId()==1?true:false;
  }
  public function isRoot()
  {
    return $this->getId()==1?true:false;
  }
  public function renderContent()
  {
    switch($this->getType())
    {
      case "HTML":return $this->getContent();
      default:return htmlentities($this->getContent());
    }
  }
  public function getBreadcrumbs($action="view")
  {
    $array=array();
    $notes=$this;
    
    if($this->getId()=="")
      $array[]=" > New Notes";
    else
      $array[]=" > ".link_to($notes->getname(),"notes/".$action."?id=".$notes->getId());
    
    while(!$notes->isRoot())
    {
      $parent=$notes->getParent();
      $array[]=" > ".link_to($parent->getname(),"notes/".$action."?id=".$parent->getId());
      $notes=$parent;
    }
    $array=array_reverse($array);

    return implode(" ",$array);
  }
  public function calc()
  {
	  $children=$this->getChildren();
	  $this->prioritize($children);
  }
	private function prioritize($children)
	{
	  $priority=2;
	  foreach($children as $child)
	  {
	    $child->setPriority($priority);
	    $child->save();
	    $priority+=2;
	  }
	}
  public function copyNotes()
  {
  	  $newnotes=$this->copy();
  	  $newnotes->save();
  	  return $newnotes;
  }
}