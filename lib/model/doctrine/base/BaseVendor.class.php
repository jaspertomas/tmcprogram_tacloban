<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Vendor', 'doctrine');

/**
 * BaseVendor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $addr1
 * @property string $addr2
 * @property string $addr3
 * @property string $vtype
 * @property string $cont1
 * @property string $cont2
 * @property string $phone1
 * @property string $phone2
 * @property string $faxnum
 * @property string $email
 * @property string $note
 * @property string $taxid
 * @property Doctrine_Collection $Pricelist
 * @property Doctrine_Collection $Purchase
 * @property Doctrine_Collection $Quote
 * 
 * @method integer             getId()        Returns the current record's "id" value
 * @method string              getName()      Returns the current record's "name" value
 * @method string              getAddr1()     Returns the current record's "addr1" value
 * @method string              getAddr2()     Returns the current record's "addr2" value
 * @method string              getAddr3()     Returns the current record's "addr3" value
 * @method string              getVtype()     Returns the current record's "vtype" value
 * @method string              getCont1()     Returns the current record's "cont1" value
 * @method string              getCont2()     Returns the current record's "cont2" value
 * @method string              getPhone1()    Returns the current record's "phone1" value
 * @method string              getPhone2()    Returns the current record's "phone2" value
 * @method string              getFaxnum()    Returns the current record's "faxnum" value
 * @method string              getEmail()     Returns the current record's "email" value
 * @method string              getNote()      Returns the current record's "note" value
 * @method string              getTaxid()     Returns the current record's "taxid" value
 * @method Doctrine_Collection getPricelist() Returns the current record's "Pricelist" collection
 * @method Doctrine_Collection getPurchase()  Returns the current record's "Purchase" collection
 * @method Doctrine_Collection getQuote()     Returns the current record's "Quote" collection
 * @method Vendor              setId()        Sets the current record's "id" value
 * @method Vendor              setName()      Sets the current record's "name" value
 * @method Vendor              setAddr1()     Sets the current record's "addr1" value
 * @method Vendor              setAddr2()     Sets the current record's "addr2" value
 * @method Vendor              setAddr3()     Sets the current record's "addr3" value
 * @method Vendor              setVtype()     Sets the current record's "vtype" value
 * @method Vendor              setCont1()     Sets the current record's "cont1" value
 * @method Vendor              setCont2()     Sets the current record's "cont2" value
 * @method Vendor              setPhone1()    Sets the current record's "phone1" value
 * @method Vendor              setPhone2()    Sets the current record's "phone2" value
 * @method Vendor              setFaxnum()    Sets the current record's "faxnum" value
 * @method Vendor              setEmail()     Sets the current record's "email" value
 * @method Vendor              setNote()      Sets the current record's "note" value
 * @method Vendor              setTaxid()     Sets the current record's "taxid" value
 * @method Vendor              setPricelist() Sets the current record's "Pricelist" collection
 * @method Vendor              setPurchase()  Sets the current record's "Purchase" collection
 * @method Vendor              setQuote()     Sets the current record's "Quote" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVendor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vendor');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('addr1', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
        $this->hasColumn('addr2', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
        $this->hasColumn('addr3', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
        $this->hasColumn('vtype', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('cont1', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('cont2', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('phone1', 'string', 300, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 300,
             ));
        $this->hasColumn('phone2', 'string', 300, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 300,
             ));
        $this->hasColumn('faxnum', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('email', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('note', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('taxid', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Pricelist', array(
             'local' => 'id',
             'foreign' => 'vendor_id'));

        $this->hasMany('Purchase', array(
             'local' => 'id',
             'foreign' => 'vendor_id'));

        $this->hasMany('Quote', array(
             'local' => 'id',
             'foreign' => 'vendor_id'));
    }
}