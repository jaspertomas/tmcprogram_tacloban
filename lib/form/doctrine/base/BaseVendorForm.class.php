<?php

/**
 * Vendor form base class.
 *
 * @method Vendor getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVendorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'name'   => new sfWidgetFormInputText(),
      'addr1'  => new sfWidgetFormInputText(),
      'addr2'  => new sfWidgetFormInputText(),
      'addr3'  => new sfWidgetFormInputText(),
      'vtype'  => new sfWidgetFormInputText(),
      'cont1'  => new sfWidgetFormInputText(),
      'cont2'  => new sfWidgetFormInputText(),
      'phone1' => new sfWidgetFormTextarea(),
      'phone2' => new sfWidgetFormTextarea(),
      'faxnum' => new sfWidgetFormInputText(),
      'email'  => new sfWidgetFormInputText(),
      'note'   => new sfWidgetFormTextarea(),
      'taxid'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'   => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'addr1'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'addr2'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'addr3'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'vtype'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'cont1'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'cont2'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'phone1' => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'phone2' => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'faxnum' => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'email'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'note'   => new sfValidatorString(array('required' => false)),
      'taxid'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('vendor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vendor';
  }

}
