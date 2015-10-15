<?php

/**
 * Company form base class.
 *
 * @method Company getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCompanyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'first_name'    => new sfWidgetFormInputText(),
      'last_name'     => new sfWidgetFormInputText(),
      'address'       => new sfWidgetFormInputText(),
      'city'          => new sfWidgetFormInputText(),
      'state_'        => new sfWidgetFormInputText(),
      'zip'           => new sfWidgetFormInputText(),
      'country_id'    => new sfWidgetFormInputText(),
      'phone'         => new sfWidgetFormInputText(),
      'email_address' => new sfWidgetFormInputText(),
      'is_customer'   => new sfWidgetFormInputText(),
      'is_vendor'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'first_name'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'last_name'     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'address'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'city'          => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'state_'        => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'zip'           => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'country_id'    => new sfValidatorInteger(array('required' => false)),
      'phone'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'email_address' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'is_customer'   => new sfValidatorInteger(array('required' => false)),
      'is_vendor'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('company[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Company';
  }

}
