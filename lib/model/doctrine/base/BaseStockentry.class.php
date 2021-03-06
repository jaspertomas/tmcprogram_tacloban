<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Stockentry', 'doctrine');

/**
 * BaseStockentry
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property decimal $qty
 * @property decimal $balance
 * @property integer $stock_id
 * @property string $ref_class
 * @property integer $ref_id
 * @property integer $is_cancelled
 * @property integer $priority
 * @property string $type
 * @property string $description
 * @property Stock $Stock
 * 
 * @method integer    getId()           Returns the current record's "id" value
 * @method date       getDate()         Returns the current record's "date" value
 * @method decimal    getQty()          Returns the current record's "qty" value
 * @method decimal    getBalance()      Returns the current record's "balance" value
 * @method integer    getStockId()      Returns the current record's "stock_id" value
 * @method string     getRefClass()     Returns the current record's "ref_class" value
 * @method integer    getRefId()        Returns the current record's "ref_id" value
 * @method integer    getIsCancelled()  Returns the current record's "is_cancelled" value
 * @method integer    getPriority()     Returns the current record's "priority" value
 * @method string     getType()         Returns the current record's "type" value
 * @method string     getDescription()  Returns the current record's "description" value
 * @method Stock      getStock()        Returns the current record's "Stock" value
 * @method Stockentry setId()           Sets the current record's "id" value
 * @method Stockentry setDate()         Sets the current record's "date" value
 * @method Stockentry setQty()          Sets the current record's "qty" value
 * @method Stockentry setBalance()      Sets the current record's "balance" value
 * @method Stockentry setStockId()      Sets the current record's "stock_id" value
 * @method Stockentry setRefClass()     Sets the current record's "ref_class" value
 * @method Stockentry setRefId()        Sets the current record's "ref_id" value
 * @method Stockentry setIsCancelled()  Sets the current record's "is_cancelled" value
 * @method Stockentry setPriority()     Sets the current record's "priority" value
 * @method Stockentry setType()         Sets the current record's "type" value
 * @method Stockentry setDescription()  Sets the current record's "description" value
 * @method Stockentry setStock()        Sets the current record's "Stock" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStockentry extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('stockentry');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('qty', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('balance', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('stock_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('ref_class', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('ref_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('is_cancelled', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('priority', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('type', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('description', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Stock', array(
             'local' => 'stock_id',
             'foreign' => 'id'));
    }
}