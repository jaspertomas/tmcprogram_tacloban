<?php

/**
 * Countries filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCountriesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'country'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('countries_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Countries';
  }

  public function getFields()
  {
    return array(
      'country_id' => 'Number',
      'country'    => 'Text',
    );
  }
}
