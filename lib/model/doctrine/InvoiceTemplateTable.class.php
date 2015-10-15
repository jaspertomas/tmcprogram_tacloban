<?php


class InvoiceTemplateTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('InvoiceTemplate');
    }
    public static function fetch($id)
    {
      return Doctrine_Query::create()
        ->from('InvoiceTemplate t')
        ->where('id='.$id)
        ->fetchOne();
    }
}
