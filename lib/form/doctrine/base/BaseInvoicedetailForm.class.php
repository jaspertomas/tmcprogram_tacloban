<?php

/**
 * Invoicedetail form base class.
 *
 * @method Invoicedetail getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInvoicedetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'invoice_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Invoice'), 'add_empty' => true)),
      'product_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => false)),
      'barcode'      => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormInputText(),
      'qty'          => new sfWidgetFormInputText(),
      'price'        => new sfWidgetFormInputText(),
      'total'        => new sfWidgetFormInputText(),
      'discrate'     => new sfWidgetFormInputText(),
      'discamt'      => new sfWidgetFormInputText(),
      'unittotal'    => new sfWidgetFormInputText(),
      'is_cancelled' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'invoice_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Invoice'), 'required' => false)),
      'product_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Product'))),
      'barcode'      => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'qty'          => new sfValidatorNumber(array('required' => false)),
      'price'        => new sfValidatorNumber(array('required' => false)),
      'total'        => new sfValidatorNumber(array('required' => false)),
      'discrate'     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'discamt'      => new sfValidatorNumber(array('required' => false)),
      'unittotal'    => new sfValidatorNumber(array('required' => false)),
      'is_cancelled' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('invoicedetail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoicedetail';
  }

}
