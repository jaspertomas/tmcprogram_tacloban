<?php

/**
 * Journaldetail filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJournaldetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'event_id'    => new sfWidgetFormFilterInput(),
      'date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'journal_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journal'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'event_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'journal_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Journal'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('journaldetail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journaldetail';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'event_id'    => 'Number',
      'date'        => 'Date',
      'name'        => 'Text',
      'description' => 'Text',
      'journal_id'  => 'ForeignKey',
    );
  }
}
