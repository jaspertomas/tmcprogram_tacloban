<?php


class ProductTable extends Doctrine_Table
{
    
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Product');
  }
  public static function fetch($id)
  {
    return Doctrine_Query::create()
      ->from('product p')
      ->where('p.id = '.$id)
      ->fetchOne();
  }
}
