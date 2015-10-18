<?php

require_once dirname(__FILE__).'/../lib/purchaseGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/purchaseGeneratorHelper.class.php';

/**
 * purchase actions.
 *
 * @package    sf_sandbox
 * @subpackage purchase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class purchaseActions extends autoPurchaseActions
{
  public function executeDsr(sfWebRequest $request)
  {
    $requestparams=$request->getParameter("purchase");
    $day=$requestparams["date"]["day"];
    $month=$requestparams["date"]["month"];
    $year=$requestparams["date"]["year"];
    $purchase=new Purchase();
    if(!$day or !$month or !$year)
      $purchase->setDate(MyDate::today());
    else
      $purchase->setDate($year."-".$month."-".$day);

    $this->form=new PurchaseForm($purchase);
  
    $this->purchases = PurchaseTable::fetchByDate($purchase->getDate());
    $this->events = EventTable::fetchByDatenParentclass($purchase->getDate(),"Purchase");

      $this->cashsales=0;
      $this->chequesales=0;
      $this->creditsales=0;
      $this->cashother=0;
      $this->chequeother=0;
      $this->creditother=0;
      $this->cashtotal=0;
      $this->chequetotal=0;
      $this->credittotal=0;
      $this->deducttotal=0;
      foreach($this->purchases as $purchase)if($purchase->getStatus()!="Cancelled")
      {
        $this->cashsales+=$purchase->getCash();
        $this->chequesales+=$purchase->getCheque();
        $this->creditsales+=$purchase->getCredit();
        $this->cashtotal+=$purchase->getCash();
        $this->chequetotal+=$purchase->getCheque();
        $this->credittotal+=$purchase->getCredit();
        //$this->deducttotal+=$purchase->getDsrdeduction();
      }
      foreach($this->events as $event)
      {
        $purchase=$event->getParent();
        if($purchase->getStatus()!="Cancelled")
        {
          $this->cashother+=$event->getDetail("cashamt");
          $this->chequeother+=$event->getDetail("chequeamt");
          $this->creditother+=$event->getDetail("creditamt");
          $this->cashtotal+=$event->getDetail("cashamt");
          $this->chequetotal+=$event->getDetail("chequeamt");
          $this->credittotal+=$event->getDetail("creditamt");
          $this->deducttotal+=$event->getDetail3();
        }
      }
      $this->total=$this->cashtotal+$this->chequetotal+$this->credittotal;
  }
  public function executeDsrmulti(sfWebRequest $request)
  {
    $requestparams=$request->getParameter("invoice");
    $day=$requestparams["date"]["day"];
    $month=$requestparams["date"]["month"];
    $year=$requestparams["date"]["year"];

    $invoice=new Invoice();
    if(!$day or !$month or !$year)
      $invoice->setDate(MyDate::today());
    else
      $invoice->setDate($year."-".$month."-".$day);

    $requestparams=$request->getParameter("purchase");
    $day=$requestparams["date"]["day"];
    $month=$requestparams["date"]["month"];
    $year=$requestparams["date"]["year"];
    $purchase=new Purchase();
    if(!$day or !$month or !$year)
      $purchase->setDate(MyDate::today());
    else
      $purchase->setDate($year."-".$month."-".$day);

    $this->form=new InvoiceForm($invoice);
    $this->toform=new PurchaseForm($purchase);
  
    $this->purchases = PurchaseTable::fetchByDateRange($invoice->getDate(),$purchase->getDate());
    $this->events = EventTable::fetchByDatenParentclass($purchase->getDate(),"Purchase");

      $this->cashsales=0;
      $this->chequesales=0;
      $this->creditsales=0;
      $this->cashother=0;
      $this->chequeother=0;
      $this->creditother=0;
      $this->cashtotal=0;
      $this->chequetotal=0;
      $this->credittotal=0;
      $this->deducttotal=0;
      foreach($this->purchases as $purchase)if($purchase->getStatus()!="Cancelled")
      {
        $this->cashsales+=$purchase->getCash();
        $this->chequesales+=$purchase->getCheque();
        $this->creditsales+=$purchase->getCredit();
        $this->cashtotal+=$purchase->getCash();
        $this->chequetotal+=$purchase->getCheque();
        $this->credittotal+=$purchase->getCredit();
        //$this->deducttotal+=$purchase->getDsrdeduction();
      }
      foreach($this->events as $event)
      {
        $purchase=$event->getParent();
        if($purchase->getStatus()!="Cancelled")
        {
          $this->cashother+=$event->getDetail("cashamt");
          $this->chequeother+=$event->getDetail("chequeamt");
          $this->creditother+=$event->getDetail("creditamt");
          $this->cashtotal+=$event->getDetail("cashamt");
          $this->chequetotal+=$event->getDetail("chequeamt");
          $this->credittotal+=$event->getDetail("creditamt");
          $this->deducttotal+=$event->getDetail3();
        }
      }
      $this->total=$this->cashtotal+$this->chequetotal+$this->credittotal;
  }
  public function executeDsrpdf(sfWebRequest $request)
  {
    $this->executeDsr($request);
    //$this->document = $this->getRoute()->getObject();
    //$this->form = $this->configuration->getForm($this->incoming);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  public function executeDsrmultipdf(sfWebRequest $request)
  {
    $this->executeDsrmulti($request);
    //$this->document = $this->getRoute()->getObject();
    //$this->form = $this->configuration->getForm($this->incoming);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  function today() { 
    $today = getdate(); 
    return $today['year']."-".$today['mon']."-".$today['mday'];
    }
  public function executeView(sfWebRequest $request)
  {
    $this->purchase=Doctrine_Query::create()
        ->from('Purchase i, i.Employee e, i.Terms t, i.Vendor s')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();

    $this->form = $this->configuration->getForm($this->purchase);

    //allow set product id by url
    $detail=new Purchasedetail();
    $detail->setQty(1);
    if($request->getParameter("product_id"))
      $detail->setProductId($request->getParameter("product_id"));
    $this->detailform = new PurchasedetailForm($detail); 
  }
  public function executeAccounting(sfWebRequest $request)
  {
    $this->purchase=Doctrine_Query::create()
        ->from('Purchase i, i.Employee e, i.Terms t, i.Vendor s')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();
    $this->form = $this->configuration->getForm($this->purchase);

    $this->accountentries=$this->purchase->getAccountentries(true);
    $this->totalsbyaccount=array();

    foreach($this->purchase->getAccountids() as $id)
    {
      $this->totalsbyaccount[$id]=0;
    }
    foreach($this->accountentries as $entry)
    {
      $this->totalsbyaccount[$entry->getAccountId()]+=$entry->getQty();
    }
  }
  public function executeEvents(sfWebRequest $request)
  {
    $this->purchase=Doctrine_Query::create()
        ->from('Purchase i, i.Employee e, i.Terms t, i.Vendor s')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();
    $this->form = $this->configuration->getForm($this->purchase);
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->purchase = new Purchase();
    $this->purchase->setDate($this->today());
    $this->purchase->setDatereceived($this->today());
    $this->purchase->setTemplateId(1);
    $this->purchase->setEmployeeId(2);
    if($request->getParameter("pono"))
      $this->purchase->setPono($request->getParameter("pono"));
    $this->form = $this->configuration->getForm($this->purchase);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $isnew=$form->getObject()->isNew();
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $purchase = $form->save();
        $purchase->calc();
        $purchase->getUpdateChequedata();
        $purchase->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $purchase)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@purchase_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('purchase/view?id='.$purchase->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  public function executeSearch(sfWebRequest $request)
  {
    $query=Doctrine_Query::create()
        ->from('Purchase i')
      	->where('i.pono = '.trim($request->getParameter("searchstring")));

  	$results=$query->execute();
  	
  	if(count($results)==1)
  	{
			$this->purchase=$results[0];
  		$this->redirect("purchase/view?id=".$this->purchase->getId());
  	}
  	else
  		$this->redirect("purchase/new?pono=".$request->getParameter("searchstring"));


  }
  public function executeAdjusttype(sfWebRequest $request)
  {
    $purchase = $this->getRoute()->getObject();

    //set
    //save
    //calc
    $purchase->setType($request->getParameter("type"));
    $purchase->calc();
    $purchase->save();
    
    $this->redirect($request->getReferer());
  }
  public function executeBarcode(sfWebRequest $request)
  {
    $this->purchase = $this->getRoute()->getObject();

    $this->details=$this->purchase->getPurchasedetail();

    $this->start=1;

  }
  public function executeBarcodepdf(sfWebRequest $request)
  {
    
    $this->start=$request->getParameter("start");
    $qty=$request->getParameter("qty");

    $this->purchase_id=$request->getParameter("id");
    $this->purchase = Doctrine_Query::create()
      ->from('Purchase p')
      ->where('id = '.$this->purchase_id)
      ->fetchOne();
    $details=$this->purchase->getPurchasedetail();


    $this->qty=array();
    $this->details=array();
    //create qty / detail arrays, omit 0 qty items 
    foreach($qty as $index=>$q)
    {
      if($q!=0)
      {
        $this->qty[]=$qty[$index];
        $this->details[]=$details[$index];
      }
    }

    //create array of products
    $this->products=array();
    foreach($this->details as $detail)
    {
      $this->products[]=$detail->getProduct();
    }


    $this->start--;
    //$this->end=$this->start+$this->qty;


    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
    public function executeInspect(sfWebRequest $request)
    {
        $this->purchase=Doctrine_Query::create()
        ->from('Purchase i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();
        
        $this->purchase->setIsInspected(1);
        $this->purchase->save();
        
        $this->redirect($request->getReferer());
    }
    public function executeUninspect(sfWebRequest $request)
    {
        $this->purchase=Doctrine_Query::create()
        ->from('Purchase i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();
        
        $this->purchase->setIsInspected(0);
        $this->purchase->save();
        
        $this->redirect($request->getReferer());
    }
    
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $purchase=$this->getRoute()->getObject();
    $details=$purchase->getPurchasedetail();
    foreach($details as $detail)
    {
        $detail->getStockentry()->delete();
        $detail->delete();
    }
    $result=$purchase->delete();
   
    if ($result)
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('home/index');
  }
  
  public function executeGenerateInvoice(sfWebRequest $request)
  {
        $purchase=Doctrine_Query::create()
        ->from('Purchase p')
        ->where('p.id = '.$request->getParameter('id'))
        ->fetchOne();

	//create purchase
	$invoice=new Invoice();
	$invoice->setInvno(date('h:i:s a'));
	$invoice->setCustomerId(2);//cash
	$invoice->setIsTemporary(2);//new
	$invoice->setDate(date("Y-m-d"));
	$invoice->save();

	//create purchase details
	foreach($purchase->getPurchasedetail() as $purchdetail)
	{
		$invdetail=new InvoiceDetail();
		$invdetail->setInvoiceId($invoice->getId());
		$invdetail->setProductId($purchdetail->getProductId());
		$invdetail->setDescription($purchdetail->getProduct()->getName());
		$invdetail->setQty($purchdetail->getQty());
		$invdetail->setPrice(0);
		$invdetail->setTotal(0);
		$invdetail->setUnittotal(0);
		$invdetail->save();
		$invdetail->updateStockentry();
	}

        $this->redirect("invoice/view?id=".$invoice->getId());
  }
    
  /*
  public function executeSetbarcode(sfWebRequest $request)
  {
    $purchasedetails=Doctrine_Query::create()
        ->from('Purchasedetail pd, pd.Purchase p')
      	->execute();

    foreach($purchasedetails as $p)
    {
      $barcoderoot=$p->getProductId().$p->getPurchase()->getPono();
      $p->setBarcode(MyBarcode::standardize($barcoderoot));
      $p->save();
    }
  }*/
}
