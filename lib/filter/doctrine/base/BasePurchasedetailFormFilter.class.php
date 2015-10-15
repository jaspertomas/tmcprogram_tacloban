<?php

/**
 * Purchasedetail filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePurchasedetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'purchase_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Purchase'), 'add_empty' => true)),
      'description'  => new sfWidgetFormFilterInput(),
      'qty'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sellprice'    => new sfWidgetFormFilterInput(),
      'total'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tax'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'barcode'      => new sfWidgetFormFilterInput(),
      'discrate'     => new sfWidgetFormFilterInput(),
      'discamt'      => new sfWidgetFormFilterInput(),
      'unittotal'    => new sfWidgetFormFilterInput(),
      'is_cancelled' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'purchase_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Purchase'), 'column' => 'id')),
      'description'  => new sfValidatorPass(array('required' => false)),
      'qty'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'price'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sellprice'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tax'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'product_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Product'), 'column' => 'id')),
      'barcode'      => new sfValidatorPass(array('required' => false)),
      'discrate'     => new sfValidatorPass(array('required' => false)),
      'discamt'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unittotal'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_cancelled' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('purchasedetail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Purchasedetail';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'purchase_id'  => 'ForeignKey',
      'description'  => 'Text',
      'qty'          => 'Number',
      'price'        => 'Number',
      'sellprice'    => 'Number',
      'total'        => 'Number',
      'tax'          => 'Number',
      'product_id'   => 'ForeignKey',
      'barcode'      => 'Text',
      'discrate'     => 'Text',
      'discamt'      => 'Number',
      'unittotal'    => 'Number',
      'is_cancelled' => 'Number',
    );
  }
}
