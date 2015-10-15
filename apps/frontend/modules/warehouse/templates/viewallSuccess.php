<?php use_helper('I18N', 'Date') ?>
<h1>Warehouse Edit</h1>



      <table>
        <tr>
          <td>Date</td>
          <td><?php echo $warehouse->getName() ?></td>
        </tr>
        <tr>
          <td><?php echo link_to("Edit","warehouse/edit?id=".$warehouse->getId()) ?></td>
        </tr>
      </table>



<br>
<br>


<br>
<table border=1>
  <tr>
    <td>Product</td>
    <td>Description</td>
    <td>Qty</td>
    <td>Unit Price</td>
    <td>Total</td>
  </tr>
  <?php foreach($warehouse->getStock() as $stock){?>
  <tr>
    <td><?php echo link_to($stock->getProduct(),"product/view?id=".$stock->getProductId()) ?></td>
  </tr>
  <?php }?>
</table>



