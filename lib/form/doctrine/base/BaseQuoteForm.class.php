<?php

/**
 * Quote form base class.
 *
 * @method Quote getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseQuoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'date'         => new sfWidgetFormDate(),
      'vendor_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vendor'), 'add_empty' => false)),
      'product_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => false)),
      'price'        => new sfWidgetFormInputText(),
      'discrate'     => new sfWidgetFormInputText(),
      'discamt'      => new sfWidgetFormInputText(),
      'ref_class'    => new sfWidgetFormInputText(),
      'ref_id'       => new sfWidgetFormInputText(),
      'total'        => new sfWidgetFormInputText(),
      'mine'         => new sfWidgetFormInputText(),
      'is_cancelled' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'         => new sfValidatorDate(),
      'vendor_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vendor'))),
      'product_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Product'))),
      'price'        => new sfValidatorNumber(),
      'discrate'     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'discamt'      => new sfValidatorNumber(),
      'ref_class'    => new sfValidatorString(array('max_length' => 20)),
      'ref_id'       => new sfValidatorInteger(),
      'total'        => new sfValidatorNumber(),
      'mine'         => new sfValidatorInteger(array('required' => false)),
      'is_cancelled' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('quote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quote';
  }

}
