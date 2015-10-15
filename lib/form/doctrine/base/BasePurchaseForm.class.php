<?php

/**
 * Purchase form base class.
 *
 * @method Purchase getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePurchaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'pono'           => new sfWidgetFormInputText(),
      'invno'          => new sfWidgetFormInputText(),
      'total'          => new sfWidgetFormInputText(),
      'memo'           => new sfWidgetFormTextarea(),
      'tax'            => new sfWidgetFormInputText(),
      'vendor_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vendor'), 'add_empty' => false)),
      'vendor_name'    => new sfWidgetFormInputText(),
      'terms_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Terms'), 'add_empty' => true)),
      'employee_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => false)),
      'template_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PurchaseTemplate'), 'add_empty' => false)),
      'date'           => new sfWidgetFormDate(),
      'datereceived'   => new sfWidgetFormDate(),
      'duedate'        => new sfWidgetFormDate(),
      'vendor_invoice' => new sfWidgetFormInputText(),
      'discrate'       => new sfWidgetFormInputText(),
      'discamt'        => new sfWidgetFormInputText(),
      'status'         => new sfWidgetFormChoice(array('choices' => array('Pending' => 'Pending', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'))),
      'type'           => new sfWidgetFormChoice(array('choices' => array('Account' => 'Account', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Other' => 'Other'))),
      'cash'           => new sfWidgetFormInputText(),
      'cheque'         => new sfWidgetFormInputText(),
      'credit'         => new sfWidgetFormInputText(),
      'chequeno'       => new sfWidgetFormInputText(),
      'chequedate'     => new sfWidgetFormDate(),
      'balance'        => new sfWidgetFormInputText(),
      'chequedata'     => new sfWidgetFormInputText(),
      'is_inspected'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'pono'           => new sfValidatorString(array('max_length' => 10)),
      'invno'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'total'          => new sfValidatorNumber(array('required' => false)),
      'memo'           => new sfValidatorString(array('required' => false)),
      'tax'            => new sfValidatorNumber(array('required' => false)),
      'vendor_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vendor'))),
      'vendor_name'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'terms_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Terms'), 'required' => false)),
      'employee_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'))),
      'template_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PurchaseTemplate'))),
      'date'           => new sfValidatorDate(),
      'datereceived'   => new sfValidatorDate(array('required' => false)),
      'duedate'        => new sfValidatorDate(array('required' => false)),
      'vendor_invoice' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'discrate'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'discamt'        => new sfValidatorNumber(array('required' => false)),
      'status'         => new sfValidatorChoice(array('choices' => array(0 => 'Pending', 1 => 'Paid', 2 => 'Cancelled'), 'required' => false)),
      'type'           => new sfValidatorChoice(array('choices' => array(0 => 'Account', 1 => 'Cash', 2 => 'Cheque', 3 => 'Other'), 'required' => false)),
      'cash'           => new sfValidatorNumber(array('required' => false)),
      'cheque'         => new sfValidatorNumber(array('required' => false)),
      'credit'         => new sfValidatorNumber(array('required' => false)),
      'chequeno'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'chequedate'     => new sfValidatorDate(array('required' => false)),
      'balance'        => new sfValidatorNumber(array('required' => false)),
      'chequedata'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'is_inspected'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('purchase[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Purchase';
  }

}
