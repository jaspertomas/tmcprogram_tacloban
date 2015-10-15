<?php

/**
 * Stockentry form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StockentryForm extends BaseStockentryForm
{
  public function configure()
  {
    $this->widgetSchema["stock_id"]=new sfWidgetFormInputText();
    unset($this->widgetSchema['balance']);
    unset($this->widgetSchema['is_cancelled']);
    unset($this->widgetSchema['priority']);
    unset($this->widgetSchema['ref_class']);
    unset($this->widgetSchema['ref_id']);

    unset($this->validatorSchema['balance']);
    unset($this->validatorSchema['is_cancelled']);
    unset($this->validatorSchema['priority']);
    unset($this->validatorSchema['ref_class']);
    unset($this->validatorSchema['ref_id']);
  }
}
