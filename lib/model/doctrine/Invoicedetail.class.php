<?php

/**
 * Invoicedetail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Invoicedetail extends BaseInvoicedetail
{
  public $stock=null;
  public $stockentry=null;
  public function calc()
  {
    //if($this->getPrice()==0)$this->setDefaultPrice();

    $discamt=$this->getDiscamt();
    $discrate=$this->getDiscrate();
    $discrate=str_replace(","," ",$discrate);
    $discrate=str_replace(";"," ",$discrate);
    $discratearray=explode(" ",$this->getDiscrate());
    
    //----invoice fixed price with discount system---------------
    /*
    //set price to maxbuyprice, 
    //set discamt to difference between maxbuyprice and given price
    $givenprice=$this->getPrice();
    $product=$this->getProduct();
    $this->setPrice($product->getMaxsellprice());
    $this->setDiscamt($product->getMaxsellprice()-$givenprice);
    $discamt=$this->getDiscamt();
    */
    $this->setDiscamt(($this->getProduct()->getMaxsellprice()-$this->getPrice())*$this->getQty());
    //-------------------
    
    $gross=$this->getQty()*$this->getPrice();

    $net=$gross;

    //deduct discrate
    foreach($discratearray as $rate)
      $net=$net*(1-($rate/100));

    //deduct discamt
    //$net-=$discamt;

    //save
    $this->setTotal($net);
    $this->setUnittotal($net/$this->getQty());
  }
  public function updateStockentry()
  {
    //fetch stockentry
    $stockentry=$this->getStockentry();

    $stock=$stockentry->getStock();
    $qty=$this->getQty()*-1;
    
    //if data not the same
    if(
      $stockentry->getQty()!=$qty or 
      $stock->getProductId()!=$this->getProductId() 
    )
    {
			//if product id is different
			if($stock->getProductId()!=$this->getProductId())
			{
			  //delete, automatically adjust stock record
        $stockentry->delete();

        //create new entry properly in correct stock
        $ref_class="Invoicedetail";
        $ref_id=$this->getId();
        $date=$this->getInvoice()->getDate();
        $this->getStock()->addEntry($date, $qty, $ref_class, $ref_id);
			}
			//if only qty is different
			else
			{
			  $stockentry->setQty($qty);
			  $stockentry->setBalance(null);
			  $stockentry->save();
			  $stock->calcFromStockEntry($stockentry);
			}
    }
  }
  public function cascadeDelete()
  {
    $stockentry=$this->getStockentry();

    if($stockentry)$stockentry->delete();

    return $this->delete();
  }
  public function updateProduct()
  {
		//if price edited, find product quote attached to this invoicedetail, update, and product->calc()
  	$quote=$this->getQuote();
  	if($quote)
  	{
  		$detailproduct=$this->getProduct();
  		$quoteproduct=$quote->getProduct();
  		if(
				$quote->getPrice()!=$this->getPrice() or
				$quote->getDiscrate()!=$this->getDiscrate() or
				$quote->getDiscamt()!=$this->getDiscamt() or
				$quote->getProductId()!=$this->getProductId()
			)
			{
				$quote->setPrice($this->getPrice());
				$quote->setDiscrate($this->getDiscrate());
				$quote->setDiscamt($this->getDiscamt());
				$quote->setProductId($this->getProductId());
				$quote->calc(); //auto save
				$detailproduct->calcSalePrices();
				
				//if product changed, calc old product
				if($quoteproduct->getId()!=$detailproduct->getId())
					$quoteproduct->calcSalePrices();
			}
  	}
  	else
  	{
			//if none, see if product quote by vendor with similar pricing exists. 
			$quote=Fetcher::fetchOne("Quote",array('total'=>$this->getUnittotal(),'vendor_id'=>SettingsTable::fetch("me_vendor_id"),'product_id'=>$this->getProductId()));

			//if it doesn't exist, create it, and product->calc()
			if(!$quote)
			{
				QuoteTable::createOne(array(
					'date'=>$this->getInvoice()->getDate(),
					'price'=>$this->getPrice(),
					'discrate'=>$this->getDiscrate(),
					'discamt'=>$this->getDiscamt(),
					'vendor_id'=>SettingsTable::fetch("me_vendor_id"),
					'product_id'=>$this->getProductId(),
					'ref_class'=>"Invoicedetail",
					'ref_id'=>$this->getId(),
					'mine'=>1,
					));
				$this->getProduct()->calcSalePrices();
			}
  	}
  }
  function isCancelled(){return $this->getIsCancelled()==1;}
  function cascadeCancel()
  {
   	if($this->getQuote())
	   	$this->getQuote()->cancel();
   	if($this->getStockentry())
    	$this->getStockentry()->cancel();
    	
    $this->setIsCancelled(1);
    $this->save();
	}
  public function getStock($force=false)
  {
    if($this->stock==null or $force)
      $this->stock=StockTable::fetch(SettingsTable::fetch("default_warehouse_id"), $this->getProductId());
    return $this->stock;
  }
  public function getStockEntry($force=false)
  {
    if($this->stockentry==null or $force)
    {
      //fetch from database
     $stockentry= Doctrine_Query::create()
      ->from('Stockentry se')
      ->where('ref_class="Invoicedetail"')
    	->andWhere('se.is_cancelled = 0')
      ->andWhere('ref_id='.$this->getId())
      ->fetchOne();

    //does not exist in database
    if(!$stockentry)
    {
      if(!$this->getStock())
        $this->getStock();

      $qty=$this->getQty()*-1;
      $ref_class="Invoicedetail";
      $ref_id=$this->getId();
      $date=$this->getInvoice()->getDate();
      $stockentry=$this->stock->addEntry($date, $qty, $ref_class, $ref_id);
    }
   }
   return $stockentry;
  }
  public function getQuote()
  {
  	return Fetcher::fetchOne("Quote",array('ref_class'=>"\"Invoicedetail\"",'ref_id'=>$this->getId()));
  }
  public function getSimilarQuote()
  {
		return Fetcher::fetchOne("Quote",array('total'=>$this->getUnittotal(),'vendor_id'=>SettingsTable::fetch("me_vendor_id"),'product_id'=>$this->getProductId()));
  }
}