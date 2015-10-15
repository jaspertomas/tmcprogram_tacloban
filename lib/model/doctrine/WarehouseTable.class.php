<?php


class WarehouseTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Warehouse');
    }
    public static function fetchAll()
    {
        return Doctrine_Query::create()
      ->from('Warehouse w')
      ->orderBy("name")
      ->execute();
    }
    public static function fetchById($id)
    {
       $stock = Doctrine_Query::create()
        ->from('Warehouse s')
        ->where('s.id ='.$warehouse_id)
        ->fetchOne();
    }
}
