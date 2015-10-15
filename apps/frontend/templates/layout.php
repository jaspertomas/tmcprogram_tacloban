<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
  	<?php use_javascript('jquery-1.10.2.js') ?>
    <?php include_javascripts() ?>
  </head>
  <body bgcolor="#EEEEEE">
              <?php if($sf_user->getGuardUser()){ ?>
            		<div style="float:right;">
            		<?php 
            		  echo "Welcome ".$sf_user->getGuardUser()->getUsername();
            		  if($sf_user->getGuardUser()->getIsSuperAdmin())
            		  {
                    echo 
                      " | ".
                      link_to("Users","@sf_guard_user").
                      " | ".
                      link_to("Mgr Passwd","employee/mgrpasswd");
            		  }
                  echo " | ".
                    link_to("Logout","@sf_guard_signout");
                    //" | ".
                    //link_to("Edit Profile",url_for("@user_edit?id=".$sf_user->getGuardUser()->getUser()->getId())); ?>
                </div>

              <?php }else{ ?>
            		<div style="float:right;">
              		<?php echo link_to("Please login","@sf_guard_signin"); ?>
                </div>
                <br>
          		<?php } ?>
    <p>
    <b>TMC Tacloban</b> |
    <?php echo link_to("Home",'home/index'); ?> | 
    
    <!--links for admin and encoder-->
    <?php if($sf_user->hasCredential(array('admin', 'encoder'), false)){?>
    <?php echo link_to("New Invoice",'invoice/new'); ?> | 
    <?php echo link_to("Temporary Invoices List (New)",'invoice/listnew'); ?> | 
    <?php echo link_to("Temporary Invoices List (Checked Out)",'invoice/listcheckedout'); ?> | 
    <?php echo link_to("New Customer",'customer/new'); ?> | 
    <?php echo link_to("New Vendor",'vendor/new'); ?> | 
    <?php //echo link_to("New Stock",'stock/new'); ?> | 
    <?php //echo link_to("New Stock Entry",'stockentry/new'); ?> | 
    <?php echo link_to("DSR",'invoice/dsr'); ?> | 
    <?php echo link_to("DPR",'purchase/dsr'); ?> | 
    <?php echo link_to("Product Type",'producttype/view?id=1'); ?> | 
    <?php echo link_to("Notes",'notes/view?id=1'); ?> | 
    <?php echo link_to("Unpaid Invoices",'invoice/listunpaid'); ?> | 
    
    <!--links for cashier-->
	<?php }else if($sf_user->hasCredential(array('cashier'), false)){?>
    <?php echo link_to("Temporary Invoices List (Checked Out)",'invoice/listcheckedout'); ?> | 
    <?php echo link_to("DSR",'invoice/dsr'); ?> | 
    <?php echo link_to("DPR",'purchase/dsr'); ?> | 
    <?php echo link_to("Unpaid Invoices",'invoice/listunpaid'); ?> | 
    
    <!--links for sales-->
	<?php }else if($sf_user->hasCredential(array('sales'), false)){?>
    <?php echo link_to("New Invoice",'invoice/new'); ?> | 
    <?php echo link_to("Temporary Invoices List (New)",'invoice/listnew'); ?> | 
	<?php } ?>    
    
    </p>
    <!--p>
    <?php //echo link_to("Home",'home/index'); ?> | 
    <?php //echo link_to("Invoice",'invoice',array('sort'=>'date','sort_type'=>'desc')); ?> | 
    <?php //echo link_to("Purchase Order",'purchase',array('sort'=>'date','sort_type'=>'desc')); ?> | 
    <?php //echo link_to("Product",'product'); ?> | 
    <?php //echo link_to("Customer",'customer'); ?> | 
    <?php //echo link_to("Vendor",'vendor'); ?> | 
    <?php //echo link_to("Brand",'brand'); ?> | 
    <?php //echo link_to("DSR",'invoice/dsr'); ?> | 
    <?php //echo link_to("DPR",'purchase/dsr'); ?> | 
    <?php //echo link_to("Warehouses",'warehouse'); ?> | 
    <?php //echo link_to("Notes",'notes/view?id=1'); ?> | 
    <?php //echo link_to("Stock",'stock'); ?> | 
    <?php //echo link_to("Stock Search",'product/stocksearch'); ?> 
    <?php //echo link_to("Invoice Search",'product/invoicesearch'); ?> 
    <?php //echo link_to("Purchase Search",'product/purchasesearch'); ?> 
    <?php //echo link_to("Quotes",'quote/index'); ?> | 
    <?php //echo link_to("Price List",'pricelist/index'); ?> | 
    <br><?php //echo link_to("Product Quickinput",'product/quickinput'); ?> | 
    <?php //echo link_to("Accounts",'account/index'); ?> | 
    <?php //echo link_to("Stats",'stats/index'); ?> | 
    <?php //echo link_to("Employee",'employee/index'); ?> | 
    <?php //echo link_to("Incoming Checks",'incheck/index'); ?> | 
    <?php //echo link_to("Outgoing Checks",'outcheck/index'); ?> | 
    <?php //echo link_to("Petty Cash",'pettycash/index'); ?> | 
    <?php //echo link_to("Commission",'invoice/commission'); ?> | 
    </p-->
		<table>
		<tr>
			<td>
				<!--?php //echo form_tag('productsearch/index') ?>
					<input id="searchstring" name="searchstring">
					<input type=hidden name="transaction_id" value=<?php include_slot('transaction_id') ?>
					<input type=hidden name="transaction_type" value=<?php include_slot('transaction_type') ?>
					<input value="Search Product" type="submit">
				</form-->
				<input id=productsearchinput autocomplete="off"> Search Product |
			</td>

			<td>
				<?php echo form_tag('invoice/search') ?>
					<input id="searchstring" name="searchstring"><input value="Search Invoice" type="submit">
				</form>
				<!--input id=invoicesearchinput autocomplete="off"> Search Invoice |-->
			</td>

			<td>
				<?php echo form_tag('purchase/search') ?>
					<input id="searchstring" name="searchstring"><input value="Search PO / Cash Voucher" type="submit">
				</form>
				<!--input id=purchasesearchinput autocomplete="off"> Search Purchase |-->
			</td>
			<!--td>
				<?php //echo form_tag('pettycash/search') ?>
					<input id="searchstring" name="searchstring"><input value="Search Petty Cash" type="submit">
				</form>
			</td-->
			<td>
				<!--?php //echo form_tag('customer/search') ?>
					<input id="searchstring" name="searchstring"><input value="Search Customer" type="submit">
				</form-->
				<input id=customersearchinput autocomplete="off"> Search Customer |
			</td>
			<td>
				<input type=button value="Clear" id=clearsearch>
			</td>
		</tr>
		</table>
		<div id="searchresult"></div>
  <hr>
</p>
    <?php echo $sf_content ?>
  </body>
<script>
$('#textbox').keypress(function(event){
	
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		alert('You pressed a "enter" key in textbox');	
	}

});
$("#productsearchinput").keyup(function(event){
	//if 3 or more letters in search box
    //if($("#productsearchinput").val().length>=3){

    //if enter key is pressed
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
	    $.ajax({url: "<?php echo "http://".$_SERVER['SERVER_NAME'].str_replace("index.php","",$_SERVER['SCRIPT_NAME'])?>productsearch/index?searchstring="+$("#productsearchinput").val()+"&transaction_id=<?php include_slot('transaction_id') ?>&transaction_type=<?php include_slot('transaction_type') ?>", success: function(result){
	 		  $("#searchresult").html(result);
	    }});
    }
    //else clear
    else
 		  $("#searchresult").html("");
});
$("#customersearchinput").keyup(function(event){
	//if 3 or more letters in search box
    //if($("#customersearchinput").val().length>=3){
    
    //if enter key is pressed
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
	    $.ajax({url: "<?php echo "http://".$_SERVER['SERVER_NAME'].str_replace("index.php","",$_SERVER['SCRIPT_NAME'])?>customer/search?searchstring="+$("#customersearchinput").val(), success: function(result){
	 		  $("#searchresult").html(result);
	    }});
    }
    //else clear
    else
 		  $("#searchresult").html("");
});
$("#invoicesearchinput").keyup(function(){
	//if 3 or more letters in search box
    if($("#invoicesearchinput").val().length>0)
	    $.ajax({url: "invoice/search?searchstring="+$("#invoicesearchinput").val(), success: function(result){
	 		  $("#searchresult").html(result);
	    }});
    //else clear
    else
 		  $("#searchresult").html("");
});
$("#purchasesearchinput").keyup(function(){
	//if 3 or more letters in search box
    if($("#purchasesearchinput").val().length>0)
	    $.ajax({url: "purchase/search?searchstring="+$("#purchasesearchinput").val(), success: function(result){
	 		  $("#searchresult").html(result);
	    }});
    //else clear
    else
 		  $("#searchresult").html("");
});
$("#clearsearch").click(function(){
 		  $("#searchresult").html("");
	    //hide all password entry boxes
	    $(".password_tr").attr('hidden',true);
});
</script>
  
</html>
