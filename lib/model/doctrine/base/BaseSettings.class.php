<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Settings', 'doctrine');

/**
 * BaseSettings
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $value
 * 
 * @method integer  getId()    Returns the current record's "id" value
 * @method string   getName()  Returns the current record's "name" value
 * @method string   getValue() Returns the current record's "value" value
 * @method Settings setId()    Sets the current record's "id" value
 * @method Settings setName()  Sets the current record's "name" value
 * @method Settings setValue() Sets the current record's "value" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSettings extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('settings');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('value', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}