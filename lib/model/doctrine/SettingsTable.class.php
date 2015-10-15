<?php


class SettingsTable extends Doctrine_Table
{
    
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Settings');
  }
  public static function fetch($name)
  {
     $setting=Doctrine_Query::create()
        ->from('Settings e')
        ->where('e.name = "'.$name.'"')
        ->fetchOne();
     return $setting->getValue();
  }
  public static function fetchAll()
  {
     $settings=Doctrine_Query::create()
      ->from('Settings e')
      ->execute();
     $array=array();
     foreach($settings as $setting)
     {
      $array[$setting->getName()]=$setting->getValue();
     }
     return $array;
  }
}
