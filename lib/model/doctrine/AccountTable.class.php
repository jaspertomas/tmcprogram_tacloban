<?php


class AccountTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Account');
    }
    public static function fetchById($id)
    {
       return Doctrine_Query::create()
        ->from('Account s')
        ->where('s.id ='.$id)
        ->fetchOne();
    }
    public static function fetch($warehouse_id, $product_id)
    {
       $account = Doctrine_Query::create()
        ->from('Account s')
        ->where('s.warehouse_id ='.$warehouse_id)
        ->andWhere('s.product_id ='.$product_id)
        ->fetchOne();
       if(!$account)
       {
          $account=new Account();
          $account->setWarehouseId($warehouse_id);
          $account->setProductId($product_id);
          $account->setCurrentqty(0);
          $account->setDate("2011-01-01");
          $account->save();
       }
       return $account;
    }
}
