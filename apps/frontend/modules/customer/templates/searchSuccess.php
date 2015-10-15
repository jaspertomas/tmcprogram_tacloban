<?php use_helper('I18N', 'Date'); ?>
<h1>Customer Search</h1>
<table border="1">
  <tr>
    <td>Name</td>
    <td></td>
  </tr>
  <?php foreach($customers as $customer){?>
  <tr>
    <td><?php echo $customer->getName() ?></td>
    <td><?php echo link_to("View","customer/view?id=".$customer->getId()) ?></td>
  </tr>
  <?php } ?>
</table>