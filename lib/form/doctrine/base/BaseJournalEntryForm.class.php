<?php

/**
 * JournalEntry form base class.
 *
 * @method JournalEntry getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJournalEntryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'date'                 => new sfWidgetFormDate(),
      'code'                 => new sfWidgetFormInputText(),
      'resp_center_code'     => new sfWidgetFormInputText(),
      'ref'                  => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'debit'                => new sfWidgetFormInputText(),
      'credit'               => new sfWidgetFormInputText(),
      'is_balanced'          => new sfWidgetFormInputText(),
      'is_empty'             => new sfWidgetFormInputText(),
      'is_balance_forwarded' => new sfWidgetFormInputText(),
      'period_id'            => new sfWidgetFormInputText(),
      'fund_id'              => new sfWidgetFormInputText(),
      'journal_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journal'), 'add_empty' => false)),
      'payee'                => new sfWidgetFormInputText(),
      'checkno'              => new sfWidgetFormInputText(),
      'ptono'                => new sfWidgetFormInputText(),
      'dvno'                 => new sfWidgetFormInputText(),
      'obrno'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                 => new sfValidatorDate(array('required' => false)),
      'code'                 => new sfValidatorString(array('max_length' => 30)),
      'resp_center_code'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ref'                  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'          => new sfValidatorString(array('required' => false)),
      'debit'                => new sfValidatorNumber(array('required' => false)),
      'credit'               => new sfValidatorNumber(array('required' => false)),
      'is_balanced'          => new sfValidatorInteger(array('required' => false)),
      'is_empty'             => new sfValidatorInteger(array('required' => false)),
      'is_balance_forwarded' => new sfValidatorInteger(array('required' => false)),
      'period_id'            => new sfValidatorInteger(),
      'fund_id'              => new sfValidatorInteger(),
      'journal_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Journal'))),
      'payee'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'checkno'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ptono'                => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'dvno'                 => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'obrno'                => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journal_entry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'JournalEntry';
  }

}
