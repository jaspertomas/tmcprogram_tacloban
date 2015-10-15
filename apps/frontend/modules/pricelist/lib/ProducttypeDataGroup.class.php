<?php
//intention: preprocess (fetch and organize) producttypes in 3rd column
class ProducttypeDataGroup
{
		public $main;
    public $items=array();

		//-----------------------------------------------------------------------------

		public function __construct($main)
		{
			$this->main=$main;
		}
		//-----------------------------------------------------------------------------
		//add producttypes from product section of textdata to table
		private function processProductLine($index,$line)
		{
			$name=$line[3];

    	if(array_key_exists($name,$this->items))return;

			//fetch if exists
			//$array=ProducttypeTable::followBreadCrumbsByNames($name," > ");
			$object=Fetcher::fetchOne("Producttype",array('path'=>'"'.$name.'"'));
			if($object)
				$this->items[$name]=array(
					'name'=>$object->getPath(),
					'description'=>$object->getDescription(),
					'category1'=>$object->getCategory1(),
					'category2'=>$object->getCategory2(),
					'category3'=>$object->getCategory3(),
					'category4'=>$object->getCategory4(),
					'category5'=>$object->getCategory5(),
					'category6'=>$object->getCategory6(),
					'category7'=>$object->getCategory7(),
					'category8'=>$object->getCategory8(),
					'category9'=>$object->getCategory9(),
					'category10'=>$object->getCategory10(),
					'object'=>$object,
					);
		}
		//add producttypes from textdata to table
		private function processLine($index,$line)
		{
			//save data from parsed inputstring to array
			$name=$line[1];

			//if this producttype is already in the array
			if(array_key_exists($name,$this->items))continue;

			//search database for producttype by name
			//$array=ProducttypeTable::followBreadCrumbsByNames($name," > ");
			//$object=count($array)?$array[count($array)-1]:null;
			$object=Fetcher::fetchOne("Producttype",array('path'=>'"'.$name.'"'));
			$this->items[$name]=array(
				'name'=>$name,
				//if textdata has detail, use that. Else use object detail if available. else none
				'description'=>$line[2]?$line[2]:($object?$object->getDescription():""),
				'category1'=>$line[3]?$line[3]:($object?$object->getCategory1():""),
				'category2'=>$line[4]?$line[4]:($object?$object->getCategory2():""),
				'category3'=>$line[5]?$line[5]:($object?$object->getCategory3():""),
				'category4'=>$line[6]?$line[6]:($object?$object->getCategory4():""),
				'category5'=>$line[7]?$line[7]:($object?$object->getCategory5():""),
				'category6'=>$line[8]?$line[8]:($object?$object->getCategory6():""),
				'category7'=>$line[9]?$line[9]:($object?$object->getCategory7():""),
				'category8'=>$line[10]?$line[10]:($object?$object->getCategory8():""),
				'category9'=>$line[11]?$line[11]:($object?$object->getCategory9():""),
				'category10'=>$line[12]?$line[12]:($object?$object->getCategory10():""),
				'object'=>$object,
				'from'=>"producttypesection",
				);
		}
    public function process(&$cellstrings)
    {
			foreach($cellstrings as $index=>$line)
				if(strtolower(trim($line[0]))=="producttype")
				{
					//if this producttype is already in the array
					if(array_key_exists($line[1],$this->items))continue; // * $line[1] = name

					$this->processLine($index,$line);
				}

    	//where it says product, load the producttype specified in the product
			//for each line where first column says "product"
			foreach($cellstrings as $index=>$line)
				if(strtolower(trim($line[0]))=="product")
				{
					$this->processProductLine($index,$line);
				}
    }

		//-----------------------------------------------------------------------------
    public function save()
    {
			foreach($this->items as $index=>$item)
			{
	    	//if exists, update
				if($item["object"])
				{
								$item["object"]->update($item);//$item is of type array['category1'=>...,]
				}
	    	//else create
				else
				{
					//create new producttype plus parents
					$heirarchy=ProducttypeTable::cascadeCreate($item["name"]);

					//update details for last node
					$item["object"]=$heirarchy[count($producttypes)-1];
					$item["object"]->update(array(
																			'description'=>$item["description"],
																			'category1'=>$item["category1"],
																			'category2'=>$item["category2"],
																			'category3'=>$item["category3"],
																			'category4'=>$item["category4"],
																			'category5'=>$item["category5"],
																			'category6'=>$item["category6"],
																			'category7'=>$item["category7"],
																			'category8'=>$item["category8"],
																			'category9'=>$item["category9"],
																			'category10'=>$item["category10"],
																			));
				}
			}
    }
		//--public functions---------------------------------------------------------------------------
    //for use by ProductsFromProducttype data group to add new producttype
    public function addProducttype($object)
    {
    	$name=$object->getPath();
			//if this producttype is already in the array
			if(array_key_exists($name,$this->items))return;

			//add to items
			$this->items[$name]=array(
				'name'=>$name,
				'description'=>@$line[2]?$line[2]:($object?$object->getDescription():""),
				'category1'=>@$line[3]?$line[3]:($object?$object->getCategory1():""),
				'category2'=>@$line[4]?$line[4]:($object?$object->getCategory2():""),
				'category3'=>@$line[5]?$line[5]:($object?$object->getCategory3():""),
				'category4'=>@$line[6]?$line[6]:($object?$object->getCategory4():""),
				'category5'=>@$line[7]?$line[7]:($object?$object->getCategory5():""),
				'category6'=>@$line[8]?$line[8]:($object?$object->getCategory6():""),
				'category7'=>@$line[9]?$line[9]:($object?$object->getCategory7():""),
				'category8'=>@$line[10]?$line[10]:($object?$object->getCategory8():""),
				'category9'=>@$line[11]?$line[11]:($object?$object->getCategory9():""),
				'category10'=>@$line[12]?$line[12]:($object?$object->getCategory10():""),
				'object'=>$object,
				);
    }
    public function getInputString()
    {
	  	$string=$this->main->pricelistdata->pricelist->getQuickInputStringProducttypeHeader();
			foreach($this->items as $index=>$item)
			{
				$string.="\nproducttype\t"
										.$item["name"]."\t"
										.$item["description"]."\t"
										.$item["category1"]."\t"
										.$item["category2"]."\t"
										.$item["category3"]."\t"
										.$item["category4"]."\t"
										.$item["category5"]."\t"
										.$item["category6"]."\t"
										.$item["category7"]."\t"
										.$item["category8"]."\t"
										.$item["category9"]."\t"
										.$item["category10"];
			}
			$string.="\n\n\n";
			return $string;
    }
}
/*
program flow:
	process inputstring:
		foreach string in inputstring starting with "producttype"
			processLine() // add producttype data as item in $items array
		foreach string in inputstring starting with "product"
			processProductLine(): // add producttypes specified in products section to items array

			processLine(): 		// add producttypes specified in producttypes section to $items array
				add producttype data as item in $items array, with producttype name as index
					include producttype object if exists in database
						add object details to array if not specified in textdata

			processProductLine(): // add producttypes specified in products section to items array
				extract producttype name
				if producttype does not exist in array, 
					add
						add object details to array

	save data:
		foreach item
			if exists, update object
			else 
				create producttype and all ancestors if necessary
				update producttype

	output inputstring:
		output header
		foreach item
			output string
		output footer (spacer)
	
Tests:
case: producttype in producttype section, and in product section
case: producttype in producttype section only
case: producttype in product section only
*/

