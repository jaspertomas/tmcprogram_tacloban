<?php

/**
 * Purchase filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePurchaseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pono'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'invno'          => new sfWidgetFormFilterInput(),
      'total'          => new sfWidgetFormFilterInput(),
      'memo'           => new sfWidgetFormFilterInput(),
      'tax'            => new sfWidgetFormFilterInput(),
      'vendor_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vendor'), 'add_empty' => true)),
      'vendor_name'    => new sfWidgetFormFilterInput(),
      'terms_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Terms'), 'add_empty' => true)),
      'employee_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => true)),
      'template_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PurchaseTemplate'), 'add_empty' => true)),
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'datereceived'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'duedate'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'vendor_invoice' => new sfWidgetFormFilterInput(),
      'discrate'       => new sfWidgetFormFilterInput(),
      'discamt'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Pending' => 'Pending', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'))),
      'type'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'Account' => 'Account', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Other' => 'Other'))),
      'cash'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cheque'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'credit'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'chequeno'       => new sfWidgetFormFilterInput(),
      'chequedate'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'balance'        => new sfWidgetFormFilterInput(),
      'chequedata'     => new sfWidgetFormFilterInput(),
      'is_inspected'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'pono'           => new sfValidatorPass(array('required' => false)),
      'invno'          => new sfValidatorPass(array('required' => false)),
      'total'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'memo'           => new sfValidatorPass(array('required' => false)),
      'tax'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vendor_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vendor'), 'column' => 'id')),
      'vendor_name'    => new sfValidatorPass(array('required' => false)),
      'terms_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Terms'), 'column' => 'id')),
      'employee_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Employee'), 'column' => 'id')),
      'template_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PurchaseTemplate'), 'column' => 'id')),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datereceived'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'duedate'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'vendor_invoice' => new sfValidatorPass(array('required' => false)),
      'discrate'       => new sfValidatorPass(array('required' => false)),
      'discamt'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Pending' => 'Pending', 'Paid' => 'Paid', 'Cancelled' => 'Cancelled'))),
      'type'           => new sfValidatorChoice(array('required' => false, 'choices' => array('Account' => 'Account', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Other' => 'Other'))),
      'cash'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cheque'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'credit'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'chequeno'       => new sfValidatorPass(array('required' => false)),
      'chequedate'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'balance'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'chequedata'     => new sfValidatorPass(array('required' => false)),
      'is_inspected'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('purchase_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Purchase';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'pono'           => 'Text',
      'invno'          => 'Text',
      'total'          => 'Number',
      'memo'           => 'Text',
      'tax'            => 'Number',
      'vendor_id'      => 'ForeignKey',
      'vendor_name'    => 'Text',
      'terms_id'       => 'ForeignKey',
      'employee_id'    => 'ForeignKey',
      'template_id'    => 'ForeignKey',
      'date'           => 'Date',
      'datereceived'   => 'Date',
      'duedate'        => 'Date',
      'vendor_invoice' => 'Text',
      'discrate'       => 'Text',
      'discamt'        => 'Number',
      'status'         => 'Enum',
      'type'           => 'Enum',
      'cash'           => 'Number',
      'cheque'         => 'Number',
      'credit'         => 'Number',
      'chequeno'       => 'Text',
      'chequedate'     => 'Date',
      'balance'        => 'Number',
      'chequedata'     => 'Text',
      'is_inspected'   => 'Number',
    );
  }
}
