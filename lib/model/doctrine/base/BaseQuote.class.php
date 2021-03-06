<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Quote', 'doctrine');

/**
 * BaseQuote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property integer $vendor_id
 * @property integer $product_id
 * @property decimal $price
 * @property string $discrate
 * @property decimal $discamt
 * @property string $ref_class
 * @property integer $ref_id
 * @property decimal $total
 * @property integer $mine
 * @property integer $is_cancelled
 * @property Vendor $Vendor
 * @property Product $Product
 * 
 * @method integer getId()           Returns the current record's "id" value
 * @method date    getDate()         Returns the current record's "date" value
 * @method integer getVendorId()     Returns the current record's "vendor_id" value
 * @method integer getProductId()    Returns the current record's "product_id" value
 * @method decimal getPrice()        Returns the current record's "price" value
 * @method string  getDiscrate()     Returns the current record's "discrate" value
 * @method decimal getDiscamt()      Returns the current record's "discamt" value
 * @method string  getRefClass()     Returns the current record's "ref_class" value
 * @method integer getRefId()        Returns the current record's "ref_id" value
 * @method decimal getTotal()        Returns the current record's "total" value
 * @method integer getMine()         Returns the current record's "mine" value
 * @method integer getIsCancelled()  Returns the current record's "is_cancelled" value
 * @method Vendor  getVendor()       Returns the current record's "Vendor" value
 * @method Product getProduct()      Returns the current record's "Product" value
 * @method Quote   setId()           Sets the current record's "id" value
 * @method Quote   setDate()         Sets the current record's "date" value
 * @method Quote   setVendorId()     Sets the current record's "vendor_id" value
 * @method Quote   setProductId()    Sets the current record's "product_id" value
 * @method Quote   setPrice()        Sets the current record's "price" value
 * @method Quote   setDiscrate()     Sets the current record's "discrate" value
 * @method Quote   setDiscamt()      Sets the current record's "discamt" value
 * @method Quote   setRefClass()     Sets the current record's "ref_class" value
 * @method Quote   setRefId()        Sets the current record's "ref_id" value
 * @method Quote   setTotal()        Sets the current record's "total" value
 * @method Quote   setMine()         Sets the current record's "mine" value
 * @method Quote   setIsCancelled()  Sets the current record's "is_cancelled" value
 * @method Quote   setVendor()       Sets the current record's "Vendor" value
 * @method Quote   setProduct()      Sets the current record's "Product" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseQuote extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('quote');
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
        $this->hasColumn('vendor_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('product_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('price', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('discrate', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('discamt', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('ref_class', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('ref_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('mine', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Vendor', array(
             'local' => 'vendor_id',
             'foreign' => 'id'));

        $this->hasOne('Product', array(
             'local' => 'product_id',
             'foreign' => 'id'));
    }
}