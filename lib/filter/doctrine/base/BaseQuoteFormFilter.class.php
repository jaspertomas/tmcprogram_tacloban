<?php

/**
 * Quote filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseQuoteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'vendor_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vendor'), 'add_empty' => true)),
      'product_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'price'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discrate'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discamt'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ref_class'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ref_id'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mine'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_cancelled' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'vendor_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vendor'), 'column' => 'id')),
      'product_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Product'), 'column' => 'id')),
      'price'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discrate'     => new sfValidatorPass(array('required' => false)),
      'discamt'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ref_class'    => new sfValidatorPass(array('required' => false)),
      'ref_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mine'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_cancelled' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('quote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quote';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'date'         => 'Date',
      'vendor_id'    => 'ForeignKey',
      'product_id'   => 'ForeignKey',
      'price'        => 'Number',
      'discrate'     => 'Text',
      'discamt'      => 'Number',
      'ref_class'    => 'Text',
      'ref_id'       => 'Number',
      'total'        => 'Number',
      'mine'         => 'Number',
      'is_cancelled' => 'Number',
    );
  }
}
