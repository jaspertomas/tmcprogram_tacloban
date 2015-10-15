<input name=producttype[name] size=5>

<?php $productform=new ProductForm()?>
<?php echo $productform["producttype_id"] ?>

<li class="sf_admin_batch_actions_choice">
  <select name="batch_action">
    <option value=""><?php echo __('Choose an action', array(), 'sf_admin') ?></option>
    <option value="batchSetproducttype"><?php echo __('Setproducttype', array(), 'sf_admin') ?></option>
    <option value="batchCreateproducttype"><?php echo __('Createproducttype', array(), 'sf_admin') ?></option>
  </select>
  <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
    <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>" />
  <?php endif; ?>
  <input type="submit" value="<?php echo __('go', array(), 'sf_admin') ?>" />
</li>
