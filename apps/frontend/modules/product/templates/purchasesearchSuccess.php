<?php use_helper('I18N', 'Date') ?>

<h1>Product PO Search</h1>

<?php 
	echo link_to("Invoice Search","product/invoicesearch?searchstring=".$searchstring."&product_id=".$product_id);
	echo "<br>".link_to("Stock Search","product/stocksearch?searchstring=".$searchstring."&product_id=".$product_id);
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
        <td>Purchase</td>
        <td>Vendor</td>
        <td>Date</td>
        <td>Description</td>
        <td>Qty</td>
        <td>Unit</td>
        <td>Discount</td>
        <td>Discount</td>
        <td>Total</td>
        <td>Vendor</td>
        <td>Price List</td>
      </tr>
      <tr>
        <td></td>
        <td>Order</td>
        <td>Invoice</td>
        <td></td>
        <td></td>
        <td></td>
        <td>Price</td>
        <td>Rate</td>
        <td>Amount</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
<?php 
  foreach($products as $index=>$product)
  {
  ?>
      <?php foreach($product->getPurchasedetail() as $detail){?>
      <tr>
        <td><?php echo link_to($product,"product/view?id=".$product->getId()) ?></td>
        <td><?php echo link_to($detail->getPurchase(),"purchase/view?id=".$detail->getPurchaseId()) ?></td>
        <td><?php echo $detail->getPurchase()->getVendorInvoice() ?></td>
        <td><?php echo MyDateTime::frommysql($detail->getPurchase()->getDate())->toshortdate() ?></td>
        <td><?php echo $detail->getDescription() ?></td>
        <td align=right><?php echo $detail->getQty() ?></td>
        <td align=right><b><?php echo $detail->getPrice() ?></b></td>
        <td align=right><?php echo $detail->getDiscrate() ?></td>
        <td align=right><?php echo $detail->getDiscamt() ?></td>
        <td align=right><?php echo $detail->getTotal() ?></td>
        <td><?php echo $detail->getPurchase()->getVendor() ?></td>
        <td><?php echo link_to("Price List","producttype/view?id=".$product->getProducttypeId()) ?></td>
      </tr>
      <?php }?>
  <?php  } ?>
    </table>


