<?php

/**
 * Invoice form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InvoiceForm extends BaseInvoiceForm
{
  public function configure()
  {
    $this->widgetSchema['customer_id']->addOption('order_by',array('name','asc'));
    $this->widgetSchema['technician_id']= new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => true));
    //$this->widgetSchema['is_temporary']= new sfWidgetFormInputHidden();
    $this->widgetSchema['is_temporary']= new sfWidgetFormChoice(array('choices' => array('2' => 'New', '1' => 'Checked Out', '0' => 'Closed')));
    
    unset($this->widgetSchema['terms_id']);
    unset($this->widgetSchema['total']);
  }
}
