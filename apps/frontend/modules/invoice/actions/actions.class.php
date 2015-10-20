<?php

require_once dirname(__FILE__).'/../lib/invoiceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/invoiceGeneratorHelper.class.php';

/**
 * invoice actions.
 *
 * @package    sf_sandbox
 * @subpackage invoice
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $

to show status pending if checks not yet cleared:
on invoice update:
	invoice checkcleardate default = date


 */
class invoiceActions extends autoInvoiceActions
{
  public function executeIncstate(sfWebRequest $request)
  {
    $this->invoices=Doctrine_Query::create()
        ->from('Invoice i')
      	->where('date >="2011-02-01"')
      	->andwhere('date <="2011-02-28"')
      	->execute();

    $this->bymonth=array();
    $this->cashtotal=0;
    $this->chequetotal=0;
    $this->credittotal=0;
    foreach($this->invoices as $invoice)
    {
      if(!array_key_exists($invoice->getDate(),$this->bymonth))
      {
        $this->bymonth[$invoice->getDate()]["cash"]=0;
        $this->bymonth[$invoice->getDate()]["cheque"]=0;
        $this->bymonth[$invoice->getDate()]["credit"]=0;
      }
      $this->bymonth[$invoice->getDate()]["cash"]+=$invoice->getCash();
      $this->bymonth[$invoice->getDate()]["cheque"]+=$invoice->getChequeamt();
      $this->bymonth[$invoice->getDate()]["credit"]+=$invoice->getCredit();
      $this->cashtotal+=$invoice->getCash();
      $this->chequetotal+=$invoice->getChequeamt();
      $this->credittotal+=$invoice->getCredit();
    }
  }
  public function executeDsr(sfWebRequest $request)
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

    $this->form=new InvoiceForm($invoice);

    $this->invoices = InvoiceTable::fetchByDate($invoice->getDate());
    $this->events = EventTable::fetchByDatenParentclass($invoice->getDate(),"Invoice");

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
      foreach($this->invoices as $invoice)if($invoice->getIsTemporary()==0)if($invoice->getStatus()!="Cancelled")if($invoice->getHidden()==0)//if not hidden
      {
        $this->cashsales+=$invoice->getCash();
        $this->chequesales+=$invoice->getChequeamt();
        $this->creditsales+=$invoice->getCredit();
        $this->cashtotal+=$invoice->getCash();
        $this->chequetotal+=$invoice->getChequeamt();
        $this->credittotal+=$invoice->getCredit();
        $this->deducttotal+=$invoice->getDsrdeduction();
      }
      foreach($this->events as $event)
      {
        $invoice=$event->getParent();
        if($invoice and $invoice->getStatus()!="Cancelled")
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

    $this->invoices = InvoiceTable::fetchByDateRange($invoice->getDate(),$purchase->getDate());
    $this->events = EventTable::fetchByDatenParentclass($invoice->getDate(),"Invoice");

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

      $this->templates=Doctrine_Query::create()
        ->from('InvoiceTemplate t')
        ->where('t.name="Invoice"')//invoice only
        ->orderBy('id')
      	->execute();

      //calculations start

//no tmc so, no lesley, no interoffice
foreach($this->templates as $template)
{
//end no tmc so, no lesley, no interoffice
      foreach($this->invoices as $invoice)
      	if($invoice->getIsTemporary()==0)
		if($invoice->getTemplateId()==$template->getId())
		if($invoice->getStatus()!="Cancelled")
          if($invoice->getHidden()==0)//if not hidden
      {
        $this->cashsales+=$invoice->getCash();
        $this->chequesales+=$invoice->getChequeamt();
        $this->creditsales+=$invoice->getCredit();
        $this->cashtotal+=$invoice->getCash();
        $this->chequetotal+=$invoice->getChequeamt();
        $this->credittotal+=$invoice->getCredit();
        $this->deducttotal+=$invoice->getDsrdeduction();
      }
//no tmc so, no lesley, no interoffice
}
//end no tmc so, no lesley, no interoffice
/*
//hide events
      foreach($this->events as $event)
      {
        $invoice=$event->getParent();
        if($invoice->getStatus()!="Cancelled")
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
*/
      $this->total=$this->cashtotal+$this->chequetotal+$this->credittotal;
  }
/*
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

 $this->invoices = InvoiceTable::fetchByDateRange($invoice->getDate(),$purchase->getDate());
 $this->events = EventTable::fetchByDatenParentclass($invoice->getDate(),"Invoice");

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
 foreach($this->invoices as $invoice)if($invoice->getStatus()!="Cancelled")
 {
 $this->cashsales+=$invoice->getCash();
 $this->chequesales+=$invoice->getChequeamt();
 $this->creditsales+=$invoice->getCredit();
 $this->cashtotal+=$invoice->getCash();
 $this->chequetotal+=$invoice->getChequeamt();
 $this->credittotal+=$invoice->getCredit();
 $this->deducttotal+=$invoice->getDsrdeduction();
 }
 foreach($this->events as $event)
 {
 $invoice=$event->getParent();
 if($invoice->getStatus()!="Cancelled")
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
 */


  public function executeCommission(sfWebRequest $request)
  {
    $requestparams=$request->getParameter("invoice");
    $day=$requestparams["date"]["day"];
    $month=$requestparams["date"]["month"];
    $year=$requestparams["date"]["year"];

    //if no date, date is today. else date is date given
    if(!$year or !$month or !$day)$date=MyDateTime::today();
    else $date=new MyDateTime($year,$month,$day,0,0,0);

    $invoice=new Invoice();
    $invoice->setDate($date->getstartofmonth()->tomysql());
    $purchase=new Purchase();
    $purchase->setDate($date->getendofmonth()->tomysql());

    $this->date=$date;
    $this->form=new InvoiceForm($invoice);
    $this->toform=new PurchaseForm($purchase);

    //set up an array of employees indexed by employee id
    $this->rawemployees=Doctrine_Query::create()
        ->from('Employee e')
      	->where('e.commission > 0 ')
      	->execute();
    $this->employees=array();
    foreach($this->rawemployees as $employee)
    {
      $this->employees[$employee->getId()]=$employee;
    }

    $this->empinvoices = array();
    foreach($this->employees as $employee)
      $this->empinvoices[$employee->getId()]=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Invoicedetail id, id.Product p')
        ->where('i.salesman_id='.$employee->getId())
      	->andwhere('i.date >= "'.$invoice->getDate().'"')
      	->andwhere('i.date <=  "'.$purchase->getDate().'"')
        ->orWhere('i.technician_id='.$employee->getId())
      	->andwhere('i.date >= "'.$invoice->getDate().'"')
      	->andwhere('i.date <=  "'.$purchase->getDate().'"')
      	->orderBy('i.invno')
      	->execute();

    $commissiontotals=array();
    foreach($this->empinvoices as $empid=>$employeedata)
    {
      $totalcommission=0;
      foreach($employeedata as $invoice)
      {
        if($invoice->getStatus()=="Paid")
        	$totalcommission+=$invoice->getCommissionTotal($this->employees[$empid]);
      }
      $commissiontotals[$empid]=$totalcommission;
    }
    $this->commissiontotals=$commissiontotals;
    $this->grandtotalcommission=0;
    foreach($commissiontotals as $total)
    {
      $this->grandtotalcommission+=$total;
    }

  }
  public function executeCommissionpdf(sfWebRequest $request)
  {
    $this->executeCommission($request);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  public function executeCancel(sfWebRequest $request)
  {
    $this->invoice = $this->getRoute()->getObject();
    $this->invoice->cascadeCancel();

    $this->redirect("invoice/view?id=".$this->invoice->getId());

    /*
			Docu for cancel
				on cancel
					call family of data objects, tell them to cancel in their own way


				after cancel:
					invoice still shows cancelled events and details
					invoice must not be able to create events.
					invoicedetails must not create quotes or stockentries.

    */
  }
  public function executeView(sfWebRequest $request)
  {
    $this->invoice=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Terms t, i.Customer c')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();

    $this->form = $this->configuration->getForm($this->invoice);

    //allow set product id by url
    $detail=new Invoicedetail();
    $detail->setQty(1);
    if($request->getParameter("product_id"))
    {
      $detail->setProductId($request->getParameter("product_id"));
    }
    $this->detailform = new InvoicedetailForm($detail);
    $this->detail = $detail;
  }
  public function executeAccounting(sfWebRequest $request)
  {
    $this->invoice=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Terms t, i.Customer c')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();
    $this->form = $this->configuration->getForm($this->invoice);

    $this->accountentries=$this->invoice->getAccountentries(true);
    $this->totalsbyaccount=array();

    foreach($this->invoice->getAccountids() as $id)
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
    $this->invoice=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Terms t, i.Customer c')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();
    $this->form = $this->configuration->getForm($this->invoice);
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->invoice = new Invoice();
    $this->invoice->setDate(MyDate::today());
    $this->invoice->setTemplateId(1);
    
    //auto set employee
    $employee=Doctrine_Query::create()
    ->from('Employee e')
  	->where('e.username = "'.$this->getUser()->getUsername().'"')
  	->fetchOne();
  	if($employee)
	    $this->invoice->setSalesmanId($employee->getId());
  	else
    		$this->invoice->setSalesmanId(2);//default is jonathan
    		
    $this->invoice->setTermsId(5);
    if($request->getParameter("invno"))
    {
      $this->invoice->setInvno($request->getParameter("invno"));
      $this->invoice->setIsTemporary(0);
    }
    else
    {
      $invno=$this->getUser()->getUsername()." ".date('h:i:s a');
      $this->invoice->setInvno($invno);
      $this->invoice->setIsTemporary(2);
    }
    $this->form = $this->configuration->getForm($this->invoice);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $isnew=$form->getObject()->isNew();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        //save this for later use
        $oldistemporary=$form->getObject()->getIsTemporary();
        
        $invoice = $form->save();
        
        //save this for later use
        $newistemporary=$invoice->getIsTemporary();

        if(!$invoice->getCheckcleardate())$invoice->setCheckcleardate($invoice->getDate());

        $invoice->calc();
        $invoice->getUpdateChequedata();
        $invoice->save();
        $invoice->genCustomer();
        
        //update stock entries if is_temporary changed from not closed to closed or vice versa
        //determine if is_temporary changed 
        //closed = 0
        //narrow down values (remove 1) to make it easier to determine
        if($oldistemporary==1)$oldistemporary=2;
        if($newistemporary==1)$newistemporary=2;
        //if it changed
        if($oldistemporary!=$newistemporary)
        {
            //if closed
            if($newistemporary==0)
            {
                foreach($invoice->getInvoicedetail() as $detail)
                {
			$detail->updateStockentry();
                }
            }
            //else if not closed
            else
            {
                foreach($invoice->getInvoicedetail() as $detail)
                {
                    $detail->getStockentry()->delete();
                }
            }
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $invoice)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@invoice_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('invoice/view?id='.$invoice->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
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
  public function executeSearch(sfWebRequest $request)
  {
    $query=Doctrine_Query::create()
        ->from('Invoice i')
      	->where('i.invno = "'.trim($request->getParameter("searchstring")).'"');

  	$results=$query->execute();

  	if(count($results)==1)
  	{
			$this->invoice=$results[0];
  		$this->redirect("invoice/view?id=".$this->invoice->getId());
  	}
  	else
  		$this->redirect("invoice/new?invno=".$request->getParameter("searchstring"));


  }
  public function executeAdjustsaletype(sfWebRequest $request)
  {
    $invoice = $this->getRoute()->getObject();

    //set
    //save
    //calc
    $invoice->setSaletype($request->getParameter("type"));
    //$invoice->calc();
    $invoice->save();

    $this->redirect($request->getReferer());
  }
    public function executeHide(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Terms t, i.Customer c')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();

        $this->invoice->setHidden(1);
        $this->invoice->save();

            $this->redirect($request->getReferer());
    }

    public function executeUnhide(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Terms t, i.Customer c')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();

        $this->invoice->setHidden(0);
        $this->invoice->save();

        $this->redirect($request->getReferer());
    }
    public function executeInspect(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();

        $this->invoice->setIsInspected(1);
        $this->invoice->save();

        $this->redirect($request->getReferer());
    }
    public function executeUninspect(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();

        $this->invoice->setIsInspected(0);
        $this->invoice->save();

        $this->redirect($request->getReferer());
    }
    public function executeFinalize(sfWebRequest $request)
    {
	    $requestparams=$request->getParameter('invoice');
	    $id=$requestparams['id'];
	    $invno=$requestparams['invno'];
	    
	    //validation
	    if(strpos($invno," ")!=false or strpos($invno,":")!=false or strpos($invno,"-")!=false)
	    {
            $message="Invalid invoice number";
            $this->getUser()->setFlash('error', $message);
            return $this->redirect($request->getReferer());
	    }
	    
	    //validate invno unique
        $duplicateinvoice=Doctrine_Query::create()
        ->from('Invoice i')
      	->where('i.invno = "'.$invno.'"')
      	->andWhere('i.id != "'.$id.'"')
      	->fetchOne();
      	if($duplicateinvoice!=false)
      	{
      		//new invno not unique: error msg and quit
            $message="Invoice ".$invno." already exists";
            $this->getUser()->setFlash('error', $message);
            return $this->redirect($request->getReferer());
      	}
	    
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i, i.Employee e, i.Terms t, i.Customer c')
      	->where('i.id = '.$id)
      	->fetchOne();

        $this->invoice->setIsTemporary(0);
        $this->invoice->setInvno($invno);
        $this->invoice->calc();
        $this->invoice->save();
        
        foreach($this->invoice->getInvoicedetail() as $detail)
        {
            $detail->updateStockentry();
        }

        $this->redirect($request->getReferer());
    }
  public function executeListnew(sfWebRequest $request)
  {
    $this->invoices=Doctrine_Query::create()
        ->from('Invoice i')
      	->where('is_temporary=2')
      	->execute();
  }
  public function executeListcheckedout(sfWebRequest $request)
  {
    $this->invoices=Doctrine_Query::create()
        ->from('Invoice i')
      	->where('is_temporary=1')
      	->execute();
  }
  public function executeListunpaid(sfWebRequest $request)
  {
    $this->invoices=Doctrine_Query::create()
        ->from('Invoice i')
      	->where('status!="Paid"')
      	->andWhere('status!="Cancelled"')
      	->andWhere('hidden=0')
      	->andWhere('is_temporary=0')
      	->execute();
  }
    public function executeSetinvno(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();

        $this->invoice->setInvno($request->getParameter('invno'));
        $this->invoice->save();

        $this->redirect($request->getReferer());
    }
    public function executeSetsaletype(sfWebRequest $request)
    {
        $requestparams=$request->getParameter('invoice');
        $id=$requestparams['id'];
        $saletype=$requestparams['saletype'];
    
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$id)
        ->fetchOne();

        $this->invoice->setSaleType($saletype);
        $this->invoice->calc();
        $this->invoice->save();

        $this->redirect($request->getReferer());
    }
    public function executeUndocheckout(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();

        $this->invoice->setIsTemporary(2);
        //$this->invoice->calc();
        $this->invoice->save();

        //$this->redirect($request->getReferer());
        $this->redirect("invoice/listcheckedout");
    }
    //this is Settemporarystate with validation and redirection
    public function executeCheckout(sfWebRequest $request)
    {
        $this->invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();

        $this->invoice->calc();

        //validation: must have invoicedetails and positive total
        if($this->invoice->getTotal()==0)
        {
            $message="Empty invoice";
            $this->getUser()->setFlash('error', $message);
        		return $this->redirect($request->getReferer());
        }

        $this->invoice->setIsTemporary(1);
        $this->invoice->save();

        //$this->redirect($request->getReferer());
        $this->redirect("home/index");
    }
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $invoice=$this->getRoute()->getObject();
    $details=$invoice->getInvoicedetail();
    foreach($details as $detail)
    {
        $detail->getStockentry()->delete();
        $detail->delete();
    }
    $result=$invoice->delete();
   
    if ($result)
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('home/index');
  }
  public function executeGeneratePurchase(sfWebRequest $request)
  {
        $invoice=Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.id = '.$request->getParameter('id'))
        ->fetchOne();

	//create purchase
	$purchase=new Purchase();
	$purchase->setDate(date("Y-m-d"));
	$purchase->setPono(date('h:i:s a'));
	$purchase->save();

	//create purchase details
	foreach($invoice->getInvoicedetail() as $invdetail)
	{
		$purchdetail=new PurchaseDetail();
		$purchdetail->setPurchaseId($purchase->getId());
		$purchdetail->setProductId($invdetail->getProductId());
		$purchdetail->setDescription($invdetail->getProduct()->getName());
		$purchdetail->setQty($invdetail->getQty());
		$purchdetail->setPrice(0);
		$purchdetail->setTotal(0);
		$purchdetail->setUnittotal(0);
		$purchdetail->save();
		$purchdetail->updateStockentry();
	}

        $this->redirect("purchase/view?id=".$purchase->getId());
  }
}



