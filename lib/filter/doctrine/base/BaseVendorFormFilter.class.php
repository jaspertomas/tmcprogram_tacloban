<?php

/**
 * Vendor filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVendorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'   => new sfWidgetFormFilterInput(),
      'addr1'  => new sfWidgetFormFilterInput(),
      'addr2'  => new sfWidgetFormFilterInput(),
      'addr3'  => new sfWidgetFormFilterInput(),
      'vtype'  => new sfWidgetFormFilterInput(),
      'cont1'  => new sfWidgetFormFilterInput(),
      'cont2'  => new sfWidgetFormFilterInput(),
      'phone1' => new sfWidgetFormFilterInput(),
      'phone2' => new sfWidgetFormFilterInput(),
      'faxnum' => new sfWidgetFormFilterInput(),
      'email'  => new sfWidgetFormFilterInput(),
      'note'   => new sfWidgetFormFilterInput(),
      'taxid'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'   => new sfValidatorPass(array('required' => false)),
      'addr1'  => new sfValidatorPass(array('required' => false)),
      'addr2'  => new sfValidatorPass(array('required' => false)),
      'addr3'  => new sfValidatorPass(array('required' => false)),
      'vtype'  => new sfValidatorPass(array('required' => false)),
      'cont1'  => new sfValidatorPass(array('required' => false)),
      'cont2'  => new sfValidatorPass(array('required' => false)),
      'phone1' => new sfValidatorPass(array('required' => false)),
      'phone2' => new sfValidatorPass(array('required' => false)),
      'faxnum' => new sfValidatorPass(array('required' => false)),
      'email'  => new sfValidatorPass(array('required' => false)),
      'note'   => new sfValidatorPass(array('required' => false)),
      'taxid'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('vendor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vendor';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'name'   => 'Text',
      'addr1'  => 'Text',
      'addr2'  => 'Text',
      'addr3'  => 'Text',
      'vtype'  => 'Text',
      'cont1'  => 'Text',
      'cont2'  => 'Text',
      'phone1' => 'Text',
      'phone2' => 'Text',
      'faxnum' => 'Text',
      'email'  => 'Text',
      'note'   => 'Text',
      'taxid'  => 'Text',
    );
  }
}
