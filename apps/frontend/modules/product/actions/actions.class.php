<?php

require_once dirname(__FILE__).'/../lib/productGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productGeneratorHelper.class.php';

/**
 * product actions.
 *
 * @package    sf_sandbox
 * @subpackage product
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productActions extends autoProductActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->product);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $isnew=$form->getObject()->isNew();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $product = $form->save();
        if($product->getDescription()=="")
        {
          $product->setDescription($product->getName());
          $product->save();
        }
        
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $product)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@product_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect(array('sf_route' => 'product_edit', 'sf_subject' => $product));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeSearch(sfWebRequest $request)
  {
    $this->searchstring = $request->getParameter("searchstring");
    $requestparams=$request->getParameter("invoicedetail");
    $this->product_id = $requestparams["product_id"];

    $this->warehouses=WarehouseTable::fetchAll();

    $this->products=array();
    
    if($this->searchstring!="")
    {
     $this->products = Doctrine_Query::create()
      ->from('Product p, p.Invoicedetail id, id.Invoice inv, inv.Customer c, p.Purchasedetail pd, pd.Purchase po, po.Vendor v')
      ->orderBy('p.name')
      ->where('p.name like "%'.$this->searchstring.'%"')
      ->execute();
    }
    else
    {
      if($this->product_id)
     $this->products = Doctrine_Query::create()
      ->from('Product p')
      ->where('p.id ='.$this->product_id)
      ->execute();
    }
  }
  public function executeInvoicesearch(sfWebRequest $request)
  {
    $this->searchstring = $request->getParameter("searchstring");
    $requestparams=$request->getParameter("invoicedetail");
    $this->product_id = $requestparams["product_id"];

    $this->warehouses=WarehouseTable::fetchAll();

    $this->products=array();
    
    if($this->searchstring!="")
    {
     $this->products = Doctrine_Query::create()
      ->from('Product p, p.Invoicedetail id, id.Invoice inv, inv.Customer c')
      ->orderBy('p.name')
      ->where('p.name like "%'.$this->searchstring.'%"')
      ->execute();
    }
    else
    {
      if($this->product_id)
     $this->products = Doctrine_Query::create()
      ->from('Product p, p.Invoicedetail id, id.Invoice inv, inv.Customer c')
      ->where('p.id ='.$this->product_id)
      ->execute();
    }
  }
  public function executePurchasesearch(sfWebRequest $request)
  {
    $this->searchstring = $request->getParameter("searchstring");
    $requestparams=$request->getParameter("invoicedetail");
    $this->product_id = $requestparams["product_id"];

    $this->warehouses=WarehouseTable::fetchAll();

    $this->products=array();
    
    if($this->searchstring!="")
    {
     $this->products = Doctrine_Query::create()
      ->from('Product p, p.Purchasedetail pd, pd.Purchase po, po.Vendor v')
      ->orderBy('p.name')
      ->where('p.name like "%'.$this->searchstring.'%"')
      ->execute();
    }
    else
    {
      if($this->product_id)
     $this->products = Doctrine_Query::create()
      ->from('Product p, p.Purchasedetail pd, pd.Purchase po, po.Vendor v')
      ->where('p.id ='.$this->product_id)
      ->execute();
    }
  }
  public function executeStocksearch(sfWebRequest $request)
  {
    $this->searchstring = $request->getParameter("searchstring");
    $requestparams=$request->getParameter("invoicedetail");
    $this->product_id = $requestparams["product_id"];

    $this->warehouses=WarehouseTable::fetchAll();

    $this->products=array();
    
    if($this->searchstring!="")
    {
     $this->products = Doctrine_Query::create()
      ->from('Product p')
      ->orderBy('p.name')
      ->where('p.name like "%'.$this->searchstring.'%"')
      ->execute();
    }
    else
    {
      if($this->product_id)
     $this->products = Doctrine_Query::create()
      ->from('Product p, p.Stock s, s.Warehouse w')
      ->where('p.id ='.$this->product_id)
      ->execute();
    }
  }
  
  protected function executeBatchCreateproducttype(sfWebRequest $request)
  {
    $producttypedata=$request->getParameter('producttype');
    $producttype_name=$producttypedata["name"];
    $ids = $request->getParameter('ids');

		//search for producttype of given name
		$producttype=MyModel::fetchOne("Producttype",array('name'=>'"'.$producttype_name.'"'));

		//if not found,
		if(!$producttype)
		{
		  //create new product type
		  $producttype=new Producttype();
		  $producttype["name"]=$producttype_name;
		  $producttype["parent_id"]=1;
		  $producttype->calcPath();
		}

		$producttype_id=$producttype->getId();

		//set products to producttype
    $records = Doctrine_Query::create()
      ->from('Product')
      ->whereIn('id', $ids)
      ->execute();

    foreach ($records as $record)
    {
      $record->setProducttypeId($producttype_id);
      //$record->setName(str_replace("Pressure Tank","Tank",$record->getName()));
      $record->save();
    }
    $this->redirect($request->getReferer());
    
    
  }
  protected function executeBatchSetproducttype(sfWebRequest $request)
  {
    $producttypedata=$request->getParameter('product');
    $producttype_id=$producttypedata["producttype_id"];

    $ids = $request->getParameter('ids');

    $records = Doctrine_Query::create()
      ->from('Product')
      ->whereIn('id', $ids)
      ->execute();

    foreach ($records as $record)
    {
      $record->setProducttypeId($producttype_id);
      //$record->setName(str_replace("Pressure Tank","Tank",$record->getName()));
      $record->save();
    }
    $this->redirect($request->getReferer());
  }
  public function executePricelist(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
		$this->redirect("producttype/view?id=".$this->product->getProducttypeId());
  }
  public function executeInventory(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->product);
  }
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->cascadeDelete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect($request->getReferer());
  }
  public function executeBarcode(sfWebRequest $request)
  {
  }
  public function executeBarcodepdf(sfWebRequest $request)
  {
    $this->start=$request->getParameter("start");
    $this->qty=$request->getParameter("qty");
    $productdata=$request->getParameter("invoicedetail");
    $this->product_id=$productdata["product_id"];
    $this->product = Doctrine_Query::create()
      ->from('Product p')
      ->where('id = '.$this->product_id)
      ->fetchOne();

    $this->start--;
    $this->end=$this->start+$this->qty;


    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
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
		$this->generate=false;
		$this->tested=false;
    //---------case 2: method=get, init vars but do nothing: [ok]---------
  	//show empty
		if($request->getMethod()=="GET")
    {
    }
  	//---------case 3: method=post: process data ---------
		else
		{
	    $this->inputstring=$request->getParameter("inputstring");
			$this->parse();
	    $this->tested=true;
	    if($request->getParameter("submit")=="Save")
  	    $this->generate=true;

			//test parsed data
			//var_dump($this->cellstrings);

      //processing:
      //save each item under product type
      //expect 2 columns: producttype and product
      //optional column:price?
      foreach($this->cellstrings as $row)
      {
        $producttypename=$row[0];
        $productname=$row[1];

        //check if product exists
         $product = Doctrine_Query::create()
          ->from('Product p')
          ->where('p.name ="'.$productname.'"')
          ->fetchOne();
        if($product)
        {
          $this->errors[]="Product ".$productname." already exists.";
        }


        $producttype=null;
        if($producttypename)
        {
         $producttype = Doctrine_Query::create()
          ->from('Producttype pt')
          ->where('pt.path ="'.$producttypename.'"')
          ->fetchOne();
        }
        if(!$producttype)
        {
          $this->errors[]="Producttype ".$producttypename." not found.";
        }

        if(count($this->errors)==0)
        if($this->generate)
        {
          $product=new Product();
          $product->setName($productname);
          if($producttype)
          {
            $product->setProducttypeId($producttype->getId());
          }
          $product->save();
          $this->messages[]="Product ".$productname." created.";
        }
      }

/*
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
		  */
		}
	}	
	private function parse()
	{
		$this->linestrings=explode("\n",$this->inputstring);
		$this->cellstrings=array();
		foreach($this->linestrings as $linestring)
		{
		  if(trim($linestring)=="")continue;
			$cellarray=explode("\t",$linestring);
			//trim each cell
			foreach($cellarray as &$cell)
				$cell=trim($cell);
			$this->cellstrings[]=$cellarray;
		}
	}
  public function executeRecalc(sfWebRequest $request)
  {
      //default values
    $this->interval=1000;
    $this->start=1;

    if(!isset($_REQUEST["submit"]))
     return;
     
    if(isset($_REQUEST["interval"]))
        $this->interval=$request->getParameter("interval");
    if(isset($_REQUEST["start"]))
        $this->start=$request->getParameter("start");
     $this->end=$this->start+$this->interval-1;
    
     $this->products = Doctrine_Query::create()
      ->from('Product p')
      ->where('p.id <='.$this->end)
      ->andWhere('p.id >='.$this->start)
      ->execute();
        foreach ($this->products as $product) {
            $product->calcSellPrice();
            $product->calcBuyPrice();
        }
     $this->start=$this->end+1;
  }
}
