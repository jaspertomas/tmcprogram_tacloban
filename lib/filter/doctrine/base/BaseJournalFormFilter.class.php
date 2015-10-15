<?php

/**
 * Journal filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJournalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'Cash Receipt' => 'Cash Receipt', 'Cheque Disbursement' => 'Cheque Disbursement', 'Cash Disbursement' => 'Cash Disbursement', 'Gen Journal Adjustment' => 'Gen Journal Adjustment', 'Gen Journal Liquidation' => 'Gen Journal Liquidation', 'Other' => 'Other'))),
      'period_id'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fund_id'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'accountno'        => new sfWidgetFormFilterInput(),
      'priorityaccounts' => new sfWidgetFormFilterInput(),
      'author'           => new sfWidgetFormFilterInput(),
      'preparedby1'      => new sfWidgetFormFilterInput(),
      'preparedby2'      => new sfWidgetFormFilterInput(),
      'certifiedby1'     => new sfWidgetFormFilterInput(),
      'certifiedby2'     => new sfWidgetFormFilterInput(),
      'is_approved'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'type'             => new sfValidatorChoice(array('required' => false, 'choices' => array('Cash Receipt' => 'Cash Receipt', 'Cheque Disbursement' => 'Cheque Disbursement', 'Cash Disbursement' => 'Cash Disbursement', 'Gen Journal Adjustment' => 'Gen Journal Adjustment', 'Gen Journal Liquidation' => 'Gen Journal Liquidation', 'Other' => 'Other'))),
      'period_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fund_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'accountno'        => new sfValidatorPass(array('required' => false)),
      'priorityaccounts' => new sfValidatorPass(array('required' => false)),
      'author'           => new sfValidatorPass(array('required' => false)),
      'preparedby1'      => new sfValidatorPass(array('required' => false)),
      'preparedby2'      => new sfValidatorPass(array('required' => false)),
      'certifiedby1'     => new sfValidatorPass(array('required' => false)),
      'certifiedby2'     => new sfValidatorPass(array('required' => false)),
      'is_approved'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('journal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journal';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'type'             => 'Enum',
      'period_id'        => 'Number',
      'fund_id'          => 'Number',
      'accountno'        => 'Text',
      'priorityaccounts' => 'Text',
      'author'           => 'Text',
      'preparedby1'      => 'Text',
      'preparedby2'      => 'Text',
      'certifiedby1'     => 'Text',
      'certifiedby2'     => 'Text',
      'is_approved'      => 'Number',
    );
  }
}
