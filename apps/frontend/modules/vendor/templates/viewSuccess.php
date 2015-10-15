<?php use_helper('I18N', 'Date') ?>
<h1>Vendor: <?php echo $vendor->getName() ?></h1>



<table>
  <tr>
    <td>Name</td>
    <td><?php echo $vendor->getName() ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("Edit","vendor/edit?id=".$vendor->getId()) ?></td>
  </tr>
</table>

<br>
<br>
<?php echo link_to("Add Quote","quote/new?vendor_id=".$vendor->getId()) ?>
<table border=1>
  <tr>
    <td>Date</td>
    <td>Product</td>
    <td>Description</td>
    <td>Price</td>
  </tr>
  <?php foreach($vendor->getQuote() as $detail)
  {?>
  <tr>
    <td><?php echo MyDateTime::frommysql($detail->getDate())->toshortdate() ?></td>
    <td><?php echo link_to($detail->getProduct(),"product/view?id=".$detail->getProductId()) ?></td>
    <td><?php echo $detail->getProduct()->getDescription() ?></td>
    <td><?php echo $detail->getPrice() ?></td>
    <td><?php //echo link_to(  'Delete',  'quote/delete?id='.$detail->getId(),  array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
  </tr>
  <?php }?>
</table>

