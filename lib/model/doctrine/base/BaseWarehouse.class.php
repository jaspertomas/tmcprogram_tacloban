<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Warehouse', 'doctrine');

/**
 * BaseWarehouse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Stock
 * 
 * @method integer             getId()    Returns the current record's "id" value
 * @method string              getName()  Returns the current record's "name" value
 * @method Doctrine_Collection getStock() Returns the current record's "Stock" collection
 * @method Warehouse           setId()    Sets the current record's "id" value
 * @method Warehouse           setName()  Sets the current record's "name" value
 * @method Warehouse           setStock() Sets the current record's "Stock" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWarehouse extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('warehouse');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 30,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Stock', array(
             'local' => 'id',
             'foreign' => 'warehouse_id'));
    }
}