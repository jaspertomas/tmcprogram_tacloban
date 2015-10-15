<?php


class producttypeTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('producttype');
    }
    public static function fetch($id)
    {
      return Doctrine_Query::create()
        ->from('producttype f')
        ->where('f.id='.$id)
        ->fetchOne();
    }
}
