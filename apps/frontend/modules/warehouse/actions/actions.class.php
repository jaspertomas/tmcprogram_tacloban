<?php

require_once dirname(__FILE__).'/../lib/warehouseGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/warehouseGeneratorHelper.class.php';

/**
 * warehouse actions.
 *
 * @package    sf_sandbox
 * @subpackage warehouse
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class warehouseActions extends autoWarehouseActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->warehouse = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->warehouse);

    $this->stocks=Doctrine_Query::create()
        ->from('Stock s, s.Product p')
        ->orderBy('p.name')
      	->where('p.monitored = 1')
      	->andWhere('s.warehouse_id = '.$this->warehouse->getId())
      	->execute();
  }
  public function executeViewall(sfWebRequest $request)
  {
    $this->warehouse = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->warehouse);
  }
}
