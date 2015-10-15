<?php

/**
 * Event form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
  public function configure()
  {
    $this->widgetSchema['type']= new sfWidgetFormInputHidden();
    $this->widgetSchema['parent_class']= new sfWidgetFormInputHidden();
    $this->widgetSchema['parent_id']= new sfWidgetFormInputHidden();
    $this->widgetSchema['parent_name']= new sfWidgetFormInputHidden();
    $this->widgetSchema['child_class']= new sfWidgetFormInputHidden();
    $this->widgetSchema['children_id']= new sfWidgetFormInputHidden();
    $this->widgetSchema['detail1']= new sfWidgetFormInputHidden();
    $this->widgetSchema['detail2']= new sfWidgetFormInputHidden();
    $this->widgetSchema['detail3']= new sfWidgetFormInputHidden();
  }
}
