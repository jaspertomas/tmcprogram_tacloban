<?php

require_once dirname(__FILE__).'/../lib/pettycashGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pettycashGeneratorHelper.class.php';

/**
 * pettycash actions.
 *
 * @package    sf_sandbox
 * @subpackage pettycash
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pettycashActions extends autoPettycashActions
{
  public function executeSearch(sfWebRequest $request)
  {
    $query=Doctrine_Query::create()
        ->from('Pettycash i')
      	->where('i.pettycashno = '.trim($request->getParameter("searchstring")));

  	$results=$query->execute();
  	
  	if(count($results)==1)
  	{
			$this->pettycash=$results[0];
  		$this->redirect("pettycash/view?id=".$this->pettycash->getId());
  	}
  	else
  		$this->redirect("pettycash/new?pettycashno=".$request->getParameter("searchstring"));
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->pettycash = new Pettycash();
    $this->pettycash->setDate(MyDateTime::today()->tomysql());
    if($request->getParameter("pettycashno"))
      $this->pettycash->setPettycashno($request->getParameter("pettycashno"));
    $this->form = $this->configuration->getForm($this->pettycash);
  }
/*  public function executeDsr(sfWebRequest $request)
  {
    $requestparams=$request->getParameter("pettycash");
    $day=$requestparams["date"]["day"];
    $month=$requestparams["date"]["month"];
    $year=$requestparams["date"]["year"];
    $pettycash=new Pettycash();
    if(!$day or !$month or !$year)
      $pettycash->setDate(MyDate::today());
    else
      $pettycash->setDate($year."-".$month."-".$day);

    $this->form=new PettycashForm($pettycash);
  
    $this->pettycashs = PettycashTable::fetchByDate($pettycash->getDate());
    $this->events = EventTable::fetchByDatenParentclass($pettycash->getDate(),"Pettycash");

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
      foreach($this->pettycashs as $pettycash)
      {
        $this->cashsales+=$pettycash->getCash();
        $this->chequesales+=$pettycash->getCheque();
        $this->creditsales+=$pettycash->getCredit();
        $this->cashtotal+=$pettycash->getCash();
        $this->chequetotal+=$pettycash->getCheque();
        $this->credittotal+=$pettycash->getCredit();
        //$this->deducttotal+=$pettycash->getDsrdeduction();
      }
      foreach($this->events as $event)
      {
        $this->cashother+=$event->getDetail("cashamt");
        $this->chequeother+=$event->getDetail("cheque");
        $this->creditother+=$event->getDetail("creditamt");
        $this->cashtotal+=$event->getDetail("cashamt");
        $this->chequetotal+=$event->getDetail("cheque");
        $this->credittotal+=$event->getDetail("creditamt");
        //$this->deducttotal+=$event->getDetail3();
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
  function today() { 
    $today = getdate(); 
    return $today['year']."-".$today['mon']."-".$today['mday'];
    }
  public function executeView(sfWebRequest $request)
  {
    $this->pettycash=Doctrine_Query::create()
        ->from('Pettycash i, i.Employee e, i.Terms t, i.Vendor s')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();

    $this->form = $this->configuration->getForm($this->pettycash);

    //allow set product id by url
    $detail=new Pettycashdetail();
    $detail->setQty(1);
    if($request->getParameter("product_id"))
      $detail->setProductId($request->getParameter("product_id"));
    $this->detailform = new PettycashdetailForm($detail); 
  }
  public function executeAccounting(sfWebRequest $request)
  {
    $this->pettycash=Doctrine_Query::create()
        ->from('Pettycash i, i.Employee e, i.Terms t, i.Vendor s')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();
    $this->form = $this->configuration->getForm($this->pettycash);

    $this->accountentries=$this->pettycash->getAccountentries(true);
    $this->totalsbyaccount=array();

    foreach($this->pettycash->getAccountids() as $id)
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
    $this->pettycash=Doctrine_Query::create()
        ->from('Pettycash i, i.Employee e, i.Terms t, i.Vendor s')
      	->where('i.id = '.$request->getParameter('id'))
      	->fetchOne();
    $this->form = $this->configuration->getForm($this->pettycash);
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $isnew=$form->getObject()->isNew();
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $pettycash = $form->save();
        $pettycash->calc();
        $pettycash->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pettycash)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@pettycash_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('pettycash/view?id='.$pettycash->getId());
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
        ->from('Pettycash i')
      	->where('i.pono = '.trim($request->getParameter("searchstring")));

  	$results=$query->execute();
  	
  	if(count($results)==1)
  	{
			$this->pettycash=$results[0];
  		$this->redirect("pettycash/view?id=".$this->pettycash->getId());
  	}
  	else
  		$this->redirect("pettycash/new?pono=".$request->getParameter("searchstring"));


  }
  public function executeAdjusttype(sfWebRequest $request)
  {
    $pettycash = $this->getRoute()->getObject();

    //set
    //save
    //calc
    $pettycash->setType($request->getParameter("type"));
    $pettycash->calc();
    $pettycash->save();
    
    $this->redirect($request->getReferer());
  }
  public function executeBarcode(sfWebRequest $request)
  {
    $this->pettycash = $this->getRoute()->getObject();

    $this->details=$this->pettycash->getPettycashdetail();

    $this->start=1;

  }
  public function executeBarcodepdf(sfWebRequest $request)
  {
    
    $this->start=$request->getParameter("start");
    $qty=$request->getParameter("qty");

    $this->pettycash_id=$request->getParameter("id");
    $this->pettycash = Doctrine_Query::create()
      ->from('Pettycash p')
      ->where('id = '.$this->pettycash_id)
      ->fetchOne();
    $details=$this->pettycash->getPettycashdetail();


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
  */
}
