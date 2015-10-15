<?php

/**
 * Incheck filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseIncheckFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'checkno'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'datereceived' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'status'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'Pending' => 'Pending', 'Cleared' => 'Cleared', 'Bounced' => 'Bounced'))),
      'amount'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'checkno'      => new sfValidatorPass(array('required' => false)),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datereceived' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'status'       => new sfValidatorChoice(array('required' => false, 'choices' => array('Pending' => 'Pending', 'Cleared' => 'Cleared', 'Bounced' => 'Bounced'))),
      'amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'customer_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('incheck_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Incheck';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'checkno'      => 'Text',
      'date'         => 'Date',
      'datereceived' => 'Date',
      'status'       => 'Enum',
      'amount'       => 'Number',
      'customer_id'  => 'Number',
    );
  }
}
