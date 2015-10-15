<?php

/**
 * Period form base class.
 *
 * @method Period getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePeriodForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'name'               => new sfWidgetFormInputText(),
      'startdate'          => new sfWidgetFormDate(),
      'enddate'            => new sfWidgetFormDate(),
      'is_current'         => new sfWidgetFormInputText(),
      'previous_period_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'               => new sfValidatorString(array('max_length' => 50)),
      'startdate'          => new sfValidatorDate(array('required' => false)),
      'enddate'            => new sfValidatorDate(array('required' => false)),
      'is_current'         => new sfValidatorInteger(array('required' => false)),
      'previous_period_id' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('period[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Period';
  }

}
