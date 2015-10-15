<?php

require_once dirname(__FILE__).'/../lib/customerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/customerGeneratorHelper.class.php';

/**
 * customer actions.
 *
 * @package    sf_sandbox
 * @subpackage customer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customerActions extends autoCustomerActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->customer = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->invoice);
  }
  public function executeSearch(sfWebRequest $request)
  {
    $query=Doctrine_Query::create()
        ->from('Customer i')
      	->where('i.name like \'%'.trim($request->getParameter("searchstring")).'%\'')
        ->orderBy("i.name")
        ;

  	$results=$query->execute();
  	
  	if(count($results)==1)
  	{
            $this->customer=$results[0];
            $this->redirect("customer/view?id=".$this->customer->getId());
  	}
  	else
        {
            $this->customers=$results;
        }

  }
}
