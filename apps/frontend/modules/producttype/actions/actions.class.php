<?php

require_once dirname(__FILE__).'/../lib/producttypeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/producttypeGeneratorHelper.class.php';

/**
 * producttype actions.
 *
 * @package    sf_sandbox
 * @subpackage producttype
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class producttypeActions extends autoProducttypeActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->producttype = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->producttype);
    $this->levels=$request->getParameter("levels");
    if($this->levels=="")$this->levels=1;
    $query=Doctrine_Query::create()
        ->from('Product p')
      	->where('p.producttype_id='.$this->producttype->getId())
	->orderBy('p.name')
	;
      	if($this->producttype->getId()==1 and $request->getParameter("showall")!=1)$query->limit('50');
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
  public function executeNew(sfWebRequest $request)
  {
    $this->producttype = new Producttype();
    $this->producttype->setParentId($request->getParameter("parent_id"));
    $this->form = $this->configuration->getForm($this->producttype);
  }
  public function executeEdit(sfWebRequest $request)
  {
    $this->producttype = $this->getRoute()->getObject();
    //prevent edit of home page
    if($this->producttype->isHome())$this->redirect("producttype/view?id=1");
    $this->form = $this->configuration->getForm($this->producttype);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $producttype = $form->save();
        $producttype->calcPath();
      
        //custom calculation
        $producttype->getParent()->calc();
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $producttype)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@producttype_new?parent_id='.$producttype->getParentId());
     }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect("producttype/view?id=".$producttype->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $parent=$this->getRoute()->getObject()->getParent();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->isRoot())
    {
      $this->getUser()->setFlash('error', 'Cannot delete root node');
    }
    elseif ($this->getRoute()->getObject()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('producttype/view?id=1');
  }
  public function executeMassoper(sfWebRequest $request)
  {
    $parent_id=$request->getParameter("parent_id");
    $parent=ProducttypeTable::fetch($parent_id);
	  $children=$parent->getChildren();
	  $priority=$children[count($children)-1]->getPriority()+2;
    
  	$ids=$request->getParameter("ids");
  	
  	if($request->getParameter("submit")=="Copy")
  	{
  	  
  	  
    	foreach($ids as $id)
    	{
    	  $producttype=ProducttypeTable::fetch($id);
    	  $newproducttype=$producttype->copyProducttype();

    	  $newproducttype->setParentId($parent_id);
    	  $newproducttype->setPriority($priority);$priority+=2;
    	  $newproducttype->save();
    	}
  	}
  	else //move
  	{
    	foreach($ids as $id)
    	{
    	  $producttype=ProducttypeTable::fetch($id);
    	  $producttype->setParentId($parent_id);
    	  $producttype->setPriority($priority);$priority+=2;
    	  $producttype->save();
    	}
  	}
  	$parent->calc();
    $this->redirect($request->getReferer());
  }
  public function executeMerge(sfWebRequest $request)
  {
		$this->producttype=ProducttypeTable::fetch($request->getParameter("producttype_id"));
		$this->producttype_id=$request->getParameter("producttype_id");
		$this->duplicate_ids=$request->getParameter("duplicate_ids");
	  $this->duplicateproducts=$this->producttype->getProductsByIds(explode(",",$request->getParameter("duplicate_ids")));
		$this->product=ProductTable::fetch($request->getParameter("product_id"));

		if($request->getParameter("submit")=="Execute" or $request->getParameter("submit")=="Execute and Delete")
		{
			foreach($this->duplicateproducts as $duplicate)
			{
				//if($product->getId()==1)die();
				foreach($duplicate->getInvoicedetail() as $detail)
				{
				  $detail->setProductId($this->product->getId());
				  $detail->save();
				}
				foreach($duplicate->getPurchasedetail() as $detail)
				{
				  $detail->setProductId($this->product->getId());
				  $detail->save();
				}
				if($request->getParameter("submit")=="Execute and Delete")
					$duplicate->cascadeDelete();
			}

			
			$this->redirect("producttype/view?id=".$this->producttype_id);
		}
  
  }
  public function executeProductmassoper(sfWebRequest $request)
  {
    $producttype_id=$request->getParameter("producttype_id");
    $producttype=ProducttypeTable::fetch($producttype_id);

  	$prefix=$request->getParameter("prefix");
  	$suffix=$request->getParameter("suffix");
  	$replace=$request->getParameter("replace");
  	$with=$request->getParameter("with");

  	$maxsellprices=$request->getParameter("maxsellprices");
  	$maxbuyprices=$request->getParameter("maxbuyprices");
  	$minsellprices=$request->getParameter("minsellprices");
  	$minbuyprices=$request->getParameter("minbuyprices");
    
  	$autocalcsellprices=$request->getParameter("autocalcsellprices");
  	$autocalcbuyprices=$request->getParameter("autocalcbuyprices");


  	$ids=$request->getParameter("product_ids");
	  $products=$producttype->getProductsByIds($ids);

		//if no checked products, do nothing
  	if(count($ids))
  	{
  		if($request->getParameter("submit")=="Merge")
  		{
  			$this->redirect("producttype/merge?producttype_id=".$producttype_id."&product_id=".$request->getParameter("input")."&duplicate_ids=".implode(",",$ids));
  			//$this->mainproduct=ProductTable::fetch($request->getParameter("input"));
  			//$this->products=$products;
//				$this->merge($mainproduct, $product);
  			//
  		}
  		//save publish
  		else if($request->getParameter("submit")=="Save")
  		{
		  	foreach($products as $product)
		  	{
		  		if($maxsellprices[$product->getId()]!="")
		  		{
						$product->setMaxsellprice($maxsellprices[$product->getId()]);
						$product->setAutocalcsellprice(0);
		  		}
					
		  		if($minsellprices[$product->getId()]!="")
		  		{
						$product->setMinsellprice($minsellprices[$product->getId()]);
						$product->setAutocalcsellprice(0);
		  		}

		  		if($maxbuyprices[$product->getId()]!="")
		  		{
						$product->setMaxbuyprice($maxbuyprices[$product->getId()]);
						$product->setAutocalcbuyprice(0);
		  		}

		  		if($minbuyprices[$product->getId()]!="")
		  		{
						$product->setMinbuyprice($minbuyprices[$product->getId()]);
						$product->setAutocalcbuyprice(0);
		  		}

					$product->save();
		  	}
  		}
  		else if($request->getParameter("submit")=="Monitor")
  		{
		  	foreach($products as $product)
		  	{
					$product->setMonitored(1);
					$product->save();
				}
  		}
  		else if($request->getParameter("submit")=="Unmonitor")
  		{
		  	foreach($products as $product)
		  	{
					$product->setMonitored(0);
					$product->save();
				}
  		}
  		//string manipulation
			else 
			{
		  	foreach($products as $product)
		  	{
		  		//if(stripos($product->getName(),"2 ")!==false)
		  		{
						$product->setName($prefix.str_replace($replace,$with,$product->getName()).$suffix);
						
						//$product->setDescription($product->getName());
						$product->save();
		  		}
		  	}
			}
  	}

  	//$parent->calc();
    $this->redirect($request->getReferer());
  }
  public function executeSetstatus(sfWebRequest $request)
  {
    $producttype=MyModel::fetchOne("Producttype",array('id'=>$request->getParameter("id")));

    $producttype->setStatus($request->getParameter("color"));
    $producttype->save();

		$this->redirect($request->getReferer());
	}
  public function executeDump(sfWebRequest $request)
  {
    $this->products=Doctrine_Query::create()
        ->from('Product p')
		->orderBy('p.producttype_id,p.name')
		->execute();
	;
  }
}
