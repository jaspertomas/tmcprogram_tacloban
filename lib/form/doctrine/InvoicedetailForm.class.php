<?php

/**
 * Invoicedetail form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InvoicedetailForm extends BaseInvoicedetailForm
{
  public function configure()
  {
    /*thanks to http://stackoverflow.com/questions/2280689/how-to-order-by-a-sfwidgetformdoctrinechoice-in-the-admin-generator*/
    //$this->widgetSchema['product_id']->addOption('order_by',array('name','asc'));
    $this->widgetSchema['product_id']= new sfWidgetFormInputHidden();
    $this->widgetSchema['discrate']->setAttribute('size',10);
    $this->widgetSchema['discamt']->setAttribute('size',10);
    $this->widgetSchema['price']->setAttribute('size',10);
    $this->widgetSchema['qty']->setAttribute('size',10);
  }
}
