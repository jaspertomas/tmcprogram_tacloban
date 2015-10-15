<?php

/**
 * Invoicedetail filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInvoicedetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'invoice_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Invoice'), 'add_empty' => true)),
      'product_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'barcode'      => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'qty'          => new sfWidgetFormFilterInput(),
      'price'        => new sfWidgetFormFilterInput(),
      'total'        => new sfWidgetFormFilterInput(),
      'discrate'     => new sfWidgetFormFilterInput(),
      'discamt'      => new sfWidgetFormFilterInput(),
      'unittotal'    => new sfWidgetFormFilterInput(),
      'is_cancelled' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'invoice_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Invoice'), 'column' => 'id')),
      'product_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Product'), 'column' => 'id')),
      'barcode'      => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'qty'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'price'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discrate'     => new sfValidatorPass(array('required' => false)),
      'discamt'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unittotal'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_cancelled' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('invoicedetail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoicedetail';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'invoice_id'   => 'ForeignKey',
      'product_id'   => 'ForeignKey',
      'barcode'      => 'Text',
      'description'  => 'Text',
      'qty'          => 'Number',
      'price'        => 'Number',
      'total'        => 'Number',
      'discrate'     => 'Text',
      'discamt'      => 'Number',
      'unittotal'    => 'Number',
      'is_cancelled' => 'Number',
    );
  }
}
