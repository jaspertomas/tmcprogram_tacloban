<?php

/**
 * Product filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'brand_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Brand'), 'add_empty' => true)),
      'producttype_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producttype'), 'add_empty' => true)),
      'qty'               => new sfWidgetFormFilterInput(),
      'minbuyprice'       => new sfWidgetFormFilterInput(),
      'maxbuyprice'       => new sfWidgetFormFilterInput(),
      'minsellprice'      => new sfWidgetFormFilterInput(),
      'maxsellprice'      => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'category1'         => new sfWidgetFormFilterInput(),
      'category2'         => new sfWidgetFormFilterInput(),
      'category3'         => new sfWidgetFormFilterInput(),
      'category4'         => new sfWidgetFormFilterInput(),
      'category5'         => new sfWidgetFormFilterInput(),
      'category6'         => new sfWidgetFormFilterInput(),
      'category7'         => new sfWidgetFormFilterInput(),
      'category8'         => new sfWidgetFormFilterInput(),
      'category9'         => new sfWidgetFormFilterInput(),
      'category10'        => new sfWidgetFormFilterInput(),
      'publish'           => new sfWidgetFormFilterInput(),
      'autocalcsellprice' => new sfWidgetFormFilterInput(),
      'autocalcbuyprice'  => new sfWidgetFormFilterInput(),
      'monitored'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'barcode'           => new sfWidgetFormFilterInput(),
      'is_service'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'brand_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Brand'), 'column' => 'id')),
      'producttype_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producttype'), 'column' => 'id')),
      'qty'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'minbuyprice'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'maxbuyprice'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'minsellprice'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'maxsellprice'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'description'       => new sfValidatorPass(array('required' => false)),
      'category1'         => new sfValidatorPass(array('required' => false)),
      'category2'         => new sfValidatorPass(array('required' => false)),
      'category3'         => new sfValidatorPass(array('required' => false)),
      'category4'         => new sfValidatorPass(array('required' => false)),
      'category5'         => new sfValidatorPass(array('required' => false)),
      'category6'         => new sfValidatorPass(array('required' => false)),
      'category7'         => new sfValidatorPass(array('required' => false)),
      'category8'         => new sfValidatorPass(array('required' => false)),
      'category9'         => new sfValidatorPass(array('required' => false)),
      'category10'        => new sfValidatorPass(array('required' => false)),
      'publish'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'autocalcsellprice' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'autocalcbuyprice'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'monitored'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'barcode'           => new sfValidatorPass(array('required' => false)),
      'is_service'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'brand_id'          => 'ForeignKey',
      'producttype_id'    => 'ForeignKey',
      'qty'               => 'Number',
      'minbuyprice'       => 'Number',
      'maxbuyprice'       => 'Number',
      'minsellprice'      => 'Number',
      'maxsellprice'      => 'Number',
      'description'       => 'Text',
      'category1'         => 'Text',
      'category2'         => 'Text',
      'category3'         => 'Text',
      'category4'         => 'Text',
      'category5'         => 'Text',
      'category6'         => 'Text',
      'category7'         => 'Text',
      'category8'         => 'Text',
      'category9'         => 'Text',
      'category10'        => 'Text',
      'publish'           => 'Number',
      'autocalcsellprice' => 'Number',
      'autocalcbuyprice'  => 'Number',
      'monitored'         => 'Number',
      'barcode'           => 'Text',
      'is_service'        => 'Number',
    );
  }
}
