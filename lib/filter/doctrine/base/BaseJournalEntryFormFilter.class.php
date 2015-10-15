<?php

/**
 * JournalEntry filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJournalEntryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'code'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resp_center_code'     => new sfWidgetFormFilterInput(),
      'ref'                  => new sfWidgetFormFilterInput(),
      'description'          => new sfWidgetFormFilterInput(),
      'debit'                => new sfWidgetFormFilterInput(),
      'credit'               => new sfWidgetFormFilterInput(),
      'is_balanced'          => new sfWidgetFormFilterInput(),
      'is_empty'             => new sfWidgetFormFilterInput(),
      'is_balance_forwarded' => new sfWidgetFormFilterInput(),
      'period_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fund_id'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'journal_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journal'), 'add_empty' => true)),
      'payee'                => new sfWidgetFormFilterInput(),
      'checkno'              => new sfWidgetFormFilterInput(),
      'ptono'                => new sfWidgetFormFilterInput(),
      'dvno'                 => new sfWidgetFormFilterInput(),
      'obrno'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'code'                 => new sfValidatorPass(array('required' => false)),
      'resp_center_code'     => new sfValidatorPass(array('required' => false)),
      'ref'                  => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
      'debit'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'credit'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_balanced'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_empty'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_balance_forwarded' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'period_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fund_id'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'journal_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journal'), 'column' => 'id')),
      'payee'                => new sfValidatorPass(array('required' => false)),
      'checkno'              => new sfValidatorPass(array('required' => false)),
      'ptono'                => new sfValidatorPass(array('required' => false)),
      'dvno'                 => new sfValidatorPass(array('required' => false)),
      'obrno'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journal_entry_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'JournalEntry';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'date'                 => 'Date',
      'code'                 => 'Text',
      'resp_center_code'     => 'Text',
      'ref'                  => 'Text',
      'description'          => 'Text',
      'debit'                => 'Number',
      'credit'               => 'Number',
      'is_balanced'          => 'Number',
      'is_empty'             => 'Number',
      'is_balance_forwarded' => 'Number',
      'period_id'            => 'Number',
      'fund_id'              => 'Number',
      'journal_id'           => 'ForeignKey',
      'payee'                => 'Text',
      'checkno'              => 'Text',
      'ptono'                => 'Text',
      'dvno'                 => 'Text',
      'obrno'                => 'Text',
    );
  }
}
