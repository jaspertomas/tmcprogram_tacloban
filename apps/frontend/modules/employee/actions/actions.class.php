<?php

require_once dirname(__FILE__).'/../lib/employeeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/employeeGeneratorHelper.class.php';

/**
 * employee actions.
 *
 * @package    sf_sandbox
 * @subpackage employee
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class employeeActions extends autoEmployeeActions
{
  public function executeProcessmgrpasswd(sfWebRequest $request)
  {
  	$oldpass=$request->getParameter("oldpass");
  	$newpass1=$request->getParameter("newpass1");
  	$newpass2=$request->getParameter("newpass2");
  	
  	if($oldpass=='')
  	{
        $message="Please enter old password";
        $this->getUser()->setFlash('error', $message,true);
        return $this->redirect($request->getReferer());
  	}
  	else if($newpass1=='')
  	{
        $message="Please enter new password";
        $this->getUser()->setFlash('error', $message,true);
        return $this->redirect($request->getReferer());
  	}
  	else if($newpass2=='')
  	{
        $message="Please enter new password twice";
        $this->getUser()->setFlash('error', $message,true);
        return $this->redirect($request->getReferer());
  	}
  	else if($newpass2!=$newpass1)
  	{
        $message="New passwords do not match";
        $this->getUser()->setFlash('error', $message,true);
        return $this->redirect($request->getReferer());
  	}
  	
    $setting=Doctrine_Query::create()
        ->from('Settings s')
      	->where('s.name = "manager_password"')
      	->fetchOne();
  	
  	if($setting->getValue()!=$oldpass)
  	{
        $message="Wrong password";
        $this->getUser()->setFlash('error', $message,true);
        return $this->redirect($request->getReferer());
  	}
  	else
  	{
  		$setting->setValue($newpass1);
  		$setting->save();
        $message="Manager password successfully changed";
        $this->getUser()->setFlash('msg', $message,true);
        return $this->redirect($request->getReferer());
  	}
  	
  	$this->redirect($request->getReferer());
  }
  public function executeMgrpasswd(sfWebRequest $request)
  {
    $this->setting=Doctrine_Query::create()
        ->from('Settings s')
      	->where('s.name = "manager_password"')
      	->fetchOne();
  }
}
