<?php

/**
 * search actions.
 *
 * @package    sf_sandbox
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productsearchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->transaction_type=$request->getParameter("transaction_type");
    $this->transaction_id=$request->getParameter("transaction_id");

    $keywords=explode(" ",$request->getParameter("searchstring"));

		//search in name
    $query=Doctrine_Query::create()
        ->from('Product p')
        ->orderBy("p.name")
      	->where('p.id != 0')
      	//->andWhere('s.product_id = p.id')
      	//->andWhere('s.warehouse_id = '.SettingsTable::fetch('default_warehouse_id'))
      	;

    foreach($keywords as $keyword)
    	$query->andWhere("p.name LIKE '%".$keyword."%'");

		//search in description
  	$query->orWhere('p.id != 0')
      	//->andWhere('s.product_id = p.id')
      	//->andWhere('s.warehouse_id = '.SettingsTable::fetch('default_warehouse_id'))
      	;

    foreach($keywords as $keyword)
    	$query->andWhere("p.description LIKE '%".$keyword."%'");

  	$this->products=$query->execute();

    $productids=array();
  	foreach($this->products as $product)
      $productids[]=$product->getId();
  	
    $stocks=Doctrine_Query::create()
        ->from('Stock s')
      	->whereIn('s.product_id', $productids)
      	->andWhere('s.warehouse_id = '.SettingsTable::fetch('default_warehouse_id'))
      	->execute();
    $this->stockarray=array();
    foreach($stocks as $stock)
    {
      $this->stockarray[$stock->getProductId()]=$stock;
    }

  }
}
