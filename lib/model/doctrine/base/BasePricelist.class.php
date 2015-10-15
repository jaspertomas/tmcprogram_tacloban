<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pricelist', 'doctrine');

/**
 * BasePricelist
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property date $date
 * @property integer $vendor_id
 * @property Vendor $Vendor
 * 
 * @method integer   getId()        Returns the current record's "id" value
 * @method string    getName()      Returns the current record's "name" value
 * @method date      getDate()      Returns the current record's "date" value
 * @method integer   getVendorId()  Returns the current record's "vendor_id" value
 * @method Vendor    getVendor()    Returns the current record's "Vendor" value
 * @method Pricelist setId()        Sets the current record's "id" value
 * @method Pricelist setName()      Sets the current record's "name" value
 * @method Pricelist setDate()      Sets the current record's "date" value
 * @method Pricelist setVendorId()  Sets the current record's "vendor_id" value
 * @method Pricelist setVendor()    Sets the current record's "Vendor" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePricelist extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pricelist');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
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
        $this->hasColumn('vendor_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Vendor', array(
             'local' => 'vendor_id',
             'foreign' => 'id'));
    }
}