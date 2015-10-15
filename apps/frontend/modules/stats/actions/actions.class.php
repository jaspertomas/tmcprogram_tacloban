<?php

/**
 * stats actions.
 *
 * @package    sf_sandbox
 * @subpackage stats
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
			/*
				code:
				 - fetch all invoicedetails / filter dates if desired
				 - create array for product names, array for product sale qtys

				 - foreach invdetail
				-  - if array index for product_id does not exist, create entry in both arrays
				-  - add invdetail qty to array element value to represent product sale 
				- sort array by value

				 - display
		 */
		$productnames=array();
		$productqtys=array();
		 
		 $invoicedetails=Doctrine_Query::create()
        ->from('Invoicedetail id, id.Product p, id.Invoice i')
        ->where('i.date > "2010-08-01"')
        ->execute();

		 foreach($invoicedetails as $detail)
		 {
		 		if(!array_key_exists($detail->getProductId(),$productnames))
		 		{
		 			$productnames[$detail->getProductId()]=$detail->getProduct()->getName();
		 			$productqtys[$detail->getProductId()]=0;
		 		}
	 			$productqtys[$detail->getProductId()]+=$detail->getQty();
		 		
		 }
		 arsort($productqtys);
		 $this->productnames=$productnames;
		 $this->productqtys=$productqtys;

			//get list of products
		 $products=Doctrine_Query::create()
        ->from('Product p')
        ->execute();

		 foreach($products as $product)
		 {
		 		if(!array_key_exists($product->getId(),$productnames))
		 		{
		 			$productnames[$detail->getProductId()]=$product->getName();
		 			$productqtys[$detail->getProductId()]=0;
		 		}
		 }
        


   }
}
