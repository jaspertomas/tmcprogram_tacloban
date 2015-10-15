<?php

/**
 * Stockentry filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStockentryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'qty'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'      => new sfWidgetFormFilterInput(),
      'stock_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Stock'), 'add_empty' => true)),
      'ref_class'    => new sfWidgetFormFilterInput(),
      'ref_id'       => new sfWidgetFormFilterInput(),
      'is_cancelled' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'priority'     => new sfWidgetFormFilterInput(),
      'type'         => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'qty'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'balance'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stock_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Stock'), 'column' => 'id')),
      'ref_class'    => new sfValidatorPass(array('required' => false)),
      'ref_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_cancelled' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'priority'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stockentry_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stockentry';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'date'         => 'Date',
      'qty'          => 'Number',
      'balance'      => 'Number',
      'stock_id'     => 'ForeignKey',
      'ref_class'    => 'Text',
      'ref_id'       => 'Number',
      'is_cancelled' => 'Number',
      'priority'     => 'Number',
      'type'         => 'Text',
      'description'  => 'Text',
    );
  }
}
