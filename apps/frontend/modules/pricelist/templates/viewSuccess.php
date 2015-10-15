<?php use_helper('I18N', 'Date') ?>
<font size=6><b>Price List: <?php echo $pricelist?></b></font> as of <font size=6><b><?php echo $pricelist->getDateTimeObject("date")->format('M d, Y')?></b></font>

<br>
<br><?php echo "Vendor: ".link_to($pricelist->getVendor(),"vendor/view?id=".$pricelist->getVendorId()) ?>

<br><?php echo link_to("Edit","pricelist/edit?id=".$pricelist->getId()) ?>
<br><?php echo link_to("Quick Input","pricelist/quickinput?id=".$pricelist->getId()) ?>
<br>
<br><?php echo link_to("Add quote","quote/new?invoice_id=".$pricelist->getId()) ?>
<table border=1>
  <tr>
    <td>Product</td>
    <td>Description</td>
    <td>Vendor</td>
    <td>Gross</td>
    <td>Discrate</td>
    <td>Discamt</td>
    <td>Sell Price</td>
    <td></td>
    <td></td>
    <td>Gross</td>
    <td>Discrate</td>
    <td>Discamt</td>
    <td>Puhunan</td>
  </tr>
  <?php foreach($pricelist->getQuickInputProductArrays() as $productname=>$quotearray){
  	$product=$quotearray["product"];
  	$buyquote=$quotearray["buy"]?$quotearray["buy"]:new Quote();
  	$sellquote=$quotearray["sell"]?$quotearray["sell"]:new Quote();
  	?>
  <tr>
    <td><?php echo link_to($product,"product/view?id=".$product->getId()) ?></td>
    <td><?php echo $product->getDescription() ?></td>
    <td><?php echo $sellquote->getVendor() ?></td>
    <td align=right><?php echo $buyquote->getPrice() ?></td>
    <td align=right><?php echo $buyquote->getDiscrate() ?></td>
    <td align=right><?php echo $buyquote->getDiscamt() ?></td>
    <td align=right><?php echo $buyquote->getTotal() ?></td>
    <td><?php echo link_to("Edit","quote/edit?id=".$buyquote->getId()) ?></td>
    <td><?php echo link_to(  'Delete',  'quote/delete?id='.$sellquote->getId(),  array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
    <td align=right><?php echo $sellquote->getPrice() ?></td>
    <td align=right><?php echo $sellquote->getDiscrate() ?></td>
    <td align=right><?php echo $sellquote->getDiscamt() ?></td>
    <td align=right><?php echo $sellquote->getTotal() ?></td>
    <td><?php echo link_to("Edit","quote/edit?id=".$sellquote->getId()) ?></td>
    <td><?php echo link_to(  'Delete',  'quote/delete?id='.$sellquote->getId(),  array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>

    </td>
  </tr>
  <?php }?>
</table>

