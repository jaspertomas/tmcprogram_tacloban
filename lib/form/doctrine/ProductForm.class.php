<?php

/**
 * Product form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductForm extends BaseProductForm
{
  public function configure()
  {
    //$this->widgetSchema['producttype_id']->addOption('add_empty',true);
    $this->widgetSchema['producttype_id']->addOption('order_by',array('name','asc'));
    $this->widgetSchema['name']->setAttribute('size',50);

  }
}
