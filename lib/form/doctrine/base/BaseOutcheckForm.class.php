<?php

/**
 * Outcheck form base class.
 *
 * @method Outcheck getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOutcheckForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'checkno'      => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormDate(),
      'datereceived' => new sfWidgetFormDate(),
      'status'       => new sfWidgetFormChoice(array('choices' => array('Pending' => 'Pending', 'Cleared' => 'Cleared', 'Bounced' => 'Bounced'))),
      'amount'       => new sfWidgetFormInputText(),
      'supplier_id'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'checkno'      => new sfValidatorString(array('max_length' => 30)),
      'date'         => new sfValidatorDate(),
      'datereceived' => new sfValidatorDate(),
      'status'       => new sfValidatorChoice(array('choices' => array(0 => 'Pending', 1 => 'Cleared', 2 => 'Bounced'))),
      'amount'       => new sfValidatorNumber(),
      'supplier_id'  => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('outcheck[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Outcheck';
  }

}
