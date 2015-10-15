<?php use_helper('I18N', 'Date') ?>
<h1>Inventory: <?php echo '"'.link_to($stock->getProduct(),"product/view?id=".$stock->getProductId()).'"'." in ".$stock->getWarehouse()?></h1>

<?php $stockentries=$stock->getStockEntriesDesc()?>

<table>
  <tr>
    <td>Current Quantity: </td>
    <td><?php echo $stock->getCurrentqty()." as of ".MyDateTime::frommysql($stock->getDate())->toshortdate()?></td>
  </tr>
  <tr>
    <td><?php echo link_to("View all warehouses","product/inventory?id=".$stock->getProductId()) ?></td>
  </tr>
  <!--tr>
    <td><?php //echo link_to("Calculate","stock/calc?id=".$stock->getId()) ?></td>
  </tr-->
</table>

<br>
<?php //echo link_to("Add Detail","stockentry/new?stock_id=".$stock->getId()) ?>
<?php $form=new StockentryForm(); ?>
<?php echo form_tag_for($form,"@stockentry"); ?>
<input type=hidden name=stockentry[stock_id] value=<?php echo $stock->getId()?>  >
    <?php echo $form->renderHiddenFields(false) ?>
<table>
	<tr>
		<td>Date</td>
		<td>Qty</td>
		<td>Type</td>
		<td>Description</td>
	</tr>
	<tr>
		<td><?php echo $form["date"]; ?></td>
		<td><input name="stockentry[qty]" id="stockentry_qty" type="text" value=1></td>
		<td><?php echo $form["type"]; ?></td>
		<td><?php echo $form["description"]; ?></td>
		<td><input type=submit name=submit value=Save  ></td>
	</tr>
</table>
</form>

<br>
<table border=1>
  <tr>
    <td>Date</td>
    <td>Stock In</td>
    <td>Stock Out</td>
    <td>Balance</td>
    <td>Ref</td>
    <td>Type</td>
    <td>Description</td>
  </tr>
  <?php foreach($stockentries as $detail){?>
  <tr>
    <td><?php echo MyDateTime::frommysql($detail->getDate())->toshortdate() ?></td>
    <td align=right><?php if($detail->getQty()>0)echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getQty()<0)echo MyDecimal::format($detail->getQty()*-1) ?></td>
    <td align=right><?php echo $detail->getBalance() ?></td>
    <td><?php 
      
      if($detail->getRefClass()=="Invoicedetail"){$ref=$detail->getRef();echo link_to($ref->getInvoice(),"invoice/view?id=".$ref->getInvoiceId());}
      else if($detail->getRefClass()=="Purchasedetail"){$ref=$detail->getRef();echo link_to($ref->getPurchase(),"purchase/view?id=".$ref->getPurchaseId());}
      else if($detail->getRefClass())echo link_to($detail->getRef(),strtolower($detail->getRefClass())."/view?id=".$detail->getRefId());
      ?></td>
    <td><?php echo $detail->getType() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td><?php if($detail->getType())echo link_to('Delete','stockentry/delete?id='.$detail->getId(),array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
  </tr>
  <?php }?>
</table>


