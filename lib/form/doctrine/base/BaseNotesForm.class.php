<?php

/**
 * Notes form base class.
 *
 * @method Notes getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'content'     => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormInputText(),
      'parent_id'   => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('Red' => 'Red', 'Orange' => 'Orange', 'Yellow' => 'Yellow', 'Green' => 'Green', 'Blue' => 'Blue', 'Indigo' => 'Indigo', 'Violet' => 'Violet'))),
      'priority'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 50)),
      'content'     => new sfValidatorString(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'parent_id'   => new sfValidatorInteger(array('required' => false)),
      'status'      => new sfValidatorChoice(array('choices' => array(0 => 'Red', 1 => 'Orange', 2 => 'Yellow', 3 => 'Green', 4 => 'Blue', 5 => 'Indigo', 6 => 'Violet'), 'required' => false)),
      'priority'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notes';
  }

}
