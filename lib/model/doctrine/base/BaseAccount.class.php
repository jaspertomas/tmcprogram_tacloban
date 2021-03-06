<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Account', 'doctrine');

/**
 * BaseAccount
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $account_type_id
 * @property integer $account_category_id
 * @property integer $is_special
 * @property decimal $currentqty
 * @property date $date
 * @property AccountType $AccountType
 * @property AccountCategory $AccountCategory
 * @property Doctrine_Collection $Accountentry
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getCode()                Returns the current record's "code" value
 * @method string              getName()                Returns the current record's "name" value
 * @method integer             getAccountTypeId()       Returns the current record's "account_type_id" value
 * @method integer             getAccountCategoryId()   Returns the current record's "account_category_id" value
 * @method integer             getIsSpecial()           Returns the current record's "is_special" value
 * @method decimal             getCurrentqty()          Returns the current record's "currentqty" value
 * @method date                getDate()                Returns the current record's "date" value
 * @method AccountType         getAccountType()         Returns the current record's "AccountType" value
 * @method AccountCategory     getAccountCategory()     Returns the current record's "AccountCategory" value
 * @method Doctrine_Collection getAccountentry()        Returns the current record's "Accountentry" collection
 * @method Account             setId()                  Sets the current record's "id" value
 * @method Account             setCode()                Sets the current record's "code" value
 * @method Account             setName()                Sets the current record's "name" value
 * @method Account             setAccountTypeId()       Sets the current record's "account_type_id" value
 * @method Account             setAccountCategoryId()   Sets the current record's "account_category_id" value
 * @method Account             setIsSpecial()           Sets the current record's "is_special" value
 * @method Account             setCurrentqty()          Sets the current record's "currentqty" value
 * @method Account             setDate()                Sets the current record's "date" value
 * @method Account             setAccountType()         Sets the current record's "AccountType" value
 * @method Account             setAccountCategory()     Sets the current record's "AccountCategory" value
 * @method Account             setAccountentry()        Sets the current record's "Accountentry" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAccount extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('account');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('name', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
             ));
        $this->hasColumn('account_type_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('account_category_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('is_special', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('currentqty', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AccountType', array(
             'local' => 'account_type_id',
             'foreign' => 'id'));

        $this->hasOne('AccountCategory', array(
             'local' => 'account_category_id',
             'foreign' => 'id'));

        $this->hasMany('Accountentry', array(
             'local' => 'id',
             'foreign' => 'account_id'));
    }
}