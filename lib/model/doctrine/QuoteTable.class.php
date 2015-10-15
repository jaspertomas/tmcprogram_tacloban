<?php


class QuoteTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Quote');
    }
    public static function createOne($array)
    {
    	$quote=new Quote();
    	foreach($array as $key=>$value)
    	{
    		$quote[$key]=$value;
    	}
    	$quote->calc();//automatic save
    	//$quote->save();
      return $quote;
    }
}
