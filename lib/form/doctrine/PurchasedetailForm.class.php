<?php

/**
 * Purchasedetail form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PurchasedetailForm extends BasePurchasedetailForm
{
  public function configure()
  {
    $this->widgetSchema['product_id']->addOption('order_by',array('name','asc'));
  }
}
