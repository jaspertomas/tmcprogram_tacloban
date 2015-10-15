<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('JournalEntry', 'doctrine');

/**
 * BaseJournalEntry
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property string $code
 * @property string $resp_center_code
 * @property string $ref
 * @property string $description
 * @property decimal $debit
 * @property decimal $credit
 * @property integer $is_balanced
 * @property integer $is_empty
 * @property integer $is_balance_forwarded
 * @property integer $period_id
 * @property integer $fund_id
 * @property integer $journal_id
 * @property string $payee
 * @property string $checkno
 * @property string $ptono
 * @property string $dvno
 * @property string $obrno
 * @property Journal $Journal
 * 
 * @method integer      getId()                   Returns the current record's "id" value
 * @method date         getDate()                 Returns the current record's "date" value
 * @method string       getCode()                 Returns the current record's "code" value
 * @method string       getRespCenterCode()       Returns the current record's "resp_center_code" value
 * @method string       getRef()                  Returns the current record's "ref" value
 * @method string       getDescription()          Returns the current record's "description" value
 * @method decimal      getDebit()                Returns the current record's "debit" value
 * @method decimal      getCredit()               Returns the current record's "credit" value
 * @method integer      getIsBalanced()           Returns the current record's "is_balanced" value
 * @method integer      getIsEmpty()              Returns the current record's "is_empty" value
 * @method integer      getIsBalanceForwarded()   Returns the current record's "is_balance_forwarded" value
 * @method integer      getPeriodId()             Returns the current record's "period_id" value
 * @method integer      getFundId()               Returns the current record's "fund_id" value
 * @method integer      getJournalId()            Returns the current record's "journal_id" value
 * @method string       getPayee()                Returns the current record's "payee" value
 * @method string       getCheckno()              Returns the current record's "checkno" value
 * @method string       getPtono()                Returns the current record's "ptono" value
 * @method string       getDvno()                 Returns the current record's "dvno" value
 * @method string       getObrno()                Returns the current record's "obrno" value
 * @method Journal      getJournal()              Returns the current record's "Journal" value
 * @method JournalEntry setId()                   Sets the current record's "id" value
 * @method JournalEntry setDate()                 Sets the current record's "date" value
 * @method JournalEntry setCode()                 Sets the current record's "code" value
 * @method JournalEntry setRespCenterCode()       Sets the current record's "resp_center_code" value
 * @method JournalEntry setRef()                  Sets the current record's "ref" value
 * @method JournalEntry setDescription()          Sets the current record's "description" value
 * @method JournalEntry setDebit()                Sets the current record's "debit" value
 * @method JournalEntry setCredit()               Sets the current record's "credit" value
 * @method JournalEntry setIsBalanced()           Sets the current record's "is_balanced" value
 * @method JournalEntry setIsEmpty()              Sets the current record's "is_empty" value
 * @method JournalEntry setIsBalanceForwarded()   Sets the current record's "is_balance_forwarded" value
 * @method JournalEntry setPeriodId()             Sets the current record's "period_id" value
 * @method JournalEntry setFundId()               Sets the current record's "fund_id" value
 * @method JournalEntry setJournalId()            Sets the current record's "journal_id" value
 * @method JournalEntry setPayee()                Sets the current record's "payee" value
 * @method JournalEntry setCheckno()              Sets the current record's "checkno" value
 * @method JournalEntry setPtono()                Sets the current record's "ptono" value
 * @method JournalEntry setDvno()                 Sets the current record's "dvno" value
 * @method JournalEntry setObrno()                Sets the current record's "obrno" value
 * @method JournalEntry setJournal()              Sets the current record's "Journal" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJournalEntry extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('journal_entry');
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
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('code', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('resp_center_code', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('ref', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('debit', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 18,
             'scale' => '2',
             ));
        $this->hasColumn('credit', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0.00',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 18,
             'scale' => '2',
             ));
        $this->hasColumn('is_balanced', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('is_empty', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('is_balance_forwarded', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('period_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fund_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('journal_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('payee', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('checkno', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('ptono', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('dvno', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('obrno', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Journal', array(
             'local' => 'journal_id',
             'foreign' => 'id'));
    }
}