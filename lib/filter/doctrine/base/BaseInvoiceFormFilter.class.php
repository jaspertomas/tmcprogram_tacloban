<?php

/**
 * Invoice filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInvoiceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'customer_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customer'), 'add_empty' => true)),
      'customer_name'      => new sfWidgetFormFilterInput(),
      'customer_phone'     => new sfWidgetFormFilterInput(),
      'invno'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ponumber'           => new sfWidgetFormFilterInput(),
      'notes'              => new sfWidgetFormFilterInput(),
      'payonly'            => new sfWidgetFormFilterInput(),
      'total'              => new sfWidgetFormFilterInput(),
      'cheque'             => new sfWidgetFormFilterInput(),
      'chequedate'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'duedate'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datepaid'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'terms_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Terms'), 'add_empty' => true)),
      'salesman_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => true)),
      'technician_id'      => new sfWidgetFormFilterInput(),
      'template_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InvoiceTemplate'), 'add_empty' => true)),
      'cash'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'chequeamt'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'credit'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discrate'           => new sfWidgetFormFilterInput(),
      'discamt'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'saletype'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Account' => 'Account', 'Other' => 'Other'))),
      'status'             => new sfWidgetFormChoice(array('choices' => array('' => '', 'Pending' => 'Pending', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'))),
      'dsrdeduction'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'            => new sfWidgetFormFilterInput(),
      'chequedata'         => new sfWidgetFormFilterInput(),
      'checkcleardate'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'checkcollectevents' => new sfWidgetFormFilterInput(),
      'hidden'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_inspected'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_temporary'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'customer_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Customer'), 'column' => 'id')),
      'customer_name'      => new sfValidatorPass(array('required' => false)),
      'customer_phone'     => new sfValidatorPass(array('required' => false)),
      'invno'              => new sfValidatorPass(array('required' => false)),
      'ponumber'           => new sfValidatorPass(array('required' => false)),
      'notes'              => new sfValidatorPass(array('required' => false)),
      'payonly'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cheque'             => new sfValidatorPass(array('required' => false)),
      'chequedate'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'duedate'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datepaid'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'terms_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Terms'), 'column' => 'id')),
      'salesman_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Employee'), 'column' => 'id')),
      'technician_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'template_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('InvoiceTemplate'), 'column' => 'id')),
      'cash'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'chequeamt'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'credit'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discrate'           => new sfValidatorPass(array('required' => false)),
      'discamt'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'saletype'           => new sfValidatorChoice(array('required' => false, 'choices' => array('Cash' => 'Cash', 'Cheque' => 'Cheque', 'Account' => 'Account', 'Other' => 'Other'))),
      'status'             => new sfValidatorChoice(array('required' => false, 'choices' => array('Pending' => 'Pending', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'))),
      'dsrdeduction'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'balance'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'chequedata'         => new sfValidatorPass(array('required' => false)),
      'checkcleardate'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'checkcollectevents' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hidden'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_inspected'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_temporary'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('invoice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoice';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'customer_id'        => 'ForeignKey',
      'customer_name'      => 'Text',
      'customer_phone'     => 'Text',
      'invno'              => 'Text',
      'ponumber'           => 'Text',
      'notes'              => 'Text',
      'payonly'            => 'Number',
      'total'              => 'Number',
      'cheque'             => 'Text',
      'chequedate'         => 'Date',
      'date'               => 'Date',
      'duedate'            => 'Date',
      'datepaid'           => 'Date',
      'terms_id'           => 'ForeignKey',
      'salesman_id'        => 'ForeignKey',
      'technician_id'      => 'Number',
      'template_id'        => 'ForeignKey',
      'cash'               => 'Number',
      'chequeamt'          => 'Number',
      'credit'             => 'Number',
      'discrate'           => 'Text',
      'discamt'            => 'Number',
      'saletype'           => 'Enum',
      'status'             => 'Enum',
      'dsrdeduction'       => 'Number',
      'balance'            => 'Number',
      'chequedata'         => 'Text',
      'checkcleardate'     => 'Date',
      'checkcollectevents' => 'Number',
      'hidden'             => 'Number',
      'is_inspected'       => 'Number',
      'is_temporary'       => 'Number',
    );
  }
}
