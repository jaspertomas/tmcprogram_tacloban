<?php


class InvoiceTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Invoice');
    }
    public static function fetchOneByInvno($invno)
    {
      return Doctrine_Query::create()
        ->from('Invoice i')
        ->where('invno="'.$invno.'"')
        ->fetchOne();
    }
    public static function fetchByDate($date)
    {
      return Doctrine_Query::create()
        ->from('Invoice i')
        ->where('date="'.$date.'"')
        ->orderBy('i.invno')
        ->execute();
    }
    public static function fetchByDateRange($fromdate,$todate)
    {
      return Doctrine_Query::create()
        ->from('Invoice i')
        ->where('i.date >= "'.$fromdate.'"')
        ->andWhere('i.date <= "'.$todate.'"')
        ->orderBy('i.invno')
        ->execute();
    }
}
