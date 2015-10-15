<?php use_helper('I18N', 'Date') ?>
<h1>Product Transactions: <?php echo $product?></h1>
<table>
  <tr>
    <td>Name</td>
    <td><?php echo $product->getName() ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("Edit","product/edit?id=".$product->getId()) ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("Create Barcodes","purchase/barcode?id=".$product->getId()) ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("View Inventory","product/inventory?id=".$product->getId()) ?></td>
  </tr>
  <tr>
    <td><?php echo link_to("View Price List","product/pricelist?id=".$product->getId()) ?></td>
  </tr>
</table>
<br>
<br>
<table border=1>
  <tr>
    <td>Product</td>
    <td>Date</td>
    <td>Description</td>
    <td>Qty</td>
    <td>Unit</td>
    <td>Discount</td>
    <td>Discount</td>
    <td>Total</td>
    <td>Customer</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Price</td>
    <td>Rate</td>
    <td>Amount</td>
    <td></td>
    <td></td>
  </tr>
  <?php foreach($product->getInvoicedetail() as $detail){?>
  <tr>
    <td><?php echo link_to($detail->getInvoice(),"invoice/view?id=".$detail->getInvoiceId()) ?></td>
    <td><?php echo $detail->getInvoice()->getDate() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td align=right><?php echo $detail->getQty() ?></td>
    <td align=right><?php echo $detail->getPrice() ?></td>
    <td align=right><?php echo $detail->getDiscrate() ?></td>
    <td align=right><?php echo $detail->getDiscamt() ?></td>
    <td align=right align=right><?php echo $detail->getTotal() ?></td>
    <td><?php echo $detail->getInvoice()->getCustomer() ?></td>
    <td><?php //$quote=$detail->getSimilarQuote();if($quote)echo link_to("View Quote","quote/edit?id=".$quote->getId()); ?></td>
  </tr>
  <?php }?>
</table>
<br>
<br>
<table border=1>
  <tr>
    <td>Product</td>
    <td>Vendor</td>
    <td>Date</td>
    <td>Description</td>
    <td>Qty</td>
    <td>Unit</td>
    <td>Discount</td>
    <td>Discount</td>
    <td>Total</td>
    <td>Vendor</td>
  </tr>
  <tr>
    <td></td>
    <td>Invoice</td>
    <td></td>
    <td></td>
    <td></td>
    <td>Price</td>
    <td>Rate</td>
    <td>Amount</td>
    <td></td>
    <td></td>
  </tr>
  <?php foreach($product->getPurchasedetail() as $detail){?>
  <tr>
    <td><?php echo link_to($detail->getPurchase(),"purchase/view?id=".$detail->getPurchaseId()) ?></td>
    <td><?php echo $detail->getPurchase()->getVendorInvoice() ?></td>
    <td><?php echo $detail->getPurchase()->getDate() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td align=right><?php echo $detail->getQty() ?></td>
    <td align=right><?php echo $detail->getPrice() ?></td>
    <td align=right><?php echo $detail->getDiscrate() ?></td>
    <td align=right><?php echo $detail->getDiscamt() ?></td>
    <td align=right><?php echo $detail->getTotal() ?></td>
    <td><?php echo $detail->getPurchase()->getVendor() ?></td>
    <td><?php //$quote=$detail->getSimilarQuote();echo link_to("View Quote","quote/edit?id=".$quote->getId()); ?></td>
  </tr>
  <?php }?>
</table>


