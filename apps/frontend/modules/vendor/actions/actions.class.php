<?php

require_once dirname(__FILE__).'/../lib/vendorGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/vendorGeneratorHelper.class.php';

/**
 * vendor actions.
 *
 * @package    sf_sandbox
 * @subpackage vendor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vendorActions extends autoVendorActions
{
  public function executeView(sfWebRequest $request)
  {
    $this->vendor = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->vendor);
  }
}
