<?php

/**
 * Invoice form base class.
 *
 * @method Invoice getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInvoiceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'customer_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customer'), 'add_empty' => false)),
      'customer_name'      => new sfWidgetFormInputText(),
      'customer_phone'     => new sfWidgetFormInputText(),
      'invno'              => new sfWidgetFormInputText(),
      'ponumber'           => new sfWidgetFormInputText(),
      'notes'              => new sfWidgetFormTextarea(),
      'payonly'            => new sfWidgetFormInputText(),
      'total'              => new sfWidgetFormInputText(),
      'cheque'             => new sfWidgetFormInputText(),
      'chequedate'         => new sfWidgetFormDate(),
      'date'               => new sfWidgetFormDate(),
      'duedate'            => new sfWidgetFormDate(),
      'datepaid'           => new sfWidgetFormDate(),
      'terms_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Terms'), 'add_empty' => true)),
      'salesman_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => false)),
      'technician_id'      => new sfWidgetFormInputText(),
      'template_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InvoiceTemplate'), 'add_empty' => true)),
      'cash'               => new sfWidgetFormInputText(),
      'chequeamt'          => new sfWidgetFormInputText(),
      'credit'             => new sfWidgetFormInputText(),
      'discrate'           => new sfWidgetFormInputText(),
      'discamt'            => new sfWidgetFormInputText(),
      'saletype'           => new sfWidgetFormChoice(array('choices' => array('Cash' => 'Cash', 'Cheque' => 'Cheque', 'Account' => 'Account', 'Other' => 'Other'))),
      'status'             => new sfWidgetFormChoice(array('choices' => array('Pending' => 'Pending', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'))),
      'dsrdeduction'       => new sfWidgetFormInputText(),
      'balance'            => new sfWidgetFormInputText(),
      'chequedata'         => new sfWidgetFormInputText(),
      'checkcleardate'     => new sfWidgetFormDate(),
      'checkcollectevents' => new sfWidgetFormInputText(),
      'hidden'             => new sfWidgetFormInputText(),
      'is_inspected'       => new sfWidgetFormInputText(),
      'is_temporary'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'customer_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Customer'))),
      'customer_name'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'customer_phone'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'invno'              => new sfValidatorString(array('max_length' => 20)),
      'ponumber'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'notes'              => new sfValidatorString(array('required' => false)),
      'payonly'            => new sfValidatorNumber(array('required' => false)),
      'total'              => new sfValidatorNumber(array('required' => false)),
      'cheque'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'chequedate'         => new sfValidatorDate(array('required' => false)),
      'date'               => new sfValidatorDate(),
      'duedate'            => new sfValidatorDate(array('required' => false)),
      'datepaid'           => new sfValidatorDate(array('required' => false)),
      'terms_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Terms'), 'required' => false)),
      'salesman_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'))),
      'technician_id'      => new sfValidatorInteger(array('required' => false)),
      'template_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InvoiceTemplate'), 'required' => false)),
      'cash'               => new sfValidatorNumber(array('required' => false)),
      'chequeamt'          => new sfValidatorNumber(array('required' => false)),
      'credit'             => new sfValidatorNumber(array('required' => false)),
      'discrate'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'discamt'            => new sfValidatorNumber(array('required' => false)),
      'saletype'           => new sfValidatorChoice(array('choices' => array(0 => 'Cash', 1 => 'Cheque', 2 => 'Account', 3 => 'Other'), 'required' => false)),
      'status'             => new sfValidatorChoice(array('choices' => array(0 => 'Pending', 1 => 'Paid', 2 => 'Cancelled'), 'required' => false)),
      'dsrdeduction'       => new sfValidatorNumber(array('required' => false)),
      'balance'            => new sfValidatorNumber(array('required' => false)),
      'chequedata'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'checkcleardate'     => new sfValidatorDate(array('required' => false)),
      'checkcollectevents' => new sfValidatorInteger(array('required' => false)),
      'hidden'             => new sfValidatorInteger(array('required' => false)),
      'is_inspected'       => new sfValidatorInteger(array('required' => false)),
      'is_temporary'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('invoice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoice';
  }

}
