<?php use_helper('I18N', 'Date') ?>

<h1>Product Stock Search</h1>

<?php 
	echo link_to("Invoice Search","product/invoicesearch?searchstring=".$searchstring."&product_id=".$product_id);
	echo "<br>".link_to("Purchase Search","product/purchasesearch?searchstring=".$searchstring."&product_id=".$product_id);
  echo form_tag("product/purchasesearch"); 
  $invoicedetail=new Invoicedetail();
  $invoicedetail->setProductId($product_id);
  $form=new InvoicedetailForm($invoicedetail);
  echo $form["product_id"]; 
  ?>
<br>Search: <input name=searchstring value=<?php echo $searchstring?>>
<br><input type=submit name=submit value=Submit>
</form>



		<table border=1>
			<tr>
				<td>Product</td>
				<td>Warehouse</td>
				<td>Qty</td>
				<td>View</td>
        <td>Price List</td>
			</tr>
<?php 
  foreach($products as $index=>$product)
  {
  ?>
      <?php foreach($product->getStock() as $stock)if($stock->getCurrentQty()!=0){?>
      <tr>
        <td><?php echo link_to($product,"product/view?id=".$product->getId()) ?></td>
				<td><?php echo $stock->getWarehouse()->getName() ?></td>
				<td><?php echo $stock->getCurrentQty() ?></td>
				<td><?php echo link_to("View","stock/view?id=".$stock->getId()) ?></td>
        <td><?php echo link_to("Price List","producttype/view?id=".$product->getProducttypeId()) ?></td>
      </tr>
      <?php }?>
  <?php  } ?>
    </table>

