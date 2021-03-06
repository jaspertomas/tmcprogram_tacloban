<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Customer', 'doctrine');

/**
 * BaseCustomer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $tin_no
 * @property string $address
 * @property string $phone1
 * @property string $phone2
 * @property string $faxnum
 * @property string $email
 * @property string $note
 * @property string $rep
 * @property string $repno
 * @property string $rep2
 * @property string $rep2no
 * @property string $taxitem
 * @property string $notepad
 * @property string $salutation
 * @property integer $is_suki
 * @property Doctrine_Collection $Invoice
 * 
 * @method integer             getId()         Returns the current record's "id" value
 * @method string              getName()       Returns the current record's "name" value
 * @method string              getTinNo()      Returns the current record's "tin_no" value
 * @method string              getAddress()    Returns the current record's "address" value
 * @method string              getPhone1()     Returns the current record's "phone1" value
 * @method string              getPhone2()     Returns the current record's "phone2" value
 * @method string              getFaxnum()     Returns the current record's "faxnum" value
 * @method string              getEmail()      Returns the current record's "email" value
 * @method string              getNote()       Returns the current record's "note" value
 * @method string              getRep()        Returns the current record's "rep" value
 * @method string              getRepno()      Returns the current record's "repno" value
 * @method string              getRep2()       Returns the current record's "rep2" value
 * @method string              getRep2no()     Returns the current record's "rep2no" value
 * @method string              getTaxitem()    Returns the current record's "taxitem" value
 * @method string              getNotepad()    Returns the current record's "notepad" value
 * @method string              getSalutation() Returns the current record's "salutation" value
 * @method integer             getIsSuki()     Returns the current record's "is_suki" value
 * @method Doctrine_Collection getInvoice()    Returns the current record's "Invoice" collection
 * @method Customer            setId()         Sets the current record's "id" value
 * @method Customer            setName()       Sets the current record's "name" value
 * @method Customer            setTinNo()      Sets the current record's "tin_no" value
 * @method Customer            setAddress()    Sets the current record's "address" value
 * @method Customer            setPhone1()     Sets the current record's "phone1" value
 * @method Customer            setPhone2()     Sets the current record's "phone2" value
 * @method Customer            setFaxnum()     Sets the current record's "faxnum" value
 * @method Customer            setEmail()      Sets the current record's "email" value
 * @method Customer            setNote()       Sets the current record's "note" value
 * @method Customer            setRep()        Sets the current record's "rep" value
 * @method Customer            setRepno()      Sets the current record's "repno" value
 * @method Customer            setRep2()       Sets the current record's "rep2" value
 * @method Customer            setRep2no()     Sets the current record's "rep2no" value
 * @method Customer            setTaxitem()    Sets the current record's "taxitem" value
 * @method Customer            setNotepad()    Sets the current record's "notepad" value
 * @method Customer            setSalutation() Sets the current record's "salutation" value
 * @method Customer            setIsSuki()     Sets the current record's "is_suki" value
 * @method Customer            setInvoice()    Sets the current record's "Invoice" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomer extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('customer');
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
        $this->hasColumn('tin_no', 'string', 15, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 15,
             ));
        $this->hasColumn('address', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('phone1', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('phone2', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
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
        $this->hasColumn('note', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('rep', 'string', 60, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('repno', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('rep2', 'string', 60, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('rep2no', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('taxitem', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('notepad', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('salutation', 'string', 60, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('is_suki', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Invoice', array(
             'local' => 'id',
             'foreign' => 'customer_id'));
    }
}