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
  </tr>
  <?php foreach($stocks as $stock){?>
  <tr>
    <td><?php echo link_to($stock->getProduct(),"product/view?id=".$stock->getProductId()) ?></td>
    <td><?php echo $stock->getProduct()->getDescription() ?></td>
    <td><?php echo $stock->getCurrentQty() ?></td>
    <td><?php echo link_to("View Stock","stock/view?id=".$stock->getId()) ?></td>
    <td><?php echo link_to("Edit Stock","stock/view?id=".$stock->getId()) ?></td>
  </tr>
  <?php }?>
</table>



