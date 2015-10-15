<?php
//this handles the price list object data and other globals
//it holds the objects
//it looks for the objects if they exist
//it creates them if not
class PricelistDataGroup
{
		public $main;

 		public $vendorname="";
 		public $vendor=null;
		public $date="";
		public $pricelistform=null;
		public $pricelistname="";
		public $pricelistexists=false;
		public $pricelist=null;
		public $quotearrays=array();
		public $cellstrings="";

		public function __construct($main)
		{
			$this->main=$main;
			$this->pricelist=new Pricelist();
			$this->pricelistform=new PricelistForm($this->pricelist);
			$this->quotearrays=array();
			//$this->vendor=new Vendor();
		}
/*
		public function getQuoteArray($productname)
		{
			return $this->quotearrays[$productname];
		}
		public function createQuoteArrays()
		{
   		foreach($this->pricelist->getQuotes() as $quote)
   		{
   			$productname=$quote->getProduct()->getName();
   			if(!array_key_exists($productname,$this->quotearrays))
   			{
   				$this->quotearrays[$productname]=array(
																		'product'=>$quote->getProduct(),
																		'buy'=>null,
																		'sell'=>null,
																		);
   			}
   			//if quote is sellquote
				if($quote->getMine())
				{
					$this->quotearrays[$productname]["buy"]=$quote;
				}
				//if quote is buyquote
				else
				{
					$this->quotearrays[$productname]["sell"]=$quote;
				}
   		}
		}*/
		public function validate()
		{
			if($this->pricelistname=="")$this->main->errors[]="No pricelist name";
			if($this->vendorname=="")$this->main->errors[]="No vendor name";
			if($this->date=="")$this->main->errors[]="No date";
		}
    private function fetchById($pricelist_id)
    {
			  $this->pricelist = Fetcher::fetchOne("Pricelist",array('id'=>$pricelist_id));
				$this->hydrate();
    }
    private function fetchByText($cellstrings)
    {
				//scan textinput for pricelist name
				foreach($cellstrings as $index=>$line)
				{
					if(strtolower($line[0])=="pricelist" or strtolower($line[0])=="pricelistname")
						$this->pricelistname=$line[1];
					if(strtolower($line[0])=="vendor" or strtolower($line[0])=="vendorname")
						$this->vendorname=$line[1];
					if(strtolower($line[0])=="date" or strtolower($line[0])=="date")
						$this->date=$line[1];
				}
				//# scan textinput for pricelist name

				$this->vendor=Fetcher::fetchOne("Vendor",array('name'=>'"'.$this->vendorname.'"'));
				$pricelist=Fetcher::fetchOne("Pricelist",array('name'=>'"'.$this->pricelistname.'"'));

				//pricelist in database: update
				if($pricelist)
				{
					//save everything
					$this->pricelist=$pricelist;
					$this->hydrate();
				}
				else
				{
					//create new pricelist
					$this->pricelist=new Pricelist();
					$this->pricelist->setName($this->pricelistname);
					if($this->vendor)
						$this->pricelist->setVendorId($this->vendor->getId());
					$this->pricelist->setDate($this->date);
					$this->hydrate();
				}
    }
    private function hydrate($overwritevendor=false)
    {
    	//fill vars from $this->pricelist
			$this->pricelistname=$this->pricelist->getName();
			$this->pricelistexists=true;

			//if vendor is empty or is to be overwritten
			if(!$this->vendor or $overwritevendor)
			{
				$this->vendor=$this->pricelist->getVendor();
				$this->vendorname=$this->vendor->getName();
			}

			if(!$this->date)
				$this->date=$this->pricelist->getDate();

			$this->pricelistform=new PricelistForm($this->pricelist);

			//create table of quotes
			//$this->createQuoteArrays();
    }
		public function processById($id) //this happens on get
		{
			  $this->pricelist = Fetcher::fetchOne("Pricelist",array('id'=>$id));
				$this->hydrate();

				//this needs to happen after the pricelist is loaded
			  $this->main->inputstring=$this->pricelist->getQuickInputString();
		}
    public function process(&$cellstrings,$request) //this happens on post
    {
			if($request->getParameter("id"))
				$this->fetchById($request->getParameter("id"));
			else 
			  $this->fetchByText($cellstrings);

			$this->validate();
    }
    public function save()
    {
    	//if exists, update
			if($this->pricelist)
			{
				$this->pricelist->update(array(
																	'vendor_id'=>$this->vendor->getId(),
																	'date'=>$this->date,
																));
			}
    	//else create
			else
			{
				$this->pricelist=MyModel::create("Pricelist",array(
																	'name'=>$this->pricelistname,
																	'vendor_id'=>$this->vendor->getId(),
																	'date'=>$this->date,
																));

			}
    }
		public function processEmpty()
		{
    	$this->pricelist=new Pricelist();
    	$this->main->inputstring=$this->pricelist->getQuickInputString();
		}
		//-----------------------------------------------------------------------------
    public function getInputString()
    {
    	return $this->pricelist->getQuickInputStringBasic();
    }
		
}
/*
program flow:
	processById //this happens on get: products come from quotes
		load pricelist from database
		fill variables
	
	process: //this happens on post: products come from textinput
		if id given, fetch from database by id
		else if textinput data found, fetch from database by name

		fetchById():
			fetch pricelist object by Id
			fetch vendor object from pricelist object
			hydrate() // fill in all other data variables, including quotes, using fetched / created data objects
	

		fetchByText():
			go through each line
			when line with correct key word (vendor, date, pricelistname) is found
				save data in proper place
			go fetch objects from database
			if pricelist object does not exist, 
				create
				hydrate() // fill in all other data variables, 
					//including quotes, using fetched / created data objects

				hydrate():
				//createQuoteArrays()
				//getQuoteArray()


	save data:
		if exists, update
		else create

	output inputstring:
		output pricelist input string

validate:
	if no vendor, cannot save
	if no pricelist name, cannot save
	if no date, cannot save
	

Tests:
get: id in url: widgets show data
get: no id in url: show blank textinput format

post: id in form, name in textinput: textinput overrides database data
post: no id in form, name in textinput: textinput overrides database data
post: id in form, no name in textinput: database data holds sway
post: no id in form, no name in textinput: nothing


Relationships:
 - 

*/

