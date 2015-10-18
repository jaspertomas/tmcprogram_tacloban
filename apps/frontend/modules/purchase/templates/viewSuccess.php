<?php use_helper('I18N', 'Date') ?>
<h1>Purchase Edit</h1>
<?php slot('transaction_id', $purchase->getId()) ?>
<?php slot('transaction_type', "Purchase") ?>

<table>
  <tr valign=top>
    <td>
			<table>
				<tr>
					<td>Date</td>
					<td><?php echo $purchase->getDate() ?></td>
				</tr>
				<tr>
					<td>PO Template</td>
					<td><?php echo $purchase->getPurchaseTemplate() ?></td>
				</tr>
				<tr>
					<td>PO / Cash Voucher No.</td>
					<td><?php echo $purchase->getPono() ?></td>
				</tr>
				<tr>
					<td>Vendor</td>
					<td><?php echo $purchase->getVendor() ?></td>
				</tr>
				<tr>
					<td>Vendor Purchase No.</td>
					<td><?php echo $purchase->getVendorInvoice() ?></td>
				</tr>
        <tr>
          <td>Total</td>
          <td><?php echo $purchase->getCash()."+".$purchase->getCheque()."+".$purchase->getCredit()."=".$purchase->getTotal() ?></td>
        </tr>
				<tr>
					<td><?php echo link_to("Edit","purchase/edit?id=".$purchase->getId()) ?>
					<?php echo link_to("Create Barcodes","purchase/barcode?id=".$purchase->getId()) ?></td>
				</tr>
			</table>

    </td>
    <td>
			<table>

				<tr>
					<td>Date Received</td>
					<td><?php echo $purchase->getDatereceived() ?></td>
				</tr>
				<tr>
					<td>Terms</td>
					<td><?php echo $purchase->getTerms() ?></td>
				</tr>
				<tr>
					<td>Sales Representative</td>
					<td><?php echo $purchase->getEmployee() ?></td>
				</tr>
				<tr>
					<td>Discount Rate</td>
					<td><?php echo $purchase->getDiscrate() ?></td>
				</tr>
				<tr>
					<td>Discount Amount</td>
					<td><?php echo $purchase->getDiscamt() ?></td>
				</tr>
				<tr>
					<td>Notes</td>
					<td><?php echo $purchase->getMemo() ?></td>
				</tr>
			</table>
    </td>
    <td>
			<table>
				<tr>
					<td>Status</td>
					<td><?php echo $purchase->getStatus() ?></td>
				</tr>
				<!--tr>
					<td>Cheque No</td>
					<td><?php //echo $purchase->getChequeno() ?></td>
				</tr>
				<tr>
					<td>Cheque Date</td>
					<td><?php //echo $purchase->getChequedate() ?></td>
				</tr>
				<tr>
					<td>Cheque Amount</td>
					<td><?php //echo $purchase->getCheque() ?></td>
				</tr-->
				<tr>
					<td>Cheque Data</td>
        <?php $cheques=explode(", ",$purchase->getChequedata());foreach($cheques as $cheque)  {?>
					<td><?php echo $cheque?></td>				
			  </tr>
				<tr>
					<td></td>				
			  <?php } ?>
				</tr>

<?php if(!$purchase->getIsInspected()){?>
  <tr><td><font color=red>Not Inspected</font></td><td><?php echo link_to("Set as Inspected","purchase/inspect?id=".$purchase->getId()) ?></td></tr>    
<?php } else { ?>
  <tr><td><font color=green>Inspected</font></td><td><?php echo link_to("Set as Not Inspected","purchase/uninspect?id=".$purchase->getId()) ?></td></tr>    
<?php } ?>



			</table>

    </td>
  </tr>
</table>
          <td><?php echo link_to("Cheque Payment","event/new?parent_class=Purchase&parent_id=".$purchase->getId()."&type=ChequePay") ?></td>
          <td><?php echo link_to("Cash Payment","event/new?parent_class=Purchase&parent_id=".$purchase->getId()."&type=CashPay") ?></td>
          <td><?php echo link_to("Bank Expense","event/new?parent_class=Purchase&parent_id=".$purchase->getId()."&type=BankExp") ?></td>
          <td><?php echo link_to("Cancel","purchase/cancel?id=".$purchase->getId()) ?></td>
          <td><?php if($purchase->getType()!="Cash")echo link_to("Cash payment","purchase/adjusttype?id=".$purchase->getId()."&type=Cash") ?></td>
          <td><?php if($purchase->getType()!="Cheque")echo link_to("Cheque payment","purchase/adjusttype?id=".$purchase->getId()."&type=Cheque") ?></td>
          <td><?php if($purchase->getType()!="Account")echo link_to("Account payment","purchase/adjusttype?id=".$purchase->getId()."&type=Account") ?></td>
<br>          <td><?php echo link_to("View Details","purchase/view?id=".$purchase->getId()) ?></td>
          <td><?php echo link_to("View Events","purchase/events?id=".$purchase->getId()) ?></td>
          <td><?php echo link_to("View Accounting","purchase/accounting?id=".$purchase->getId()) ?></td>


<?php //echo link_to("Add Detail","purchasedetail/new?purchase_id=".$purchase->getId()) ?>
<?php echo form_tag_for($detailform,"@purchasedetail"); ?>
<input type=hidden name=purchasedetail[purchase_id] value=<?php echo $purchase->getId()?>  >
<input type=hidden name=purchase[pono] value=<?php echo $purchase->getPono()?>  >
    <?php echo $detailform->renderHiddenFields(false) ?>
<table>
	<tr>
		<td>Product</td>
		<td>Description</td>
		<td>Price</td>
		<td>Qty</td>
		<td>Discrate</td>
		<td>Discamt</td>
	</tr>
	<tr>
		<td><?php echo $detailform["product_id"]; ?></td>
		<td><?php echo $detailform["description"]; ?></td>
		<td><?php echo $detailform["price"]; ?></td>
		<td><?php echo $detailform["qty"]; ?></td>
		<td><?php echo $detailform["discrate"]; ?></td>
		<td><?php echo $detailform["discamt"]; ?></td>
	</tr>
</table>

Selling Price: 
<?php echo $detailform["sellprice"]; ?>
<input type=submit name=submit value=Save  >

</form>
<table border=1>
  <tr>
    <td>Barcode</td>
    <td>Product</td>
    <td>Sell Price</td>
    <td>Description</td>
    <td>Qty</td>
    <td>Unit</td>
    <td>Discount</td>
    <td>Total</td>
    <td>Price</td>
    <td></td>
    <td></td>
    <td></td>
    <td>Max buy</td>
    <td>Min buy</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Price</td>
    <td></td>
    <td></td>
    <td>List</td>
    <td></td>
    <td></td>
    <td></td>
    <td>price</td>
    <td>price</td>
  </tr>
  <?php foreach($purchase->getPurchasedetail() as $detail){?>
  <tr>
    <td><?php echo $detail->getBarcode() ?></td>
    <td><?php echo link_to($detail->getProduct(),"product/view?id=".$detail->getProductId()) ?></td>
    <td><?php echo $detail->getSellprice() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td><?php echo $detail->getQty() ?></td>
    <td><?php echo $detail->getPrice() ?></td>
    <td><?php 
            if($detail->getDiscrate())foreach(explode(" ",$detail->getDiscrate()) as $discamt) echo $discamt."%";
            if($detail->getDiscamt() and $detail->getDiscrate())echo "+";
            if($detail->getDiscamt())echo "P".$detail->getDiscamt() ?></td>
    <td><?php echo $detail->getTotal() ?></td>
    <td><?php echo link_to("Price List","producttype/view?id=".$detail->getProduct()->getProducttypeId()) ?></td>
    <td><?php echo link_to("Edit","purchasedetail/edit?id=".$detail->getId()) ?></td>
    <td>
<?php echo link_to(
  'Delete',
  'purchasedetail/delete?id='.$detail->getId(),
  array('method' => 'delete', 'confirm' => 'Are you sure?')
) ?>

    </td>
    <td><?php echo link_to("Edit Product","product/edit?id=".$detail->getProductId()) ?></td>
    <td><?php echo $detail->getProduct()->getMaxbuyprice() ?></td>
    <td><?php echo $detail->getProduct()->getMinbuyprice() ?></td>
  </tr>
  <?php }?>
</table>

<?php //echo link_to("Generate Invoice","purchase/generateInvoice?id=".$purchase->getId()) ?>
