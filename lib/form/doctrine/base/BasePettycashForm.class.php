<?php

/**
 * Pettycash form base class.
 *
 * @method Pettycash getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePettycashForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'pettycashno' => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDate(),
      'amount'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'pettycashno' => new sfValidatorString(array('max_length' => 10)),
      'date'        => new sfValidatorDate(),
      'amount'      => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('pettycash[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pettycash';
  }

}
