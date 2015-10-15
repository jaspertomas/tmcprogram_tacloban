<?php

/**
 * Countries form base class.
 *
 * @method Countries getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCountriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country_id' => new sfWidgetFormInputHidden(),
      'country'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'country_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('country_id')), 'empty_value' => $this->getObject()->get('country_id'), 'required' => false)),
      'country'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('countries[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Countries';
  }

}
