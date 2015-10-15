<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'brand_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Brand'), 'add_empty' => true)),
      'producttype_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producttype'), 'add_empty' => false)),
      'qty'               => new sfWidgetFormInputText(),
      'minbuyprice'       => new sfWidgetFormInputText(),
      'maxbuyprice'       => new sfWidgetFormInputText(),
      'minsellprice'      => new sfWidgetFormInputText(),
      'maxsellprice'      => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'category1'         => new sfWidgetFormInputText(),
      'category2'         => new sfWidgetFormInputText(),
      'category3'         => new sfWidgetFormInputText(),
      'category4'         => new sfWidgetFormInputText(),
      'category5'         => new sfWidgetFormInputText(),
      'category6'         => new sfWidgetFormInputText(),
      'category7'         => new sfWidgetFormInputText(),
      'category8'         => new sfWidgetFormInputText(),
      'category9'         => new sfWidgetFormInputText(),
      'category10'        => new sfWidgetFormInputText(),
      'publish'           => new sfWidgetFormInputText(),
      'autocalcsellprice' => new sfWidgetFormInputText(),
      'autocalcbuyprice'  => new sfWidgetFormInputText(),
      'monitored'         => new sfWidgetFormInputText(),
      'barcode'           => new sfWidgetFormInputText(),
      'is_service'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 100)),
      'brand_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Brand'), 'required' => false)),
      'producttype_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producttype'))),
      'qty'               => new sfValidatorNumber(array('required' => false)),
      'minbuyprice'       => new sfValidatorNumber(array('required' => false)),
      'maxbuyprice'       => new sfValidatorNumber(array('required' => false)),
      'minsellprice'      => new sfValidatorNumber(array('required' => false)),
      'maxsellprice'      => new sfValidatorNumber(array('required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'category1'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category2'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category3'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category4'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category5'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category6'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category7'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category8'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category9'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'category10'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'publish'           => new sfValidatorInteger(array('required' => false)),
      'autocalcsellprice' => new sfValidatorInteger(array('required' => false)),
      'autocalcbuyprice'  => new sfValidatorInteger(array('required' => false)),
      'monitored'         => new sfValidatorInteger(array('required' => false)),
      'barcode'           => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'is_service'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

}
