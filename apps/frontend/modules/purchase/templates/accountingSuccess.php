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
					<td><?php echo $purchase->getTotal() ?></td>
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
					<td>Terms</td>
					<td><?php echo $purchase->getTerms() ?></td>
				</tr>
				<tr>
					<td>Due date</td>
					<td><?php echo $purchase->getDuedate() ?></td>
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
					<td><?php echo $purchase->getChequedata() ?></td>
				</tr>
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



<br>
<br><b>Account Entries:</b>
<table border=1>
  <tr>
    <td></td>
    <td>Type</td>
    <td>Description</td>
    <td>Merchandise Expense</td>
    <td>Cash</td>
    <td>Out Cheque</td>
    <td>Payables</td>
  </tr>
  <?php foreach($accountentries as $detail)if($detail->getQty()!=0){?>
  <tr>
    <td><?php echo $detail->getRef() ?></td>
    <!--td align=right><?php //echo $detail->getBalance() ?></td-->
    <td><?php echo $detail->getDescription() ?></td>
    <td><?php echo $detail->getType() ?></td>
    <?php $purchase->getAccountIds(); ?>
    <td align=right><?php if($detail->getAccountId()==$purchase->accountids['account_id_merchandiseexpense'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getAccountId()==$purchase->accountids['account_id_cash_on_hand'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getAccountId()==$purchase->accountids['account_id_outchecks'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getAccountId()==$purchase->accountids['account_id_payables'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td><?php //echo link_to("Edit","event/edit?id=".$detail->getId()) ?></td>
    <td><?php //echo link_to($detail->getDate(),"event/edit?id=".$detail->getId()) ?></td>
  </tr>
  <?php }?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$purchase->accountids['account_id_merchandiseexpense']])?></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$purchase->accountids['account_id_cash_on_hand']])?></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$purchase->accountids['account_id_outchecks']])?></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$purchase->accountids['account_id_payables']])?></td>
    <td></td>
  </tr>
</table>

