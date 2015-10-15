<?php

/**
 * Accountentry form base class.
 *
 * @method Accountentry getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountentryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'account_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => false)),
      'qty'          => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormDate(),
      'balance'      => new sfWidgetFormInputText(),
      'ref_class'    => new sfWidgetFormInputText(),
      'ref_id'       => new sfWidgetFormInputText(),
      'priority'     => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'is_cancelled' => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'account_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'))),
      'qty'          => new sfValidatorNumber(array('required' => false)),
      'date'         => new sfValidatorDate(),
      'balance'      => new sfValidatorNumber(array('required' => false)),
      'ref_class'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ref_id'       => new sfValidatorInteger(array('required' => false)),
      'priority'     => new sfValidatorInteger(array('required' => false)),
      'type'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'is_cancelled' => new sfValidatorInteger(array('required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('accountentry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Accountentry';
  }

}
