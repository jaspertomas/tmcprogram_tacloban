<?php use_helper('I18N', 'Date') ?>
<?php if ($sf_user->hasFlash('msg')): ?>
  <div class="flash_msg"><font color=green><?php echo $sf_user->getFlash('msg') ?></font></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><font color=red><?php echo $sf_user->getFlash('error') ?></font></div>
<?php endif ?>
<h1>
	Invoice (<?php echo $invoice->getIsTemporaryString()?>) 
	<?php 
		if($invoice->getIsTemporary()==2 && $sf_user->hasCredential(array('admin', 'encoder', 'sales'),false))
			echo link_to("Check Out","invoice/checkout?id=".$invoice->getId()); 
		else if($invoice->getIsTemporary()==1 && $sf_user->hasCredential(array('admin', 'encoder', 'cashier'),false))
			echo link_to("Undo Check Out","invoice/undocheckout?id=".$invoice->getId()); ?>
</h1>
<?php slot('transaction_id', $invoice->getId()) ?>
<?php slot('transaction_type', "Invoice") ?>

<table>
  <tr valign=top>
    <td>
      <table>
        <tr>
          <td>Inv no.</td>
          <td>
            <?php if($invoice->getIsTemporary()==1){
            		echo form_tag_for($form,'invoice/finalize'); 
            		echo $form['invno'];
            		echo $form['id'];
            		if($sf_user->hasCredential(array('admin', 'encoder', 'cashier'), false)){?>
		            <input type="submit" value="Finalize">
	            <?php } ?>
	            </form>
            <?php }else{echo $invoice->getInvoiceTemplate()." ".$invoice->getInvno();} ?>
          </td>
        </tr>
        <tr>
          <td>Date</td>
          <td><?php echo $invoice->getDate() ?></td>
        </tr>
        <!--tr>
          <td>PO No.</td>
          <td><?php //echo $invoice->getPonumber() ?></td>
        </tr-->
        <tr>
          <td>Customer</td>
          <td><?php echo link_to($invoice->getCustomer(),"customer/view?id=".$invoice->getCustomerId(),array("target"=>"edit_customer"))." (".$invoice->getCustomer()->getTinNo().")"; ?></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td>Sale Type</td>
          <?php if($sf_user->hasCredential(array('admin', 'sales', 'encoder'), false)){?>
          <td><?php echo form_tag_for($form,'invoice/setsaletype')?> <?php echo $form['saletype'] ?><?php echo $form['id'] ?><input type="submit" value="Save"></form></td>
          <?php }else{?>	
          <td><?php echo $invoice->getSaleType() ?></td>
          <?php }?>	
        </tr>
        <!--tr>
          <td>Due date</td>
          <td><?php //echo $invoice->getDuedate() ?></td>
        </tr-->
        <tr>
          <td>Sales Representative</td>
          <td><?php echo $invoice->getEmployee() ?></td>
        </tr>
        <!--tr>
          <td>Discount Rate</td>
          <td><?php //echo $invoice->getDiscrate() ?></td>
        </tr>
        <tr>
          <td>Discount Amount</td>
          <td><?php //echo $invoice->getDiscamt() ?></td>
        </tr-->
        <tr>
          <td>Total</td>
          <td><?php echo $invoice->getTotal() ?></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td>Cash</td>
          <td><?php echo $invoice->getCash() ?></td>
        </tr>
        <tr>
          <td>Cheque</td>
          <td><?php echo $invoice->getCheque() ?></td>
        </tr>
        <tr>
          <td>Balance</td>
          <td><?php echo $invoice->getCredit() ?></td>
        </tr>
      </table>
    </td>
    <td>
			<table>
		<tr>
		<td>Status</td>
		<td><?php 
/*
  if status=paid,
    if checkcleardate > today, 
      status = pending. 
    else 
      status = paid
*/
if($invoice->getStatus()=="Paid"){
$today=MyDateTime::today();
$checkcleardate=MyDateTime::frommysql($invoice->getCheckcleardate());
$status="Paid";
if($checkcleardate->islaterthan($today))$status="Check to clear on ".$checkcleardate->toshortdate();
echo $status;

}
else echo $invoice->getStatus();

?></td>
		</tr>
        <tr>
          <td>Notes</td>
          <td><?php echo $invoice->getNotes() ?></td>
        </tr>
				<!--tr>
					<td>Cheque Data</td>
        <?php //$cheques=explode(", ",$invoice->getChequedata());foreach($cheques as $cheque)  {?>
					<td><?php //echo $cheque?></td>				
			  </tr>
				<tr>
					<td></td>				
			  <?php //} ?>
				</tr-->
        <tr>
          <td><?php echo link_to("Edit","invoice/edit?id=".$invoice->getId(),array("id"=>"invoice_edit")) ?></td>
        </tr>
		</table>
    </td>
  </tr>
  <tr hidden=true id=invoice_edit_password_tr class=password_tr >
    <td align=center colspan=10>Enter manager password:<input id=invoice_edit_password_input type=password><input type=button value="Submit Password" id=invoice_edit_password_button></td>
  </tr> 
</table>

<?php
//if user is salesman or encoder
if($sf_user->hasCredential(array('admin', 'sales', 'encoder'), false)){
?>
<?php //echo link_to("Add Detail","invoicedetail/new?invoice_id=".$invoice->getId()) ?>
<?php echo form_tag_for($detailform,"@invoicedetail"); ?>
<input type=hidden name=invoicedetail[invoice_id] value=<?php echo $invoice->getId()?>  >
    <?php echo $detailform->renderHiddenFields(false) ?>
<table>
	<tr>
		<td>Qty</td>
		<td>Product</td>
		<td>Discounted</td>
		<td>Price</td>
		<!--td>Discrate</td-->
		<td>Notes</td>
	</tr>
	<tr>
		<td><?php echo $detailform["qty"]; ?></td>
		<td>
			<?php echo $detailform["product_id"]; ?>
			<input id=invoiceproductsearchinput autocomplete="off">
		</td>
		<td align=right><input type=checkbox id=chk_is_discounted></td>
		<td><?php echo $detailform["price"]; ?></td>
		<!--td><?php //echo $detailform["discrate"]; ?></td-->
		<td><?php echo $detailform["description"]; ?></td>
		<td><input type=submit name=submit id=invoice_detail_submit value=Save  ></td>
	</tr>
  <tr hidden=true class=password_tr id=invoice_discount_password_tr>
    <td align=center colspan=10>Enter manager password:<input id=invoice_discount_password_input type=password><input type=button value="Submit Password" id=invoice_discount_password_button></td>
  </tr> 
	<!--tr>
	  <td>Barcode: <?php //echo $detailform["barcode"]; ?></td>
	</tr-->
	<div id="product_price" style="display: none;"><?php echo $detailform->getObject()->getProduct()->getMaxsellprice();?></div>
	<div id="product_name" style="display: none;"><?php echo $detailform->getObject()->getProduct()->getName();?></div>
</table>

<?php  } ?>

<div id="invoicesearchresult"></div>
<?php 
  //if(count($products))foreach($products as $product)
    //echo '<a onclick="changeText('.$product->getId().')" >'.$product->getName().'</a>';
?>
</form>

<hr>

<table>
  <tr>
    <td colspan=2><font size=5 face=arial><b>TRADEWIND VISAYAS CORP.</b></font></td>
  </tr>
  <tr>
    <td>CASH INVOICE</td>
    <td align=right>Date: <u><?php echo $invoice->getDate()?></u></td>
  </tr>
  <tr>
    <td colspan=2>Sold to: <u><?php echo $invoice->getCustomer()?></u></td>
  </tr>
  <tr>
    <td colspan=2>TIN/SC-TIN: <u><?php echo $invoice->getCustomer()->getPhone1()?></u></td>
  </tr>
</table>



<?php $totalsale=0 ?>
<table border=1>
  <tr>
    <!--td>Barcode</td-->
    <td>Qty</td>
    <td>Unit</td>
    <td width=50%>Description</td>
    <td>Unit Price</td>
    <td>Amount</td>
<?php if($sf_user->hasCredential(array('admin', 'encoder', 'sales'), false)){?>
    <td></td>
    <td></td>
    <td>Discount</td>
    <td>Notes</td>
<?php } ?>
  </tr>
  <?php 
  	$counter=0;
  	foreach($invoice->getInvoicedetails() as $detail){
  		$counter++;?>
  <tr>
    <!--td><?php echo $detail->getBarcode() ?></td-->
    <td><?php echo $detail->getQty() ?></td>
    <td></td>
    <td><?php echo link_to($detail->getProduct(),"product/view?id=".$detail->getProductId()) ?></td>
    <td align=right><?php echo $detail->getPrice() ?></td>
    <td align=right><?php echo $detail->getTotal(); $totalsale+=$detail->getTotal(); ?></td>
    <!--td><?php //echo link_to("Price List","producttype/view?id=".$detail->getProduct()->getProducttypeId()) ?></td-->
<?php if($sf_user->hasCredential(array('admin', 'encoder', 'sales'), false)){?>
    <td><?php echo link_to("Edit","invoicedetail/edit?id=".$detail->getId(),array("class"=>"invoice_detail_edit","detail_id"=>$detail->getId())) ?></td>
    <td>
<?php echo link_to(
  'Delete',
  'invoicedetail/delete?id='.$detail->getId(),
  array('method' => 'delete', 'confirm' => 'Are you sure?')
) ?>

    </td>
    <!--td><?php //echo link_to("Edit Product","product/edit?id=".$detail->getProductId()) ?></td-->
    <td><?php echo $detail->getDiscamt() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
  </tr>
  <tr hidden=true class="password_tr invoice_detail_edit_password_tr" id=invoice_detail_edit_password_tr_<?php echo $detail->getId()?>>
    <td align=center colspan=10>Enter manager password:<input class=invoice_detail_edit_password_input id=invoice_detail_edit_password_input_<?php echo $detail->getId()?> type=password><input type=button value="Submit Password" class=invoice_detail_edit_password_button id=invoice_detail_edit_password_button_<?php echo $detail->getId()?>></td>
  </tr> 
  <?php }?>
  <?php }?>
  <?php
  while($counter<10){$counter++;echo "<tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>";}
  ?>
  <tr align=right>
	  <td></td>
	  <td></td>
	  <td>Total Sales (net of VAT)</td>
	  <td></td>
	  <td><?php $vat=$totalsale/1.12;echo number_format($vat,2,".",",")?></td>
  </tr>
  <tr align=right>
	  <td></td>
	  <td></td>
	  <td>Add 12% VAT</td>
	  <td></td>
	  <td><?php echo number_format($totalsale-$vat,2,".",",")?></td>
  </tr>
  <tr align=right>
	  <td></td>
	  <td></td>
	  <td>Amount Received</td>
	  <td></td>
	  <td><?php echo number_format($totalsale,2,".",",")?></td>
  </tr>
</table>
<hr>
<table>
	<tr>
          <td><?php echo link_to("View Payments","invoice/events?id=".$invoice->getId()) ?></td>
      <td><?php echo link_to("Cash Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=CashCollect") ?></td>
      <td><?php echo link_to("Cheque Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=ChequeCollect") ?></td>
      <td><?php //echo link_to("Bank Expense","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=BankExp") ?></td>
	</tr>
	<tr>
	      <td><?php if($invoice->getStatus()!="Cancelled")echo link_to("Cancel","invoice/cancel?id=".$invoice->getId(),array("id"=>"invoice_cancel")) ?></td>
	</tr>
  <tr hidden=true class=password_tr id=invoice_cancel_password_tr>
    <td align=center colspan=10>Enter manager password:<input id=invoice_cancel_password_input type=password><input type=button value="Submit Password" id=invoice_cancel_password_button></td>
  </tr> 
</table>


<script type="text/javascript">
function changeText(id)
{
var x=document.getElementById("mySelect");
x.value=id;
}
var manager_password="<?php 
	    $setting=Doctrine_Query::create()
	        ->from('Settings s')
	      	->where('name="manager_password"')
	      	->fetchOne();
      	if($setting!=null)echo $setting->getValue();
?>";
//set price textbox to read only
$("#invoicedetail_price").prop('readonly', true);
//set product name
$("#invoiceproductsearchinput").prop('value', $("#product_name").html());
//set price to default price
$("#invoicedetail_price").prop('value', $("#product_price").html());
//select invno
$("#invoice_invno").focus();
$("#invoice_invno").select(); 
//if no product id set, disable save button
if($("#invoicedetail_product_id").val()=='')	 		  
  $("#invoice_detail_submit").prop("disabled",true);
//------Invoice Discount-------------------
//on page ready, discounted is false
var discounted=false;
$("#chk_is_discounted").prop('checked',false);
//on checkbox click, set price textbox to readonly or editable
$("#chk_is_discounted").click(function(event){
    event.preventDefault();
	//if not checked, set textbox to readonly 
    //if($("#chk_is_discounted").prop('checked')!=true)
    if(discounted)
    {
	    	//set discounted to false
	    discounted=false;
	    $("#chk_is_discounted").prop('checked')=false;
    		//set price textbox to readonly
		$("#invoicedetail_price").prop('readonly', true);
		//set price to default price
		$("#invoicedetail_price").prop('value', $("#product_price").html());
	    //hide all password entry boxes
	    $(".password_tr").attr('hidden',true);
    }
    //else not discounted
    else
    {
    		//check if manager password is set
		//if not manager password set in database
		if(manager_password=="")
		{
        		//uncheck checkbox
	    		$("#chk_is_discounted").prop('checked',null);
			//show message 
			alert("MANAGER PASSWORD NOT SET");
			//and do nothing 
			return;
		}
		
	    //hide all password entry boxes
	    $(".password_tr").attr('hidden',true);
	    //unhide this password entry box
	    $("#invoice_discount_password_tr").attr('hidden',false);
	    
    }
});
$('#invoice_discount_password_button').click(function(event) {
		//get entered password value
	    var pass=$("#invoice_discount_password_input").val();
	    //if password is correct
	    if (pass==manager_password){

		    //hide all password entry boxes
		    $(".password_tr").attr('hidden',true);

			//set price textbox to editable
			$("#invoicedetail_price").prop('readonly', false);

		    discounted=true;
		    $("#chk_is_discounted").prop('checked',true);
        }
        //if cancel or wrong answer
        else
        {
	        	alert("WRONG PASSWORD");
        		//uncheck checkbox
	    		$("#chk_is_discounted").prop('checked',null);
	    		//set textbox to readonly
			$("#invoicedetail_price").prop('readonly', true);
			//set price to default price
			$("#invoicedetail_price").prop('value', $("#product_price").html());
        }
});
//------Invoice (not header) product search-----------
//$("#invoiceproductsearchinput").keyup(function(){
$("#invoiceproductsearchinput").on('input propertychange paste', function() {
    //product has been edited. disable save button
    $("#invoice_detail_submit").prop("disabled",true);
	//if 3 or more letters in search box
    if($("#invoiceproductsearchinput").val().length>=3)
	    $.ajax({url: "<?php echo "http://".$_SERVER['SERVER_NAME'].str_replace("index.php","",$_SERVER['SCRIPT_NAME'])?>productsearch/index?searchstring="+$("#invoiceproductsearchinput").val()+"&transaction_id=<?php include_slot('transaction_id') ?>&transaction_type=<?php include_slot('transaction_type') ?>", success: function(result){
	 		  $("#invoicesearchresult").html(result);
	    }});
    //else clear
    else
 		  $("#invoicesearchresult").html("");
});
//------Invoice Edit-------------------
$('#invoice_edit').click(function(event) {
    event.preventDefault();
    //hide all password entry boxes
    $(".password_tr").attr('hidden',true);
    //unhide this password entry box
    $("#invoice_edit_password_tr").attr('hidden',false);
});
$('#invoice_edit_password_button').click(function(event) {
	//get entered password value
    var pass=$("#invoice_edit_password_input").val();
    if (pass==manager_password){
	    window.location = $('#invoice_edit').attr('href');
    }
    else
    {
        	alert("WRONG PASSWORD");
    }
});
//----Invoice Cancel-------------------------------
$('#invoice_cancel').click(function(event) {
    event.preventDefault();
    //hide all password entry boxes
    $(".password_tr").attr('hidden',true);
    //unhide this password entry box
    $("#invoice_cancel_password_tr").attr('hidden',false);
});
$('#invoice_cancel_password_button').click(function(event) {
	//get entered password value
    var pass=$("#invoice_cancel_password_input").val();
    if (pass==manager_password){
	    window.location = $('#invoice_cancel').attr('href');
    }
    else
    {
        	alert("WRONG PASSWORD");
    }
});
//--------Invoice Detail Edit---------------------------
var invoice_detail_edit_href="";
var detail_id="";
$('.invoice_detail_edit').click(function(event) {
	//prevent form from sending
    event.preventDefault();
    //extract detail->getId() value
    detail_id=$(this).attr('detail_id');
    //save href value for later use
    invoice_detail_edit_href=$(this).attr('href');
    //hide all password entry boxes
    $(".password_tr").attr('hidden',true);
    //unhide password entry textbox
    $("#invoice_detail_edit_password_tr_"+detail_id).attr('hidden',false);
});
$('.invoice_detail_edit_password_button').click(function(event) {
	//get entered password value
    var pass=$("#invoice_detail_edit_password_input_"+detail_id).val();
    if (pass==manager_password){
	    window.location = invoice_detail_edit_href;
    }
    else
    {
        	alert("WRONG PASSWORD");
    }
});

//-----------------------------------

</script>
<!--
          <td><?php //echo link_to("Cheque Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=ChequeCollect") ?></td>
          <td><?php //echo link_to("Cash Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=CashCollect") ?></td>
          <td><?php //echo link_to("Bank Expense","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=BankExp") ?></td>
          <td><?php //echo link_to("Cancel","invoice/cancel?id=".$invoice->getId()) ?></td>
          <td><?php //if($invoice->getSaletype()!="Cash")echo link_to("Cash sale","invoice/adjustsaletype?id=".$invoice->getId()."&type=Cash") ?></td>
          <td><?php //if($invoice->getSaletype()!="Cheque")echo link_to("Cheque sale","invoice/adjustsaletype?id=".$invoice->getId()."&type=Cheque") ?></td>
          <td><?php //if($invoice->getSaletype()!="Credit")echo link_to("Account sale","invoice/adjustsaletype?id=".$invoice->getId()."&type=Account") ?></td>
<br>
          <td><?php //echo link_to("View Details","invoice/view?id=".$invoice->getId()) ?></td>
          <td><?php //echo link_to("View Events","invoice/events?id=".$invoice->getId()) ?></td>
          <td><?php //echo link_to("View Accounting","invoice/accounting?id=".$invoice->getId()) ?></td>
-->

<?php //echo link_to("Generate PO","invoice/generatePurchase?id=".$invoice->getId()) ?>
