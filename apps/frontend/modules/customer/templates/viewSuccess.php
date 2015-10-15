<?php use_helper('I18N', 'Date'); ?>
<h1>Customer Purchases: <?php echo $customer?> </h1>
Phone: <?php echo $customer->getPhone1()?>,<?php echo $customer->getPhone2()?>
<br><?php echo link_to("Edit","customer/edit?id=".$customer->getId()) ?><!--table>
  <tr>
    <td>Name</td>
    <td><?php //echo $customer->getName() ?></td>
    <td></td>
  </tr>
</table-->
<br>
<br>
<table border=1>
  <tr>
    <td>Date</td>
    <td>Invoice</td>
    <td>Product</td>
    <td>Qty</td>
    <td>Price</td>
    <td>Discrate</td>
    <td>Discamt</td>
    <td>Total</td>
  </tr>
  <?php foreach($customer->getInvoices("desc") as $invoice){?>
  <tr>
    <td><?php echo $invoice->getDate() ?></td>
    <td><?php echo link_to($invoice,"invoice/view?id=".$invoice->getId()) ?></td>
  </tr>
  <?php foreach($invoice->getInvoicedetail() as $detail){?>
  <tr>
  	<td></td>
  	<td></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td><?php echo $detail->getQty() ?></td>
    <td><?php echo $detail->getPrice() ?></td>
    <td><?php echo $detail->getDiscrate() ?></td>
    <td><?php echo $detail->getDiscamt() ?></td>
    <td><?php echo $detail->getTotal() ?></td>
    <td><?php echo $detail->getInvoice()->getCustomer() ?></td>
  </tr>
  <?php }?>
  <?php } ?>
</table>



