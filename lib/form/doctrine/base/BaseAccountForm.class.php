<?php

/**
 * Account form base class.
 *
 * @method Account getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'code'                => new sfWidgetFormInputText(),
      'name'                => new sfWidgetFormInputText(),
      'account_type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'), 'add_empty' => false)),
      'account_category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccountCategory'), 'add_empty' => true)),
      'is_special'          => new sfWidgetFormInputText(),
      'currentqty'          => new sfWidgetFormInputText(),
      'date'                => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'                => new sfValidatorString(array('max_length' => 20)),
      'name'                => new sfValidatorString(array('max_length' => 150)),
      'account_type_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'))),
      'account_category_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccountCategory'), 'required' => false)),
      'is_special'          => new sfValidatorInteger(array('required' => false)),
      'currentqty'          => new sfValidatorNumber(array('required' => false)),
      'date'                => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }

}
