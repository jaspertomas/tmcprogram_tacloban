<?php
class QuoteDataGroup
{
		public $main;
		public $pricelist;
		public $quotearrays=array();

		public function __construct($main)
		{
			$this->main=$main;
			$this->pricelist=$main->pricelistdata->pricelist;
			$this->productids=array();
		}

		public function getQuoteArray($productname)
		{
			if(array_key_exists($productname, $this->quotearrays))
				return $this->quotearrays[$productname];
		}
		public function createQuoteArrays()
		{
			//obtain product list from product data group
			//scan product list for product ids
			//query database for quote objects using product ids
			//fill variables with object results, unless specified in textinput


			//create array containing ids of all products in productdata items
			$productids=array();
			$productnames=array();
			foreach($this->main->productdata->items as $productarray)
			{
				if($productids[]=$productarray["object"])
					$productids[]=$productarray["object"]->getId();

					$productname=$productarray["name"];
   				$this->quotearrays[$productname]=array(
																			'buy'=>array(
																				'object'=>null,
																				'price'=>0,
																				'discrate'=>"",
																				'discamt'=>0,
																				),
																			'sell'=>array(
																				'object'=>null,
																				'price'=>0,
																				'discrate'=>"",
																				'discamt'=>0,
																				),
																			);
			}
			//test: $productids have content array('productname'=>'id',...)
			//var_dump($productids);
			//die();

			//if none found, do nothing
    	if(count($productids)==0)return;

			$vendor_id=$this->main->pricelistdata->vendor->getId();



	    $query=Doctrine_Query::create()
	      ->from('Quote q, q.Product p, q.Vendor v, p.Producttype pt')
	      ->whereIn('q.product_id',$productids)
	      ->andWhere('q.vendor_id = '.$vendor_id)
	      ->orderBy("p.name");

	    //if pricelist exists in database 
	    if($this->main->pricelistdata->pricelist->getId())
	      $query
				  ->andWhere('q.ref_class = "Pricelist"')
		      ->andWhere('q.ref_id = '.$this->main->pricelistdata->pricelist->getId());
	      
	    $buyquotes= $query->execute();

   		foreach($buyquotes as $quote)
   		{
   			$productname=$quote->getProduct()->getName();

   			//save data
				$this->quotearrays[$productname]["buy"]=array(
																										"object"=>$quote,
																										"price"=>$quote->getPrice(),
																										"discrate"=>$quote->getDiscrate(),
																										"discamt"=>$quote->getDiscamt(),
																										);
   		}

	    $query=Doctrine_Query::create()
	      ->from('Quote q, q.Product p, q.Vendor v, p.Producttype pt')
	      ->whereIn('q.product_id',$productids)
	      ->andWhere('q.vendor_id = '.SettingsTable::fetch("me_vendor_id"))
	      ->orderBy("p.name");

	    //if pricelist exists in database
	    if($this->main->pricelistdata->pricelist->getId())
	      $query
				  ->andWhere('q.ref_class = "Pricelist"')
		      ->andWhere('q.ref_id = '.$this->main->pricelistdata->pricelist->getId());
	      
	    $sellquotes= $query->execute();


   		foreach($sellquotes as $quote)
   		{
   			$productname=$quote->getProduct()->getName();

   			//save data
				$this->quotearrays[$productname]["sell"]=array(
																										"object"=>$quote,
																										"price"=>$quote->getPrice(),
																										"discrate"=>$quote->getDiscrate(),
																										"discamt"=>$quote->getDiscamt(),
																										);
   		}
		}
    private function processline($line)
    {
			//save data from parsed inputstring to array
			$productname=$line[1];

			if(trim($line[4])!="")$this->quotearrays[$productname]["buy"]["price"]=$line[4];
			if(trim($line[5])!="")$this->quotearrays[$productname]["buy"]["discrate"]=$line[5];
			if(trim($line[6])!="")$this->quotearrays[$productname]["buy"]["discamt"]=$line[6];
			if(trim($line[7])!="")$this->quotearrays[$productname]["sell"]["price"]=$line[7];
			if(trim($line[8])!="")$this->quotearrays[$productname]["sell"]["discrate"]=$line[8];
			if(trim($line[9])!="")$this->quotearrays[$productname]["sell"]["discamt"]=$line[9];
    }
    public function process(&$cellstrings,$request)
    {
    	//fetch existing quotes in database and 
    	//create quote array 
    	//according to all products in productarray, for specified vendor
			$this->createQuoteArrays();
    
			//for each line where first column says "product"
			foreach($cellstrings as $index=>$line)
				if(strtolower(trim($line[0]))=="product")
				{
					$this->processline($line);
				}
    }
    public function save()
    {
    	if(count($this->quotearrays)==0)return;
    	
			foreach($this->quotearrays as $productname=>$productdata)
			{
				//foreach($productdata["buy"] as $i=>$v)echo $i;die();
				//check if buy/sell quote data by vendor exists
				//if buy exists, update
				if($productdata["buy"]["object"])
				{
					$productdata["buy"]["object"]->update(array(
																		'price'=>$productdata["buy"]["price"],
																		'discrate'=>$productdata["buy"]["discrate"],
																		'discamt'=>$productdata["buy"]["discamt"],
																	));
				}
				//if not, create
				else
				{
					$productdata["buy"]["object"]=QuoteTable::createOne(array(
																		'date'=>$this->main->pricelistdata->date,
																		'vendor_id'=>$this->main->pricelistdata->vendor->getId(),
																		'product_id'=>$this->main->productdata->items[$productname]["object"]->getId(),
																		'price'=>$productdata["price"],
																		'discrate'=>$productdata["discrate"],
																		'discamt'=>$productdata["discamt"],
																		'ref_class'=>"Pricelist",
																		'ref_id'=>$this->main->pricelistdata->pricelist->getId(),
																		'mine'=>0,
																	));
					$productdata["buy"]["object"]->calc();
				}
				//if sell exists, update
				if($productdata["sell"]["object"])
				{
					$productdata["sell"]["object"]->update(array(
																		'price'=>$productdata["sell"]["price"],
																		'discrate'=>$productdata["sell"]["discrate"],
																		'discamt'=>$productdata["sell"]["discamt"],
																	));
				}
				//if not, create
				else
				{
					$productdata["sell"]["object"]=QuoteTable::createOne(array(
																		'date'=>$this->main->pricelistdata->date,
																		'vendor_id'=>SettingsTable::fetch("me_vendor_id"),
																		'product_id'=>$this->main->productdata->items[$productname]["object"]->getId(),
																		'price'=>$productdata["sell"]["price"],
																		'discrate'=>$productdata["sell"]["discrate"],
																		'discamt'=>$productdata["sell"]["discamt"],
																		'ref_class'=>"Pricelist",
																		'ref_id'=>$this->main->pricelistdata->pricelist->getId(),
																		'mine'=>1,
																	));
					$productdata["sell"]["object"]->calc();
				}

			}
    }
		//-----------------------------------------------------------------------------
    public function getInputString($productname)
    {
    	$string="";
    	$quotearray=$this->getQuoteArray($productname);

    	$buyquote=$quotearray["buy"];
    	$sellquote=$quotearray["sell"];

			if($buyquote)
				$buystring=$buyquote["price"]."\t".$buyquote["discrate"]."\t".$buyquote["discamt"];
			else
				$buystring="\t\t\t";

			if($sellquote)
			{	
				$sellstring=$sellquote["price"]."\t".$sellquote["discrate"]."\t".$sellquote["discamt"];
			}
			else
				$sellstring="\t\t\t";

    	return $buystring."\t".$sellstring;
    }
}
/*
//customize please
program flow:

	data status on function call:
	$productdata filled with $items[]=array(name, description, category1, category2...)

	process inputstring:
		create quote array based on productdata items

	save data:
		foreach item
			if exists, update
			else if data exists, create object
			else do nothing

	output inputstring:
		let product data group fetch data as needed 
	

tests:
	case:
		textinput data exists, database data exists: output textinput data
	case:
		textinput data does not exist, database data exists: output database data
	case:
		textinput data exists, database data does not exist: output textinput data 
	case:
		textinput data does not exist, database does not exist: output no data
*/

