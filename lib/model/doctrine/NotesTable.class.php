<?php


class notesTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('notes');
    }
    public static function fetch($id)
    {
      return Doctrine_Query::create()
        ->from('notes f')
        ->where('f.id='.$id)
        ->fetchOne();
    }
}
