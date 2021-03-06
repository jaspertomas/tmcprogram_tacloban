<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Notes', 'doctrine');

/**
 * BaseNotes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $description
 * @property integer $parent_id
 * @property enum $status
 * @property integer $priority
 * 
 * @method integer getId()          Returns the current record's "id" value
 * @method string  getName()        Returns the current record's "name" value
 * @method string  getContent()     Returns the current record's "content" value
 * @method string  getDescription() Returns the current record's "description" value
 * @method integer getParentId()    Returns the current record's "parent_id" value
 * @method enum    getStatus()      Returns the current record's "status" value
 * @method integer getPriority()    Returns the current record's "priority" value
 * @method Notes   setId()          Sets the current record's "id" value
 * @method Notes   setName()        Sets the current record's "name" value
 * @method Notes   setContent()     Sets the current record's "content" value
 * @method Notes   setDescription() Sets the current record's "description" value
 * @method Notes   setParentId()    Sets the current record's "parent_id" value
 * @method Notes   setStatus()      Sets the current record's "status" value
 * @method Notes   setPriority()    Sets the current record's "priority" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNotes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('notes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('content', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
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
        $this->hasColumn('parent_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('status', 'enum', 6, array(
             'type' => 'enum',
             'fixed' => 0,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'Red',
              1 => 'Orange',
              2 => 'Yellow',
              3 => 'Green',
              4 => 'Blue',
              5 => 'Indigo',
              6 => 'Violet',
             ),
             'primary' => false,
             'default' => 'Red',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 6,
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
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}