<?php

/**
 * Customer filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCustomerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(),
      'tin_no'     => new sfWidgetFormFilterInput(),
      'address'    => new sfWidgetFormFilterInput(),
      'phone1'     => new sfWidgetFormFilterInput(),
      'phone2'     => new sfWidgetFormFilterInput(),
      'faxnum'     => new sfWidgetFormFilterInput(),
      'email'      => new sfWidgetFormFilterInput(),
      'note'       => new sfWidgetFormFilterInput(),
      'rep'        => new sfWidgetFormFilterInput(),
      'repno'      => new sfWidgetFormFilterInput(),
      'rep2'       => new sfWidgetFormFilterInput(),
      'rep2no'     => new sfWidgetFormFilterInput(),
      'taxitem'    => new sfWidgetFormFilterInput(),
      'notepad'    => new sfWidgetFormFilterInput(),
      'salutation' => new sfWidgetFormFilterInput(),
      'is_suki'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'tin_no'     => new sfValidatorPass(array('required' => false)),
      'address'    => new sfValidatorPass(array('required' => false)),
      'phone1'     => new sfValidatorPass(array('required' => false)),
      'phone2'     => new sfValidatorPass(array('required' => false)),
      'faxnum'     => new sfValidatorPass(array('required' => false)),
      'email'      => new sfValidatorPass(array('required' => false)),
      'note'       => new sfValidatorPass(array('required' => false)),
      'rep'        => new sfValidatorPass(array('required' => false)),
      'repno'      => new sfValidatorPass(array('required' => false)),
      'rep2'       => new sfValidatorPass(array('required' => false)),
      'rep2no'     => new sfValidatorPass(array('required' => false)),
      'taxitem'    => new sfValidatorPass(array('required' => false)),
      'notepad'    => new sfValidatorPass(array('required' => false)),
      'salutation' => new sfValidatorPass(array('required' => false)),
      'is_suki'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('customer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Customer';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'name'       => 'Text',
      'tin_no'     => 'Text',
      'address'    => 'Text',
      'phone1'     => 'Text',
      'phone2'     => 'Text',
      'faxnum'     => 'Text',
      'email'      => 'Text',
      'note'       => 'Text',
      'rep'        => 'Text',
      'repno'      => 'Text',
      'rep2'       => 'Text',
      'rep2no'     => 'Text',
      'taxitem'    => 'Text',
      'notepad'    => 'Text',
      'salutation' => 'Text',
      'is_suki'    => 'Number',
    );
  }
}
