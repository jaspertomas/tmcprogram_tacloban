<?php

/**
 * Journaldetail form base class.
 *
 * @method Journaldetail getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJournaldetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'event_id'    => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDate(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'journal_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Journal'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'event_id'    => new sfValidatorInteger(array('required' => false)),
      'date'        => new sfValidatorDate(array('required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 30)),
      'description' => new sfValidatorString(array('max_length' => 30)),
      'journal_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Journal'))),
    ));

    $this->widgetSchema->setNameFormat('journaldetail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Journaldetail';
  }

}
