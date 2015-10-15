<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'type'           => new sfWidgetFormInputText(),
      'parent_class'   => new sfWidgetFormInputText(),
      'parent_id'      => new sfWidgetFormInputText(),
      'parent_name'    => new sfWidgetFormInputText(),
      'child_class'    => new sfWidgetFormInputText(),
      'children_id'    => new sfWidgetFormInputText(),
      'date'           => new sfWidgetFormDate(),
      'amount'         => new sfWidgetFormInputText(),
      'detail1'        => new sfWidgetFormInputText(),
      'detail2'        => new sfWidgetFormInputText(),
      'detail3'        => new sfWidgetFormInputText(),
      'notes'          => new sfWidgetFormTextarea(),
      'is_cancelled'   => new sfWidgetFormInputText(),
      'checkcleardate' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'           => new sfValidatorString(array('max_length' => 20)),
      'parent_class'   => new sfValidatorString(array('max_length' => 20)),
      'parent_id'      => new sfValidatorInteger(),
      'parent_name'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'child_class'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'children_id'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'date'           => new sfValidatorDate(),
      'amount'         => new sfValidatorNumber(array('required' => false)),
      'detail1'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'detail2'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'detail3'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'notes'          => new sfValidatorString(array('required' => false)),
      'is_cancelled'   => new sfValidatorInteger(array('required' => false)),
      'checkcleardate' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
