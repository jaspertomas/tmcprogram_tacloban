<?php use_helper('I18N', 'Date') ?>

<h1>Product Invoice Search</h1>

<?php 
	echo link_to("Purchase Search","product/purchasesearch?searchstring=".$searchstring."&product_id=".$product_id);
	echo "<br>".link_to("Stock Search","product/stocksearch?searchstring=".$searchstring."&product_id=".$product_id);
  echo form_tag("product/invoicesearch"); 
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
        <td>Invoice</td>
        <td>Date</td>
        <td>Description</td>
        <td>Qty</td>
        <td>Unit</td>
        <td>Discount</td>
        <td>Discount</td>
        <td>Total</td>
        <td>Customer</td>
        <td>Price List</td>
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
        <td></td>
      </tr>

<?php 
  foreach($products as $index=>$product)
  {
  ?>
      <?php foreach($product->getInvoicedetail() as $detail){?>
      <tr>
        <td><?php echo link_to($product,"product/view?id=".$product->getId()) ?></td>
        <td><?php echo link_to($detail->getInvoice(),"invoice/view?id=".$detail->getInvoiceId()) ?></td>
        <td><?php echo $detail->getInvoice()->getDate() ?></td>
        <td><?php echo $detail->getDescription() ?></td>
        <td><?php echo $detail->getQty() ?></td>
        <td><b><?php echo $detail->getPrice() ?></b></td>
        <td><?php echo $detail->getDiscrate() ?></td>
        <td><?php echo $detail->getDiscamt() ?></td>
        <td><?php echo $detail->getTotal() ?></td>
        <td><?php echo $detail->getInvoice()->getCustomer() ?></td>
        <td><?php echo link_to("Price List","producttype/view?id=".$product->getProducttypeId()) ?></td>
      </tr>
      <?php }?>
  <?php  } ?>
    </table>


