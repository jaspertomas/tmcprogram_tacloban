<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Invoice', 'doctrine');

/**
 * BaseInvoice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $invno
 * @property string $ponumber
 * @property string $notes
 * @property decimal $payonly
 * @property decimal $total
 * @property string $cheque
 * @property date $chequedate
 * @property date $date
 * @property date $duedate
 * @property date $datepaid
 * @property integer $terms_id
 * @property integer $salesman_id
 * @property integer $technician_id
 * @property integer $template_id
 * @property decimal $cash
 * @property decimal $chequeamt
 * @property decimal $credit
 * @property string $discrate
 * @property decimal $discamt
 * @property enum $saletype
 * @property enum $status
 * @property decimal $dsrdeduction
 * @property decimal $balance
 * @property string $chequedata
 * @property date $checkcleardate
 * @property integer $checkcollectevents
 * @property integer $hidden
 * @property integer $is_inspected
 * @property Customer $Customer
 * @property Employee $Employee
 * @property InvoiceTemplate $InvoiceTemplate
 * @property Terms $Terms
 * @property Doctrine_Collection $Invoicedetail
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method integer             getCustomerId()         Returns the current record's "customer_id" value
 * @method string              getCustomerName()       Returns the current record's "customer_name" value
 * @method string              getInvno()              Returns the current record's "invno" value
 * @method string              getPonumber()           Returns the current record's "ponumber" value
 * @method string              getNotes()              Returns the current record's "notes" value
 * @method decimal             getPayonly()            Returns the current record's "payonly" value
 * @method decimal             getTotal()              Returns the current record's "total" value
 * @method string              getCheque()             Returns the current record's "cheque" value
 * @method date                getChequedate()         Returns the current record's "chequedate" value
 * @method date                getDate()               Returns the current record's "date" value
 * @method date                getDuedate()            Returns the current record's "duedate" value
 * @method date                getDatepaid()           Returns the current record's "datepaid" value
 * @method integer             getTermsId()            Returns the current record's "terms_id" value
 * @method integer             getSalesmanId()         Returns the current record's "salesman_id" value
 * @method integer             getTechnicianId()       Returns the current record's "technician_id" value
 * @method integer             getTemplateId()         Returns the current record's "template_id" value
 * @method decimal             getCash()               Returns the current record's "cash" value
 * @method decimal             getChequeamt()          Returns the current record's "chequeamt" value
 * @method decimal             getCredit()             Returns the current record's "credit" value
 * @method string              getDiscrate()           Returns the current record's "discrate" value
 * @method decimal             getDiscamt()            Returns the current record's "discamt" value
 * @method enum                getSaletype()           Returns the current record's "saletype" value
 * @method enum                getStatus()             Returns the current record's "status" value
 * @method decimal             getDsrdeduction()       Returns the current record's "dsrdeduction" value
 * @method decimal             getBalance()            Returns the current record's "balance" value
 * @method string              getChequedata()         Returns the current record's "chequedata" value
 * @method date                getCheckcleardate()     Returns the current record's "checkcleardate" value
 * @method integer             getCheckcollectevents() Returns the current record's "checkcollectevents" value
 * @method integer             getHidden()             Returns the current record's "hidden" value
 * @method integer             getIsInspected()        Returns the current record's "is_inspected" value
 * @method Customer            getCustomer()           Returns the current record's "Customer" value
 * @method Employee            getEmployee()           Returns the current record's "Employee" value
 * @method InvoiceTemplate     getInvoiceTemplate()    Returns the current record's "InvoiceTemplate" value
 * @method Terms               getTerms()              Returns the current record's "Terms" value
 * @method Doctrine_Collection getInvoicedetail()      Returns the current record's "Invoicedetail" collection
 * @method Invoice             setId()                 Sets the current record's "id" value
 * @method Invoice             setCustomerId()         Sets the current record's "customer_id" value
 * @method Invoice             setCustomerName()       Sets the current record's "customer_name" value
 * @method Invoice             setInvno()              Sets the current record's "invno" value
 * @method Invoice             setPonumber()           Sets the current record's "ponumber" value
 * @method Invoice             setNotes()              Sets the current record's "notes" value
 * @method Invoice             setPayonly()            Sets the current record's "payonly" value
 * @method Invoice             setTotal()              Sets the current record's "total" value
 * @method Invoice             setCheque()             Sets the current record's "cheque" value
 * @method Invoice             setChequedate()         Sets the current record's "chequedate" value
 * @method Invoice             setDate()               Sets the current record's "date" value
 * @method Invoice             setDuedate()            Sets the current record's "duedate" value
 * @method Invoice             setDatepaid()           Sets the current record's "datepaid" value
 * @method Invoice             setTermsId()            Sets the current record's "terms_id" value
 * @method Invoice             setSalesmanId()         Sets the current record's "salesman_id" value
 * @method Invoice             setTechnicianId()       Sets the current record's "technician_id" value
 * @method Invoice             setTemplateId()         Sets the current record's "template_id" value
 * @method Invoice             setCash()               Sets the current record's "cash" value
 * @method Invoice             setChequeamt()          Sets the current record's "chequeamt" value
 * @method Invoice             setCredit()             Sets the current record's "credit" value
 * @method Invoice             setDiscrate()           Sets the current record's "discrate" value
 * @method Invoice             setDiscamt()            Sets the current record's "discamt" value
 * @method Invoice             setSaletype()           Sets the current record's "saletype" value
 * @method Invoice             setStatus()             Sets the current record's "status" value
 * @method Invoice             setDsrdeduction()       Sets the current record's "dsrdeduction" value
 * @method Invoice             setBalance()            Sets the current record's "balance" value
 * @method Invoice             setChequedata()         Sets the current record's "chequedata" value
 * @method Invoice             setCheckcleardate()     Sets the current record's "checkcleardate" value
 * @method Invoice             setCheckcollectevents() Sets the current record's "checkcollectevents" value
 * @method Invoice             setHidden()             Sets the current record's "hidden" value
 * @method Invoice             setIsInspected()        Sets the current record's "is_inspected" value
 * @method Invoice             setCustomer()           Sets the current record's "Customer" value
 * @method Invoice             setEmployee()           Sets the current record's "Employee" value
 * @method Invoice             setInvoiceTemplate()    Sets the current record's "InvoiceTemplate" value
 * @method Invoice             setTerms()              Sets the current record's "Terms" value
 * @method Invoice             setInvoicedetail()      Sets the current record's "Invoicedetail" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvoice extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('invoice');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('customer_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('customer_name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('customer_phone', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('invno', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('ponumber', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('notes', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('payonly', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
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
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('cheque', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('chequedate', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
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
        $this->hasColumn('duedate', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('datepaid', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('terms_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('salesman_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('technician_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('template_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('cash', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('chequeamt', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('credit', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
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
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('discamt', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('saletype', 'enum', 7, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Cash',
              1 => 'Cheque',
              2 => 'Account',
              3 => 'Other',
             ),
             'primary' => false,
             'default' => 'Cash',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 7,
             ));
        $this->hasColumn('status', 'enum', 9, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Pending',
              1 => 'Paid',
              2 => 'Cancelled',
             ),
             'primary' => false,
             'default' => 'Pending',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 9,
             ));
        $this->hasColumn('dsrdeduction', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
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
        $this->hasColumn('chequedata', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('checkcleardate', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('checkcollectevents', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('hidden', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('is_inspected', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('is_temporary', 'integer', 1, array(
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
        $this->hasOne('Customer', array(
             'local' => 'customer_id',
             'foreign' => 'id'));

        $this->hasOne('Employee', array(
             'local' => 'salesman_id',
             'foreign' => 'id'));

        $this->hasOne('InvoiceTemplate', array(
             'local' => 'template_id',
             'foreign' => 'id'));

        $this->hasOne('Terms', array(
             'local' => 'terms_id',
             'foreign' => 'id'));

        $this->hasMany('Invoicedetail', array(
             'local' => 'id',
             'foreign' => 'invoice_id'));
    }
}