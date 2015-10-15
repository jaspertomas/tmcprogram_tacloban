<?php

/**
 * Producttype filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProducttypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'parent_id'   => new sfWidgetFormFilterInput(),
      'priority'    => new sfWidgetFormFilterInput(),
      'category1'   => new sfWidgetFormFilterInput(),
      'category2'   => new sfWidgetFormFilterInput(),
      'category3'   => new sfWidgetFormFilterInput(),
      'category4'   => new sfWidgetFormFilterInput(),
      'category5'   => new sfWidgetFormFilterInput(),
      'category6'   => new sfWidgetFormFilterInput(),
      'category7'   => new sfWidgetFormFilterInput(),
      'category8'   => new sfWidgetFormFilterInput(),
      'category9'   => new sfWidgetFormFilterInput(),
      'category10'  => new sfWidgetFormFilterInput(),
      'path_ids'    => new sfWidgetFormFilterInput(),
      'path'        => new sfWidgetFormFilterInput(),
      'notes'       => new sfWidgetFormFilterInput(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'Red' => 'Red', 'Orange' => 'Orange', 'Yellow' => 'Yellow', 'Green' => 'Green', 'Blue' => 'Blue', 'Indigo' => 'Indigo', 'Violet' => 'Violet'))),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'parent_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'priority'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category1'   => new sfValidatorPass(array('required' => false)),
      'category2'   => new sfValidatorPass(array('required' => false)),
      'category3'   => new sfValidatorPass(array('required' => false)),
      'category4'   => new sfValidatorPass(array('required' => false)),
      'category5'   => new sfValidatorPass(array('required' => false)),
      'category6'   => new sfValidatorPass(array('required' => false)),
      'category7'   => new sfValidatorPass(array('required' => false)),
      'category8'   => new sfValidatorPass(array('required' => false)),
      'category9'   => new sfValidatorPass(array('required' => false)),
      'category10'  => new sfValidatorPass(array('required' => false)),
      'path_ids'    => new sfValidatorPass(array('required' => false)),
      'path'        => new sfValidatorPass(array('required' => false)),
      'notes'       => new sfValidatorPass(array('required' => false)),
      'status'      => new sfValidatorChoice(array('required' => false, 'choices' => array('Red' => 'Red', 'Orange' => 'Orange', 'Yellow' => 'Yellow', 'Green' => 'Green', 'Blue' => 'Blue', 'Indigo' => 'Indigo', 'Violet' => 'Violet'))),
    ));

    $this->widgetSchema->setNameFormat('producttype_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producttype';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'description' => 'Text',
      'parent_id'   => 'Number',
      'priority'    => 'Number',
      'category1'   => 'Text',
      'category2'   => 'Text',
      'category3'   => 'Text',
      'category4'   => 'Text',
      'category5'   => 'Text',
      'category6'   => 'Text',
      'category7'   => 'Text',
      'category8'   => 'Text',
      'category9'   => 'Text',
      'category10'  => 'Text',
      'path_ids'    => 'Text',
      'path'        => 'Text',
      'notes'       => 'Text',
      'status'      => 'Enum',
    );
  }
}
