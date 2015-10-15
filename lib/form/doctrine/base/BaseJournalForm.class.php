<?php

/**
 * Journal form base class.
 *
 * @method Journal getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJournalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'type'             => new sfWidgetFormChoice(array('choices' => array('Cash Receipt' => 'Cash Receipt', 'Cheque Disbursement' => 'Cheque Disbursement', 'Cash Disbursement' => 'Cash Disbursement', 'Gen Journal Adjustment' => 'Gen Journal Adjustment', 'Gen Journal Liquidation' => 'Gen Journal Liquidation', 'Other' => 'Other'))),
      'period_id'        => new sfWidgetFormInputText(),
      'fund_id'          => new sfWidgetFormInputText(),
      'accountno'        => new sfWidgetFormInputText(),
      'priorityaccounts' => new sfWidgetFormInputText(),
      'author'           => new sfWidgetFormInputText(),
      'preparedby1'      => new sfWidgetFormInputText(),
      'preparedby2'      => new sfWidgetFormInputText(),
      'certifiedby1'     => new sfWidgetFormInputText(),
      'certifiedby2'     => new sfWidgetFormInputText(),
      'is_approved'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 100)),
      'type'             => new sfValidatorChoice(array('choices' => array(0 => 'Cash Receipt', 1 => 'Cheque Disbursement', 2 => 'Cash Disbursement', 3 => 'Gen Journal Adjustment', 4 => 'Gen Journal Liquidation', 5 => 'Other'), 'required' => false)),
      'period_id'        => new sfValidatorInteger(),
      'fund_id'          => new sfValidatorInteger(),
      'accountno'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'priorityaccounts' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'author'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'preparedby1'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'preparedby2'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'certifiedby1'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'certifiedby2'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'is_approved'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journal';
  }

}
