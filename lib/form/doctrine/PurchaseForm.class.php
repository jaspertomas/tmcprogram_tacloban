<?php

/**
 * Purchase form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PurchaseForm extends BasePurchaseForm
{
  public function configure()
  {
    $this->widgetSchema['vendor_id']->addOption('order_by',array('name','asc'));
    unset($this->widgetSchema['terms_id']);
    unset($this->widgetSchema['total']);
  }
}
