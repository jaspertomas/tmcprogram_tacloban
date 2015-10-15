<?php

require_once dirname(__FILE__).'/../lib/pricelistGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pricelistGeneratorHelper.class.php';

/**
 * pricelist actions.
 *
 * @package    sf_sandbox
 * @subpackage pricelist
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pricelistActions extends autoPricelistActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->pricelist = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->pricelist);
  }
  /*
  Program flow:
  	case 1: open page, no data (get without id):
  		just display empty input text
  	case 2: open page, producttype id specified in url (get with id):
  		just display input text of specified pricelist
  	case 3: post: 
  		process input text and display 
  			parse inputstring
  			extract pricelist data from inputstring
  			extract producttype data from inputstring
  			extract product data from inputstring
  				extract quote data from inputstring

				if save button is clicked
					save pricelist data
					save producttype data
					save product data
						extract quote data

  			output new pricelist inputstring
  			output new producttype data inputstring
  			output new product data inputstring
  				output new quote data inputstring

  */
  public function executeQuickinput(sfWebRequest $request)
  {
		//this will only handle inputstring and parsing. 
		//All other functions will be delegated.

		//---initialize vars-------------------------------------------------------------------------------
		$this->linestrings=array();
		$this->cellstrings=array();
		$this->inputstring="";
		$this->errors=array();
		$this->messages=array();
		
		$this->pricelistdata=new PricelistDataGroup($this);
		$this->producttypedata=new ProducttypeDataGroup($this);
		$this->productdata=new ProductDataGroup($this);
		$this->quotedata=new QuoteDataGroup($this);
		$this->productsfromproducttypedata=new ProductsFromProducttypeDataGroup($this);

  	//---------case 1: if id given, method=get: load data object: [ok] ---------
  	//just display it
		if($request->getParameter("id") and $request->getMethod()=="GET")
		{
			$this->pricelistdata->processById($request->getParameter("id"));
		}
    //---------case 2: if empty (get), init vars but do nothing: [ok]---------
  	//show empty
		else if($request->getMethod()=="GET")
    {
			$this->pricelistdata->processEmpty();
    }
  	//---------case 3: if id given or not, method=post: load data object ---------
		else
		{
	    $this->inputstring=$request->getParameter("inputstring");
			$this->parse();

			$this->pricelistdata->process($this->cellstrings,$request);
			$this->producttypedata->process($this->cellstrings);
			$this->productdata->process($this->cellstrings,$this->producttypedata);
			$this->quotedata->process($this->cellstrings,$request);
			$this->productsfromproducttypedata->process($this->cellstrings,$this->producttypedata);
			

			if($request->getParameter("submit")=="Save" and count($this->errors)==0)
			{
				$this->pricelistdata->save();
				$this->producttypedata->save();
				$this->productdata->save();
				$this->quotedata->save();
			}

			//---update input string-----------------------------------------------------------------------
			$this->inputstring=
				$this->pricelistdata->getInputString().
				$this->producttypedata->getInputString().
				$this->productdata->getInputString();
		}
	}	
	private function parse()
	{
		$this->linestrings=explode("\n",$this->inputstring);
		$this->cellstrings=array();
		foreach($this->linestrings as $linestring)
		{
			$cellarray=explode("\t",$linestring);
			//trim each cell
			foreach($cellarray as &$cell)
				$cell=trim($cell);
			$this->cellstrings[]=$cellarray;
		}
	}
}



