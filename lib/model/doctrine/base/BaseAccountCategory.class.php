<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AccountCategory', 'doctrine');

/**
 * BaseAccountCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $account_type_id
 * @property string $parent_code
 * @property AccountType $AccountType
 * @property Doctrine_Collection $Account
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method string              getName()            Returns the current record's "name" value
 * @method string              getCode()            Returns the current record's "code" value
 * @method integer             getAccountTypeId()   Returns the current record's "account_type_id" value
 * @method string              getParentCode()      Returns the current record's "parent_code" value
 * @method AccountType         getAccountType()     Returns the current record's "AccountType" value
 * @method Doctrine_Collection getAccount()         Returns the current record's "Account" collection
 * @method AccountCategory     setId()              Sets the current record's "id" value
 * @method AccountCategory     setName()            Sets the current record's "name" value
 * @method AccountCategory     setCode()            Sets the current record's "code" value
 * @method AccountCategory     setAccountTypeId()   Sets the current record's "account_type_id" value
 * @method AccountCategory     setParentCode()      Sets the current record's "parent_code" value
 * @method AccountCategory     setAccountType()     Sets the current record's "AccountType" value
 * @method AccountCategory     setAccount()         Sets the current record's "Account" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAccountCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('account_category');
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
        $this->hasColumn('code', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 70,
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
        $this->hasColumn('parent_code', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 70,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AccountType', array(
             'local' => 'account_type_id',
             'foreign' => 'id'));

        $this->hasMany('Account', array(
             'local' => 'id',
             'foreign' => 'account_category_id'));
    }
}