<?php

/**
 * home actions.
 *
 * @package    sf_sandbox
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  /*
		$producttypes = Doctrine_Query::create()
      ->from('Producttype p')
      ->execute();

  foreach($producttypes as $index=>$producttype)
  {
  	$producttype->calcPath();
  }

  /*
  //enter product prices
$array=array(
"Firstank GP 21 w/ base"=>2050,
"Firstank SP 21 w/ base"=>4800,
);
  //get each invoicedetail / podetail and get product->calc()
  foreach($array as $itemname=>$price)
  {
  	$date="2010-11-01";
		$product = Doctrine_Query::create()
      ->from('Product p')
      ->where('p.name = "'.$itemname.'"')
      ->fetchOne();
if(!$product){echo $itemname;die();}
				QuoteTable::createOne(array(
					'date'=>$date,
					'price'=>$price,
					'discrate'=>"15 10 5 5 5 5",
					'discamt'=>0,
					'vendor_id'=>115,
					'product_id'=>$product->getId(),
					'ref_class'=>"Pricelist",
					'ref_id'=>1
					));
				$product->calcPurchasePrices();
				QuoteTable::createOne(array(
					'date'=>$date,
					'price'=>$price,
					'discrate'=>"",
					'discamt'=>0,
					'vendor_id'=>SettingsTable::fetch("me_vendor_id"),
					'product_id'=>$product->getId(),
					'ref_class'=>"Pricelist",
					'ref_id'=>1,
					'mine'=>1,
					));
				$product->calcSalePrices();
  //    $product->setAutocalcsellprice(0);
//      $product->setAutocalcbuyprice(0);
      //$product->save();
      
  }*/
  	/*
		$stockentries = Doctrine_Query::create()
      ->from('Stockentry se')
      ->execute();

      foreach($stockentries as $stockentry)
      {
		$stock = Doctrine_Query::create()
      ->from('Stock s')
      ->where('s.id='.$stockentry->getStockId())
      ->fetchOne();
      if(!$stock)echo $stockentry->getId()." ";
      }


/*
    $records = Doctrine_Query::create()
      ->from('invoicedetail i')
      ->where('i.description like "%Kato Jack Pump 6 Strokes%"')
      ->execute();

    foreach($records as $record)
    {
      $record->setDescription(str_replace("Kato Jack Pump 6 Strokes","",$record->getDescription()));
      $record->save();
    }

  //*

		//display invoice ids with duplicate invnos
		$invoices = Doctrine_Query::create()
    	->select('i.invno')
      ->from('Invoice i')
      ->where('template_id=1')
      ->execute();
    foreach($invoices as $index=>$invoice)
    {
    	if(4==strlen($invoice->getInvno()))
    	{
    		$invoice->setTemplateId(4);
    		$invoice->save();
    	}
    }

/*    
	//display invoice_ids of orphan invoicedetails (without invoice)
		$invoices = Doctrine_Query::create()
    	->select('i.id')
      ->from('Invoice i')
      ->fetchArray();
      foreach($invoices as &$invoice)
      	$invoice=$invoice["id"];
      
    $invoicedetails = Doctrine_Query::create()
    	->select('id.invoice_id')
      ->from('Invoicedetail id')
      ->fetchArray();

      foreach($invoicedetails as $detail)
      {
      	if(array_search($detail["invoice_id"],$invoices)===false)
      		echo $detail["invoice_id"]."<br>";
      }//*/
      
    /*
    $records = Doctrine_Query::create()
      ->from('Invoicedetail id')
      ->where('product_id=0')
      ->execute();
    foreach($records as $record)
    {
      $product = Doctrine_Query::create()
        ->from('Product pr')
        ->where("pr.name='".str_replace("'","\'",$record->getDescription())."'")
        ->fetchOne();
      if($product)
      {
        $record->setProductId($product->getId());
        $record->save();
	    //echo $product->getId();
      }
    }
    //*/
	}
  public function executeError(sfWebRequest $request)
  {
  	$this->msg=$request->getParameter("msg");
  }
}
