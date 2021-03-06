<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Brand', 'doctrine');

/**
 * BaseBrand
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Product
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getName()    Returns the current record's "name" value
 * @method Doctrine_Collection getProduct() Returns the current record's "Product" collection
 * @method Brand               setId()      Sets the current record's "id" value
 * @method Brand               setName()    Sets the current record's "name" value
 * @method Brand               setProduct() Sets the current record's "Product" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBrand extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('brand');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Product', array(
             'local' => 'id',
             'foreign' => 'brand_id'));
    }
}