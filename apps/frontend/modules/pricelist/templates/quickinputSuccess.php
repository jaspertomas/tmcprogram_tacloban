<?php use_helper('I18N', 'Date') ?>
<h1>Pricelist Quick Input: <?php echo $pricelistdata->pricelist?> <?php if($pricelistdata->pricelist->getDate())echo "as of ".$pricelistdata->pricelist->getDateTimeObject("date")->format("M d, Y");?> </h1>

<font color=red>
<?php foreach($errors as $error)echo $error."<br>"; ?>
</font>

<?php echo form_tag_for($pricelistdata->pricelistform,"pricelist/quickinput")?>

Pricelist Name: <?php echo $pricelistdata->pricelistform["name"]?>
<br>Vendor: <?php echo $pricelistdata->pricelistform["vendor_id"]?>
<br>Date: <?php echo $pricelistdata->pricelistform["date"]?>
<br>
Paste from spreadsheet:
<br><input name=submit type=submit value=Test><input name=submit type=submit value="Save">
<input name=id type=hidden value=<?php echo $pricelistdata->pricelist->getId()?>>
<br><textarea rows=15 cols=80 name=inputstring ><?php echo $inputstring?></textarea>
</form>



<hr>
	<?php 
		echo "Price List: ".($pricelistdata->pricelist->getId()?link_to($pricelistdata->pricelistname,"pricelist/view?id=".$pricelistdata->pricelist->getId()):$pricelistdata->pricelistname." (New Price List)");
		echo "<br>"."Vendor: ".($pricelistdata->vendor?link_to($pricelistdata->vendor,"vendor/view?id=".$pricelistdata->vendor->getId()):$pricelistdata->vendorname." (New Vendor)");
		echo "<br>"."Date: ".$pricelistdata->date;
	?>
<hr>

<table border=1>
	<tr>
		<td>Producttype Pathname</td>
		<td>Description</td>
		<td>Category1</td>
		<td>Category2</td>
		<td>Category3</td>
		<td>Category4</td>
		<td>Category5</td>
		<td>Category6</td>
		<td>Category7</td>
		<td>Category8</td>
		<td>Category9</td>
		<td>Category10</td>
		
	</tr>
	<?php foreach($producttypedata->items as $index=>$producttype){?>
	<tr>
		<td><?php echo $producttype["object"]
											?link_to($producttype["name"],"producttype/view?id=".$producttype["object"]->getId())
											:"(new)" ?></td>
		<td><?php echo $producttype["description"]?></td>
		<td><?php echo $producttype["category1"]?></td>
		<td><?php echo $producttype["category2"]?></td>
		<td><?php echo $producttype["category3"]?></td>
		<td><?php echo $producttype["category4"]?></td>
		<td><?php echo $producttype["category5"]?></td>
		<td><?php echo $producttype["category6"]?></td>
		<td><?php echo $producttype["category7"]?></td>
		<td><?php echo $producttype["category8"]?></td>
		<td><?php echo $producttype["category9"]?></td>
		<td><?php echo $producttype["category10"]?></td>
<?php //echo $producttype["product"]?link_to($data["object"],"product/view?id=".$data["object"]->getId()):$data["name"];?></td>
	</tr>
	<?php } ?>
</table>

<table border=1>
	<?php 
		$oldproducttypeid=0;
		foreach($productdata->items as $data){
		?>
	<?php 
		//if change producttype, print header
		if($data["producttype"]->getId()!=$oldproducttypeid){
			$oldproducttypeid=$data["producttype"]->getId();
			$producttypearray=$productdata->getProducttypeArrayByProductName($data["name"]);
		?>
	<tr>
		<td>Product</td>
		<td>New</td>
		<td>Description</td>
		<td>Product Type</td>
		<td>Sell Price</td>
		<td>Buy Price</td>
		<td><?php echo $producttypearray["category1"]?></td>
		<td><?php echo $producttypearray["category2"]?></td>
		<td><?php echo $producttypearray["category3"]?></td>
		<td><?php echo $producttypearray["category4"]?></td>
		<td><?php echo $producttypearray["category5"]?></td>
		<td><?php echo $producttypearray["category6"]?></td>
		<td><?php echo $producttypearray["category7"]?></td>
		<td><?php echo $producttypearray["category8"]?></td>
		<td><?php echo $producttypearray["category9"]?></td>
		<td><?php echo $producttypearray["category10"]?></td>
	</tr>
	<?php }?>
	<tr>
		<td><?php echo $data["object"]?link_to($data["object"],"product/view?id=".$data["object"]->getId()):$data["name"];?></td>
		<td><?php echo $data["object"]?"":"<font color=red>New</font>";?></td>
		<td><?php echo $data["description"];?></td>
		<td><?php echo $data["producttype"]
											//?$data["producttype"]["object"]
											?link_to($data["producttype"],"producttype/view?id=".$data["producttype"]->getId())
											:$data["producttypename"];
											?></td>
		<td align=right><?php echo $data["sell"]['price'];?></td>
		<td align=right><?php echo $data["buy"]['price'];?></td>

		<td><?php echo $data["category1"];?></td>
		<td><?php echo $data["category2"];?></td>
		<td><?php echo $data["category3"];?></td>
		<td><?php echo $data["category4"];?></td>
		<td><?php echo $data["category5"];?></td>
		<td><?php echo $data["category6"];?></td>
		<td><?php echo $data["category7"];?></td>
		<td><?php echo $data["category8"];?></td>
		<td><?php echo $data["category9"];?></td>
		<td><?php echo $data["category10"];?></td>
	</tr>
	<?php } ?>
</table>

