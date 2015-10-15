<?php
//intention: preprocess (fetch and organize) producttypes in 3rd column
class ProductsFromProducttypeDataGroup
{
		public $main;
    public $items=array();

		//-----------------------------------------------------------------------------

		public function __construct($main)
		{
			$this->main=$main;
		}
		//-----------------------------------------------------------------------------
		//add producttypes from textdata to table
		private function processAddProduct($index,$line)
		{
			//save data from parsed inputstring to array
			$name=$line[1];

			//search database for producttype by name
			$producttype=Fetcher::fetchOne("Producttype",array('path'=>'"'.$name.'"'));

			//if not found
			if(!$producttype)return;

			$this->main->producttypedata->addProducttype($producttype);

			//ask the product data group to add each product in this producttype
			foreach($producttype->getProducts() as $product)
				$this->main->productdata->addProduct($product,$producttype);

		}
    public function process(&$cellstrings)
    {
			//where it says addproductfrom, insert products of specified producttype
			//for each line where first column says "add"
			foreach($cellstrings as $index=>$line)
				if(strtolower(trim($line[0]))=="add")
				{
					$this->processAddProduct($index,$line);
				}
    }

		//-----------------------------------------------------------------------------
    public function save()
    {
    }
		//-----------------------------------------------------------------------------
    public function getInputString()
    {
			return "";
    }
}
/*
program flow:
	process inputstring:
		foreach string in inputstring starting with "add"
			processAddProduct() // add products of producttypes specified in "add" section to productdatagroup

processAddProduct(): 		// add products of producttypes specified in "add" section to productdatagroup
	extract producttype name
	if producttype does not exist in array, 
		add
			add object details to array
	via ProductDataGroup
		foreach product in producttype
			add product data as item in ProductData $items array, with product name as index
			include product object if exists in database
				add object details to array if not specified in textdata


	save data: ~
	output inputstring: ~
	

tests:
case: if has add producttype
case: if has add producttype, producttype is misspelled
case: no add producttype

	if textinput contains "add\tproducttype path" and click "Test", 
		products in producttype will appear in text

*/

