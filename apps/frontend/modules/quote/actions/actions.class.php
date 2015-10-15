<?php

require_once dirname(__FILE__).'/../lib/quoteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/quoteGeneratorHelper.class.php';

/**
 * quote actions.
 *
 * @package    sf_sandbox
 * @subpackage quote
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class quoteActions extends autoQuoteActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->quote = new Quote();
    $this->quote->setDate(MyDateTime::today()->tomysql());
    $this->quote->setPrice(0);
    $this->quote->setVendorId($request->getParameter("vendor_id"));
    $this->form = $this->configuration->getForm($this->quote);
  }
  public function executePricelist(sfWebRequest $request)
  {
    $this->redirect("producttype/view?id=".$this->getRoute()->getObject()->getProduct()->getProducttypeId());
  }
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $quote = $form->save();
        $quote->getProduct()->calc();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $quote)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@quote_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect("vendor/view?id=".$quote->getVendorId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
