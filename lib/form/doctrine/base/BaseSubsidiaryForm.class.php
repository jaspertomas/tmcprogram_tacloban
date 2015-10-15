<?php

/**
 * Subsidiary form base class.
 *
 * @method Subsidiary getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSubsidiaryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'code'         => new sfWidgetFormInputText(),
      'name'         => new sfWidgetFormInputText(),
      'account_code' => new sfWidgetFormInputText(),
      'fund_id'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'         => new sfValidatorString(array('max_length' => 30)),
      'name'         => new sfValidatorString(array('max_length' => 150)),
      'account_code' => new sfValidatorString(array('max_length' => 10)),
      'fund_id'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('subsidiary[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subsidiary';
  }

}
