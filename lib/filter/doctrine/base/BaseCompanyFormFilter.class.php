<?php

/**
 * Company filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCompanyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'first_name'    => new sfWidgetFormFilterInput(),
      'last_name'     => new sfWidgetFormFilterInput(),
      'address'       => new sfWidgetFormFilterInput(),
      'city'          => new sfWidgetFormFilterInput(),
      'state_'        => new sfWidgetFormFilterInput(),
      'zip'           => new sfWidgetFormFilterInput(),
      'country_id'    => new sfWidgetFormFilterInput(),
      'phone'         => new sfWidgetFormFilterInput(),
      'email_address' => new sfWidgetFormFilterInput(),
      'is_customer'   => new sfWidgetFormFilterInput(),
      'is_vendor'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'first_name'    => new sfValidatorPass(array('required' => false)),
      'last_name'     => new sfValidatorPass(array('required' => false)),
      'address'       => new sfValidatorPass(array('required' => false)),
      'city'          => new sfValidatorPass(array('required' => false)),
      'state_'        => new sfValidatorPass(array('required' => false)),
      'zip'           => new sfValidatorPass(array('required' => false)),
      'country_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'phone'         => new sfValidatorPass(array('required' => false)),
      'email_address' => new sfValidatorPass(array('required' => false)),
      'is_customer'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_vendor'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('company_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Company';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'first_name'    => 'Text',
      'last_name'     => 'Text',
      'address'       => 'Text',
      'city'          => 'Text',
      'state_'        => 'Text',
      'zip'           => 'Text',
      'country_id'    => 'Number',
      'phone'         => 'Text',
      'email_address' => 'Text',
      'is_customer'   => 'Number',
      'is_vendor'     => 'Number',
    );
  }
}
