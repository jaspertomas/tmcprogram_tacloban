<?php

/**
 * Event filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parent_class'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parent_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parent_name'    => new sfWidgetFormFilterInput(),
      'child_class'    => new sfWidgetFormFilterInput(),
      'children_id'    => new sfWidgetFormFilterInput(),
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'amount'         => new sfWidgetFormFilterInput(),
      'detail1'        => new sfWidgetFormFilterInput(),
      'detail2'        => new sfWidgetFormFilterInput(),
      'detail3'        => new sfWidgetFormFilterInput(),
      'notes'          => new sfWidgetFormFilterInput(),
      'is_cancelled'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'checkcleardate' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'type'           => new sfValidatorPass(array('required' => false)),
      'parent_class'   => new sfValidatorPass(array('required' => false)),
      'parent_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parent_name'    => new sfValidatorPass(array('required' => false)),
      'child_class'    => new sfValidatorPass(array('required' => false)),
      'children_id'    => new sfValidatorPass(array('required' => false)),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'amount'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'detail1'        => new sfValidatorPass(array('required' => false)),
      'detail2'        => new sfValidatorPass(array('required' => false)),
      'detail3'        => new sfValidatorPass(array('required' => false)),
      'notes'          => new sfValidatorPass(array('required' => false)),
      'is_cancelled'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'checkcleardate' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'type'           => 'Text',
      'parent_class'   => 'Text',
      'parent_id'      => 'Number',
      'parent_name'    => 'Text',
      'child_class'    => 'Text',
      'children_id'    => 'Text',
      'date'           => 'Date',
      'amount'         => 'Number',
      'detail1'        => 'Text',
      'detail2'        => 'Text',
      'detail3'        => 'Text',
      'notes'          => 'Text',
      'is_cancelled'   => 'Number',
      'checkcleardate' => 'Date',
    );
  }
}
