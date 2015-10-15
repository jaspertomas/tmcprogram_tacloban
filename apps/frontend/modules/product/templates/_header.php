<ul class="sf_admin_actions">
<?php $invoice=$form->getObject();?>
<?php if($invoice->getId()){?>
	<li>  
	<?php echo link_to(
	  'Delete',
	  'invoice/delete?id='.$invoice->getId(),
	  array('method' => 'delete', 'confirm' => 'Are you sure?')
	) ?>
	</li>  
	<li class="sf_admin_action_list">
		<?php echo link_to("Cancel","invoice/view?id=".$invoice->getId())?>
	</li>  
    <li class="sf_admin_action_save_and_add">
      <input value="Save and add" name="_save_and_add" type="submit">
    </li>
<?php } else {?>
	<li class="sf_admin_action_list">
		<?php echo link_to("Cancel","home/index")?>
	</li>  
    <li class="sf_admin_action_save_and_add">
      <input value="Save and add" name="_save_and_add" type="submit">
    </li>
<?php } ?>
</ul>
