<?php

/**
 * Stock
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Stock extends BaseStock
{

  public function getStockentries()
  {
      return Doctrine_Query::create()
        ->from('Stockentry e')
        ->where('e.stock_id = '.$this->getId())
      	->andWhere('e.is_cancelled = 0')
        ->orderBy('date, priority')
        ->execute();
  }
  //this is used for display
  public function getStockentriesDesc()
  {
      return Doctrine_Query::create()
        ->from('Stockentry e')
        ->where('e.stock_id = '.$this->getId())
      	->andWhere('e.is_cancelled = 0')
        ->orderBy('date desc, priority desc')
        ->execute();
  }
  public function getLastEntry()
  {
      return Doctrine_Query::create()
        ->from('Stockentry e')
        ->where('e.stock_id = '.$this->getId())
      	->andWhere('e.is_cancelled = 0')
        ->orderBy('date desc, priority desc')
        ->fetchOne();
  }
  public function getFirstEntry()
  {
      return Doctrine_Query::create()
        ->from('Stockentry e')
        ->where('e.stock_id = '.$this->getId())
      	->andWhere('e.is_cancelled = 0')
        ->orderBy('date, priority')
        ->fetchOne();
  }
  public function updateFromLastEntry($last=null)
  {
    if($last==null)
      $last=$this->getLastEntry();

    //if no records found at all
    if($last==null)
    {
      $this->setCurrentqty(0);
    }
    else
    {
      $this->setCurrentqty($last->getBalance());
      $this->setDate($last->getDate());
    }

    //don't save. Let client code do that.
  }
  public function calcFromStockentry($entry=null)
  {
      if($entry==null)
      {
        $entry=$this->getFirstEntry();
        //if no entries at all, just set currentqty to 0 and return
        if(!$entry)
        {
          $this->setCurrentqty(0);
          $this->save();
          return;
        }

        //check against balance being null, if so, set to qty
        if($entry->getBalance()==null)
        {
          $entry->setBalance($entry->getQty());
          $entry->save();
        }
      }
      //current entry has no balance. find nearest previous entry with balance, and calc from that.
      else if($entry->getBalance()==null)
      {
        //this cannot be. 
        //either use an earlier entry
        //or set balance to qty if none

        //look for earlier entry with balance not null
        $balnotnullentry=$entry->getPreviousWithBalanceNotNull();

        //if not found, set current entry's balance to qty
        if(!$balnotnullentry){$entry->setBalance($entry->getQty());$entry->save();}
        //if found, let it be the new starting entry
        else $entry=$balnotnullentry;
      }
  
      //this will give you all entries from the given entry's date onward
      $entries= Doctrine_Query::create()
        ->from('Stockentry e')
        ->where('e.stock_id = '.$this->getId())
      	->andWhere('e.is_cancelled = 0')
      	->andWhere('e.date >= "'.$entry->getDate().'"')
        ->orderBy('date, priority')
        ->execute();

      //use first entry as balforward
      $first=$entries[0];
      $balance=$first->getBalance();
      
      //recalc balance for all entries except the first
       foreach($entries as $index=>$entry)
       {
        //ignore first record
        if($index==0)continue;

        //trying to save the effort of save()ing if there are no changes to save
        $balance=$balance+$entry->getQty();
        if($entry->getBalance()!=$balance)
        {
          $entry->setBalance($balance);
          $entry->save();
        }
        
       }

    //copy balance of last entry to stock
    $last=$entries[count($entries)-1];
    $this->updateFromLastEntry($last);

    $this->save();
  }
  public function calc()
  {
    $stockentries=$this->getStockentries();
    if(count($stockentries)==0)return;

    $priority=1;
    $date=$stockentries[0]->getDate();

    $balance=0;
    
    //for each entry, 
    //calc balance as balance + qty

    //calc priority:
    //if date is same as previous, 
      //set priority to previous priority+1, 
    //else 
      //set priority to 1
    foreach($stockentries as $index=>$entry)
    {
      $saveneeded=false;
      
      //calc and set balance
      $balance+=$entry->getQty();
        //to speed up process
        //save only if necessary
      if($entry->getBalance()!=$balance)
      {
          $entry->setBalance($balance);
          $saveneeded=true;
      }

      //calc and set priority
      if($date==$entry->getDate())
      {
        //to speed up process
        //save only if necessary
        if($entry->getPriority()!=$priority)
        {
            $entry->setPriority($priority);
            $saveneeded=true;
        }
      }
      else
      {
        $date=$entry->getDate();
        $priority=1;
        //to speed up process
        //save only if necessary
        if($entry->getPriority()!=$priority)
        {
            $entry->setPriority($priority);
            $saveneeded=true;
        }
      }
      if($saveneeded)
      {
          $entry->save();
      }
      $priority++;
    }
    $this->setCurrentqty($balance);
    $this->save();
  }

  public function delete(Doctrine_Connection $conn=null)
  {
    foreach($this->getStockentries() as $entry)
      $entry->cascadeDelete($conn);
      
    return parent::delete($conn);
  }
  //delete is in stockentry.class.php
  function addEntry($date, $qty, $ref_class=null, $ref_id=null, $type=null, $description=null)
  {
    $entry=new Stockentry();
    
    $entry->setDate($date);
    $entry->setQty($qty);
    $entry->setRefClass($ref_class);
    $entry->setRefId($ref_id);
    //add custom fields here
    $entry->setType($type);
    $entry->setDescription($description);
    
    $entry->setStockId($this->getId());

    //get last entry at the point of date given
    $previous=$this->getLastEntryForDate($date);
    if($previous)
    {//echo "gotchaa";
      $entry->setBalance($previous->getBalance()+$qty);

      //if the same date as previous, 
      if(MyDateTime::frommysql($entry->getDate())->isequalto(MyDateTime::frommysql($previous->getDate())))
        $entry->setPriority($previous->getPriority()+1);
      //else, priority is 1
      else
        $entry->setPriority(1);
      $entry->save();
    }
    else
    {//echo "gotchab";
      //add as first entry
      $entry->setPriority(1);
      $entry->setBalance($qty);
      $entry->save();
    }

    $this->calcFromStockEntry($entry);

    return $entry;
  }
  public function getLastEntryForDate($date)
  {
     return Doctrine_Query::create()
        ->from('Stockentry se')
        ->orderBy('date desc, priority desc')
        ->where('stock_id ='.$this->getId())
        ->andWhere('date <= "'.$date.'"')
        ->fetchOne();
  }
  public function testEntries()
  {
    $noproblem=true;
     $entries= Doctrine_Query::create()
        ->from('Stockentry se')
        ->orderBy('date, priority')
        ->where('stock_id ='.$this->getId())
        ->execute();

    if(count($entries)==0)
    {
      if($this->getCurrentqty()!=0){echo "Stock currentqty incorrect";$noproblem=false;}
      return $noproblem;
    }

    $last=$entries[count($entries)-1];

    $balance=0;
    $priority=1;
    $date="";
    foreach($entries as $index=>$entry)
    {
      $balance+=$entry->getQty();
      if($entry->getBalance()!=$balance){echo "Entry with id ".$entry->getId().": balance incorrect";$noproblem=false;}

       //calc and set priority
      if($date==$entry->getDate())
      {
        if($entry->getPriority()!=$priority){echo "Entry with id ".$entry->getId().": priority incorrect";$noproblem=false;}
      }
      else
      {
        $date=$entry->getDate();
        $priority=1;
        //greater than or equal is ok
        if($entry->getPriority()<$priority){echo "Entry with id ".$entry->getId().": priority incorrect";$noproblem=false;}

        //if greater than, adjust
        if($entry->getPriority()!=$priority)$priority=$entry->getPriority();
      }
      $priority++;
    }

    if($last->getBalance()!=$this->getCurrentqty()){echo "Stock currentqty incorrect";$noproblem=false;}
    if($last->getDate()!=$this->getDate()){echo "Stock date incorrect";$noproblem=false;}
    
    return $noproblem;
  }
}
