<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Invoicedetail', 'doctrine');

/**
 * BaseInvoicedetail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $product_id
 * @property string $barcode
 * @property string $description
 * @property decimal $qty
 * @property decimal $price
 * @property decimal $total
 * @property string $discrate
 * @property decimal $discamt
 * @property decimal $unittotal
 * @property integer $is_cancelled
 * @property Invoice $Invoice
 * @property Product $Product
 * 
 * @method integer       getId()           Returns the current record's "id" value
 * @method integer       getInvoiceId()    Returns the current record's "invoice_id" value
 * @method integer       getProductId()    Returns the current record's "product_id" value
 * @method string        getBarcode()      Returns the current record's "barcode" value
 * @method string        getDescription()  Returns the current record's "description" value
 * @method decimal       getQty()          Returns the current record's "qty" value
 * @method decimal       getPrice()        Returns the current record's "price" value
 * @method decimal       getTotal()        Returns the current record's "total" value
 * @method string        getDiscrate()     Returns the current record's "discrate" value
 * @method decimal       getDiscamt()      Returns the current record's "discamt" value
 * @method decimal       getUnittotal()    Returns the current record's "unittotal" value
 * @method integer       getIsCancelled()  Returns the current record's "is_cancelled" value
 * @method Invoice       getInvoice()      Returns the current record's "Invoice" value
 * @method Product       getProduct()      Returns the current record's "Product" value
 * @method Invoicedetail setId()           Sets the current record's "id" value
 * @method Invoicedetail setInvoiceId()    Sets the current record's "invoice_id" value
 * @method Invoicedetail setProductId()    Sets the current record's "product_id" value
 * @method Invoicedetail setBarcode()      Sets the current record's "barcode" value
 * @method Invoicedetail setDescription()  Sets the current record's "description" value
 * @method Invoicedetail setQty()          Sets the current record's "qty" value
 * @method Invoicedetail setPrice()        Sets the current record's "price" value
 * @method Invoicedetail setTotal()        Sets the current record's "total" value
 * @method Invoicedetail setDiscrate()     Sets the current record's "discrate" value
 * @method Invoicedetail setDiscamt()      Sets the current record's "discamt" value
 * @method Invoicedetail setUnittotal()    Sets the current record's "unittotal" value
 * @method Invoicedetail setIsCancelled()  Sets the current record's "is_cancelled" value
 * @method Invoicedetail setInvoice()      Sets the current record's "Invoice" value
 * @method Invoicedetail setProduct()      Sets the current record's "Product" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvoicedetail extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('invoicedetail');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('invoice_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
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
        $this->hasColumn('barcode', 'string', 13, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 13,
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
        $this->hasColumn('qty', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('price', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => false,
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
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('discamt', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('unittotal', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
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
        $this->hasOne('Invoice', array(
             'local' => 'invoice_id',
             'foreign' => 'id'));

        $this->hasOne('Product', array(
             'local' => 'product_id',
             'foreign' => 'id'));
    }
}