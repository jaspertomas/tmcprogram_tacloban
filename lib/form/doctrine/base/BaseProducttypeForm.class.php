<?php

/**
 * Producttype form base class.
 *
 * @method Producttype getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProducttypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'parent_id'   => new sfWidgetFormInputText(),
      'priority'    => new sfWidgetFormInputText(),
      'category1'   => new sfWidgetFormInputText(),
      'category2'   => new sfWidgetFormInputText(),
      'category3'   => new sfWidgetFormInputText(),
      'category4'   => new sfWidgetFormInputText(),
      'category5'   => new sfWidgetFormInputText(),
      'category6'   => new sfWidgetFormInputText(),
      'category7'   => new sfWidgetFormInputText(),
      'category8'   => new sfWidgetFormInputText(),
      'category9'   => new sfWidgetFormInputText(),
      'category10'  => new sfWidgetFormInputText(),
      'path_ids'    => new sfWidgetFormInputText(),
      'path'        => new sfWidgetFormInputText(),
      'notes'       => new sfWidgetFormTextarea(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('Red' => 'Red', 'Orange' => 'Orange', 'Yellow' => 'Yellow', 'Green' => 'Green', 'Blue' => 'Blue', 'Indigo' => 'Indigo', 'Violet' => 'Violet'))),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'parent_id'   => new sfValidatorInteger(array('required' => false)),
      'priority'    => new sfValidatorInteger(array('required' => false)),
      'category1'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'category2'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'category3'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'category4'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'category5'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'category6'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category7'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category8'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category9'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category10'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'path_ids'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'path'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'notes'       => new sfValidatorString(array('required' => false)),
      'status'      => new sfValidatorChoice(array('choices' => array(0 => 'Red', 1 => 'Orange', 2 => 'Yellow', 3 => 'Green', 4 => 'Blue', 5 => 'Indigo', 6 => 'Violet'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producttype[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producttype';
  }

}
