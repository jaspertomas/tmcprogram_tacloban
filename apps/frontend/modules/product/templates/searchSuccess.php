<?php use_helper('I18N', 'Date') ?>

<h1>Product Price List</h1>

<?php 
  echo form_tag("product/search"); 
  $invoicedetail=new Invoicedetail();
  $invoicedetail->setProductId($product_id);
  $form=new InvoicedetailForm($invoicedetail);
  echo $form["product_id"]; 
  echo $product_id;
  ?>
<br>Search: <input name=searchstring value=<?php echo $searchstring?>>
<br><input type=submit name=submit value=Submit>
</form>




<?php 
  foreach($products as $index=>$product)
  {
  ?>
    <h1><?php echo link_to($product->getName(),"product/edit?id=".$product->getId()) ?></h1>
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
        <td>Vendor</td>
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
        <td><?php //echo link_to($detail->getInvoice(),"invoice/view?id=".$detail->getInvoiceId()) ?></td>
        <td><?php echo $detail->getInvoice()->getDate() ?></td>
        <td><?php echo $detail->getDescription() ?></td>
        <td><?php echo $detail->getQty() ?></td>
        <td><b><?php echo $detail->getPrice() ?></b></td>
        <td><?php echo $detail->getDiscrate() ?></td>
        <td><?php echo $detail->getDiscamt() ?></td>
        <td><?php echo $detail->getTotal() ?></td>
        <td><?php //echo $detail->getInvoice()->getCustomer() ?></td>
      </tr>
      <?php }?>
    </table>
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
        <td><?php echo $detail->getQty() ?></td>
        <td><b><?php echo $detail->getPrice() ?></b></td>
        <td><?php echo $detail->getDiscrate() ?></td>
        <td><?php echo $detail->getDiscamt() ?></td>
        <td><?php echo $detail->getTotal() ?></td>
        <td><?php echo $detail->getPurchase()->getVendor() ?></td>
      </tr>
      <?php }?>
    </table>
  <?php  } ?>


