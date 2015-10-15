<?php


class PurchaseTemplateTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PurchaseTemplate');
    }
    public static function fetch($id)
    {
      return Doctrine_Query::create()
        ->from('PurchaseTemplate t')
        ->where('id='.$id)
        ->fetchOne();
    }
}
