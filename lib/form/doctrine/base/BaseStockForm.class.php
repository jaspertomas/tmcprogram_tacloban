<?php

/**
 * Stock form base class.
 *
 * @method Stock getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStockForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'warehouse_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Warehouse'), 'add_empty' => false)),
      'product_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => false)),
      'currentqty'   => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormDate(),
      'quota'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'warehouse_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Warehouse'))),
      'product_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Product'))),
      'currentqty'   => new sfValidatorNumber(array('required' => false)),
      'date'         => new sfValidatorDate(),
      'quota'        => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stock';
  }

}
