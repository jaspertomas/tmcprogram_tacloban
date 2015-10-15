<?php

/**
 * Stockentry form base class.
 *
 * @method Stockentry getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStockentryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'date'         => new sfWidgetFormDate(),
      'qty'          => new sfWidgetFormInputText(),
      'balance'      => new sfWidgetFormInputText(),
      'stock_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Stock'), 'add_empty' => false)),
      'ref_class'    => new sfWidgetFormInputText(),
      'ref_id'       => new sfWidgetFormInputText(),
      'is_cancelled' => new sfWidgetFormInputText(),
      'priority'     => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'         => new sfValidatorDate(),
      'qty'          => new sfValidatorNumber(),
      'balance'      => new sfValidatorNumber(array('required' => false)),
      'stock_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Stock'))),
      'ref_class'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ref_id'       => new sfValidatorInteger(array('required' => false)),
      'is_cancelled' => new sfValidatorInteger(array('required' => false)),
      'priority'     => new sfValidatorInteger(array('required' => false)),
      'type'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stockentry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stockentry';
  }

}
