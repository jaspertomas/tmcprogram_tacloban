<?php


class StockTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
      return Doctrine_Core::getTable('Stock');
    }
    public static function fetchById($id)
    {
       return Doctrine_Query::create()
        ->from('Stock s')
        ->where('s.id ='.$id)
        ->fetchOne();
    }
    public static function fetch($warehouse_id, $product_id)
    {
       $stock = Doctrine_Query::create()
        ->from('Stock s')
        ->where('s.warehouse_id ='.$warehouse_id)
        ->andWhere('s.product_id ='.$product_id)
        ->fetchOne();
       if(!$stock)
       {
          $stock=new Stock();
          $stock->setWarehouseId($warehouse_id);
          $stock->setProductId($product_id);
          $stock->setCurrentqty(0);
          $stock->setDate("2011-01-01");
          $stock->save();
       }
       return $stock;
    }
    /*
    public static function createStockIn($warehouse_id, $product_id,$qty,$date,$ref=null)
    {
      $ref_id=null;
      $ref_class=null;
      if($ref)
      {
        $ref_id=$ref->getId();
        $ref_class=get_class($ref);
      }
      //fetch stock
      $stock=StockTable::fetch($warehouse_id, $product_id);
      $stockentry=$stock->createEntry(array(
        'qty'=>$qty,
        'date'=>$date,
        'ref_id'=>$ref_id,
        'ref_class'=>$ref_class,
        ));
      return $stockentry;
    }
    public static function createStockOut($warehouse_id, $product_id,$qty,$date,$ref=null)
    {
      return StockTable::createStockIn($warehouse_id, $product_id,$qty*-1,$date,$ref);
    }
    public static function createStockTrans($from_warehouse_id, $to_warehouse_id, $product_id,$qty)
    {
      StockTable::createStockIn($to_warehouse_id, $product_id,$qty,$date,$ref);
      StockTable::createStockOut($from_warehouse_id, $product_id,$qty,$date,$ref);
    }*/
}
