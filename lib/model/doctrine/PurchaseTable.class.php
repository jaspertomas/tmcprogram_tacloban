<?php


class PurchaseTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Purchase');
    }
    public static function fetchOneByInvno($invno)
    {
      return Doctrine_Query::create()
        ->from('Purchase i')
        ->where('pono="'.$pono.'"')
        ->fetchOne();
    }
    public static function fetchByDate($date)
    {
      return Doctrine_Query::create()
        ->from('Purchase i')
        ->where('date="'.$date.'"')
        ->orderBy('i.pono')
        ->execute();
    }
    public static function fetchByDateRange($fromdate,$todate)
    {
      return Doctrine_Query::create()
        ->from('Purchase i')
        ->where('i.date >= "'.$fromdate.'"')
        ->andWhere('i.date <= "'.$todate.'"')
        ->orderBy('i.pono')
        ->execute();
    }
}
