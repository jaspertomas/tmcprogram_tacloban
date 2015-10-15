<?php use_helper('I18N', 'Date') ?>
<h1>Product Inventory: <?php echo $product?></h1>
<table>
  <tr>
    <td>Name</td>
    <td><?php echo $product->getName() ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("Edit","product/edit?id=".$product->getId()) ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("View Transactions","product/view?id=".$product->getId()) ?></td>
  </tr>
</table>
<br>
<br>
<table border=1>
  <tr>
    <td>Warehouse</td>
    <td>Qty</td>
    <td>View</td>
  </tr>
  <?php foreach(WarehouseTable::fetchAll() as $warehouse)
    {
    $stock=StockTable::fetch($warehouse->getId(), $product->getId());
  ?>
  <tr>
    <td><?php echo $warehouse->getName() ?></td>
    <td><?php echo $stock->getCurrentQty() ?></td>
    <td><?php echo link_to("View","stock/view?id=".$stock->getId()) ?></td>
  </tr>
  <?php }?>
</table>
