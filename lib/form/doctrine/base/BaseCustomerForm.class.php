<?php

/**
 * Customer form base class.
 *
 * @method Customer getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'tin_no'     => new sfWidgetFormInputText(),
      'address'    => new sfWidgetFormInputText(),
      'phone1'     => new sfWidgetFormInputText(),
      'phone2'     => new sfWidgetFormInputText(),
      'faxnum'     => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'note'       => new sfWidgetFormInputText(),
      'rep'        => new sfWidgetFormInputText(),
      'repno'      => new sfWidgetFormInputText(),
      'rep2'       => new sfWidgetFormInputText(),
      'rep2no'     => new sfWidgetFormInputText(),
      'taxitem'    => new sfWidgetFormInputText(),
      'notepad'    => new sfWidgetFormInputText(),
      'salutation' => new sfWidgetFormInputText(),
      'is_suki'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'tin_no'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'address'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone1'     => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'phone2'     => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'faxnum'     => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'note'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'rep'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'repno'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'rep2'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'rep2no'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'taxitem'    => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'notepad'    => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'salutation' => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'is_suki'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('customer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Customer';
  }

}
