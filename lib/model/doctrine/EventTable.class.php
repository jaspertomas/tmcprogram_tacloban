<?php


class EventTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Event');
    }

    public static function fetchByDate($date)
    {
      return Doctrine_Query::create()
        ->from('Event e')
        ->where('date="'.$date.'"')
        ->orderBy('e.date')
        ->execute();
    }
    public static function fetchByDatenParentclass($date,$parentclass)
    {
      return Doctrine_Query::create()
        ->from('Event e')
        ->where('date="'.$date.'"')
        ->andWhere('parent_class="'.$parentclass.'"')
        ->orderBy('e.date')
        ->execute();
    }
    public static function fetch($array)
    {
      $query= Doctrine_Query::create()
        ->from('Event e');
      
      foreach($array as $key=>$value)
        $query->andWhere($key.'="'.$value.'"');
        
        return $query->execute();
    }
    public static function generate($array)
    {
      $event=new Event();
      $event->setType($array["type"]);
      $event->setParentClass(get_class($array["parent"]));
      $event->setParentId($array["parent"]->getId());
      //$event->setParentName($array["parent_name"]);
      
      switch($array["type"])
      {
        case "Inventory":
          $parent=$event->getParent();
          
          //create stockentry
          if(get_class($parent)=="Invoicedetail")
            $stockentry=StockTable::createStockOut(SettingsTable::fetch("default_warehouse_id"),$parent->getProductId(),$parent->getQty(),$parent->getInvoice()->getDate(),$parent);
          else if(get_class($parent)=="Purchasedetail")
            $stockentry=StockTable::createStockIn(SettingsTable::fetch("default_warehouse_id"),$parent->getProductId(),$parent->getQty(),$parent->getPurchase()->getDate(),$parent);
          
          $event->setChildClass("Stockentry");
          $event->setChildrenId($stockentry->getId());
          
          break;
      }
      $event->save();
      
   }
}
