<?php


class JournalEntryTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('JournalEntry');
    }
}