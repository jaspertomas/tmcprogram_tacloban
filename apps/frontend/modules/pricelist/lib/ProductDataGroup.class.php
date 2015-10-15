<?php
/*
Data Structure:
				$this->items[$productname]=array(
					'name'
					'description'
					'producttypename'
					'category1'
					'category2'
					'category3'
					'category4'
					'category5'
					'category6'
					'category7'
					'category8'
					'category9'
					'category10'
					'object'
					'producttype'
					'producttypearray'

*/
class ProductDataGroup
{
		public $main;
		//init vars
    public $items=array();

		//---constructor------------------------------------------------------

		public function __construct($main)
		{
			$this->main=$main;
		}

		//---process function and helpers------------------------------------------------------

    private function processline($line)
    {
					//save data from parsed inputstring to array
					$productname=$line[1];
					$object=Fetcher::fetchOne("Product",array('name'=>'"'.$productname.'"'));
					$producttype=$this->main->producttypedata->items[$line[3]]["object"];
					
					$this->hydrate($productname, $line, $object, $producttype);
    }
    private function hydrate($productname, $line, $object, $producttype)
    {
    	if(!array_key_exists($productname,$this->items))
    	{
				$producttypename=$line[3]?$line[3]:($producttype?$producttype->getPath():"");
				$this->items[$productname]=array(
					'name'=>$productname,
					'description'=>@$line[2]?$line[2]:($object?$object->getDescription():""),
					'producttypename'=>@$producttypename,
					'category1'=>@$line[10]?$line[10]:($object?$object->getCategory1():""),
					'category2'=>@$line[11]?$line[11]:($object?$object->getCategory2():""),
					'category3'=>@$line[12]?$line[12]:($object?$object->getCategory3():""),
					'category4'=>@$line[13]?$line[13]:($object?$object->getCategory4():""),
					'category5'=>@$line[14]?$line[14]:($object?$object->getCategory5():""),
					'category6'=>@$line[15]?$line[15]:($object?$object->getCategory6():""),
					'category7'=>@$line[16]?$line[16]:($object?$object->getCategory7():""),
					'category8'=>@$line[17]?$line[17]:($object?$object->getCategory8():""),
					'category9'=>@$line[18]?$line[18]:($object?$object->getCategory9():""),
					'category10'=>@$line[19]?$line[19]:($object?$object->getCategory10():""),
					'object'=>$object,
					'producttype'=>$producttype,
					'producttypearray'=>$this->main->producttypedata->items[$producttypename],
					);
    	}
    }
    public function process(&$cellstrings)
    {
			//for each line where first column says "product"
			foreach($cellstrings as $index=>$line)
				if(strtolower(trim($line[0]))=="product")
				{
					$this->processline($line);
				}

			//get products that pricelistdata has quotes for, and add them here
			//$this->mergeProductsFromProducttypes();

			ksort($this->items);
    }
		//#---process function and helpers------------------------------------------------------
    public function save()
    {
			foreach($this->items as $index=>$data)
			{
	    	//if exists, update
				if($data["object"])
				{
					$data["object"]->update(array(
																						'description'=>$data["description"],
																						'producttype_id'=>$data["producttype"]->getId(),
																						'category1'=>$data["category1"],
																						'category2'=>$data["category2"],
																						'category3'=>$data["category3"],
																						'category4'=>$data["category4"],
																						'category5'=>$data["category5"],
																						'category6'=>$data["category6"],
																						'category7'=>$data["category7"],
																						'category8'=>$data["category8"],
																						'category9'=>$data["category9"],
																						'category10'=>$data["category10"],
																						));

				}
				else
				{
					$data["object"]=MyModel::create("Product",array(
																						'name'=>$data["name"],
																						'description'=>$data["description"],
																						'producttype_id'=>$this->main->producttypedata->items[$data["producttypename"]]["object"]->getId(),
																						'category1'=>$data["category1"],
																						'category2'=>$data["category2"],
																						'category3'=>$data["category3"],
																						'category4'=>$data["category4"],
																						'category5'=>$data["category5"],
																						'category6'=>$data["category6"],
																						'category7'=>$data["category7"],
																						'category8'=>$data["category8"],
																						'category9'=>$data["category9"],
																						'category10'=>$data["category10"],
																					));

				}

			}
    }
		//--public functions---------------------------------------------------------------------------
    //for use by Producttype data group to add contents of new producttypes
    public function addProduct($product,$producttype)
    {
					//save data from parsed inputstring to array
					$productname=$product->getName();
					//$quotes=$this->main->pricelistdata->getQuoteArray($productname);
					$this->items[$productname]=array(
						'name'=>$productname,
						'description'=>$product->getDescription(),
						'producttypename'=>$product->getProducttype()->getPath(),
						//'producttype'=>$product->getProducttype(),
						'category1'=>$product->getCategory1(),
						'category2'=>$product->getCategory2(),
						'category3'=>$product->getCategory3(),
						'category4'=>$product->getCategory4(),
						'category5'=>$product->getCategory5(),
						'category6'=>$product->getCategory6(),
						'category7'=>$product->getCategory7(),
						'category8'=>$product->getCategory8(),
						'category9'=>$product->getCategory9(),
						'category10'=>$product->getCategory10(),
						'object'=>$product,
						'producttype'=>$producttype,
						);
    }
    public function getInputString()
    {
	  	$string=$this->main->pricelistdata->pricelist->getQuickInputStringProductHeader();

			foreach($this->items as $index=>$item)
			{
				$quotearray=$this->main->quotedata->getQuoteArray($item["name"]);
				$this->items[$item["name"]]["buy"]=$quotearray["buy"];
				$this->items[$item["name"]]["sell"]=$quotearray["sell"];
				
				$string.="\nproduct\t"
										.$item["name"]."\t"
										.$item["description"]."\t"
										.$item["producttypename"]."\t"
										.$this->main->quotedata->getInputString($item["name"])."\t"
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
	public function getProducttypeArrayByProductName($productname)
	{
		$productarray=$this->items[$productname];
		return $this->main->producttypedata->items[$productarray["producttypename"]];
	}
    /*
	private function mergeProductsFromProducttypes()
	{
		//get quotearray from pricelistdata
		$quotearrays=$this->main->pricelistdata->quotearrays;

		//for each 
		foreach($quotearrays as $array)
		{
			//add to items
			$productname=$array["product"]->getName();
			$line=array("","","","","","","","","","","","","","","","","","","","","","","",);
			$object=$array["product"];
			$producttype=$object->getProducttype();

			$this->hydrate($productname, $line, $object, $producttype);
			
		}
		
	}*/
}
/*
program flow:
	process inputstring:
		foreach string in inputstring starting with "product"
			add product data as item in $items array, with product name as index
				include product object if found
					add object details to array if not specified in textdata
		merge producttypedatagroup's list of products to index

		mergeProductsFromProducttypes(): 
			obtain list of product names from producttypedatagroup
			for each, 
				if not yet in items
					add
			sort by key (ksort)

	save data:
		foreach item
			if exists, update
			else create

	output inputstring:
		output header
		foreach item
			fetch quote data from quote data group <------------
			output string, with quote data if available 
		output footer (spacer)
	


tests:
case: product specified, no producttype
case: producttype specified, no product specified
case: product specified and producttype specified, product belongs to producttype
case: product specified and producttype specified, product does not belong to product

output
	outputstring should be complete, and work if test is hit again.

mergeProductsFromProducttypes(): 
	add a producttype line and click "test"		
	the next screen should include all the products of that producttype
*/

