<?php use_helper('I18N', 'Date') ?>

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByName('ids[]'); 
  for(var index = 0; index < boxes.length; index++) 
  { 
    box = boxes[index]; 
    if (box.type == 'checkbox') 
      box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked;
  } 
  return true;
}
function checkAllProductIds()
{
  var boxes = document.getElementsByName('product_ids[]'); 
  for(var index = 0; index < boxes.length; index++) 
  { 
    box = boxes[index]; 
    if (box.type == 'checkbox') 
      box.checked = document.getElementById('product_ids_header_checkbox').checked;
  } 
  return true;
}
/* ]]> */
</script>

<?php echo html_entity_decode($producttype->getBreadcrumbs()); ?>
&nbsp;&nbsp;<?php if(!$producttype->isRoot())echo link_to("(Edit)","producttype/edit?id=".$producttype->getId()) ?>
<hr>
<h1><?php echo "(".$producttype->getId().")".$producttype->getName() ?></h1>

<hr>
<b></b>
<?php echo form_tag_for(new ProducttypeForm(),"producttype/productmassoper")?>
Merge to product id: <input name=input size=10 >
<input type=hidden name=producttype_id value=<?php echo $producttype->getId()?> />
<input type=submit name=submit value=Merge />
<input type=submit name=submit value=Save />
<input type=submit name=submit value=Rename />
<input type=submit name=submit value=Monitor />
<input type=submit name=submit value=Unmonitor />
<br>Rename: Prefix <input name=prefix size=10 > Suffix <input name=suffix size=10 > Replace <input name=replace size=10 > With <input name=with size=10 >

<table border=1>
  <tr>
    <td>Id</td>
    <td><input id="product_ids_header_checkbox" onclick="checkAllProductIds();" type="checkbox"></td>
    <td>Product</td>
    <td>Description</td>
    <td>Max Sale</td>
    <!--td></td-->
    <td>Min Sale</td>
    <!--td></td-->
    <td>Max Vendor</td>
    <!--td></td-->
    <td>Min Vendor</td>
    <td>Qty</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Price</td>
    <!--td></td-->
    <td>Price</td>
    <!--td></td-->
    <td>Price</td>
    <!--td></td-->
    <td>Price</td>
    <!--td></td-->
    <td></td>
  </tr>
  <?php
//      $maxtotal=0;
//  	if($producttype->getId()==1)$products=array();
//  	else $products=$producttype->getProducts();
        foreach($products as $product){@$stock=$stockarray[$product->getId()];
  /* 
		//count number of invoicedetails * qty sold since a certain date
		$details = Doctrine_Query::create()
      ->from('Invoicedetail pd, pd.Invoice i')
      ->where('pd.product_id = '.$product->getId())
//      ->andWhere('i.date >= "2010-09-28"')
      ->execute();
      $max=0;
foreach($details as $detail){$max+=$detail->getQty();}

	$maxtotal+=$max;*/
  	
 	?>
  <tr>
    <td><?php echo $product->getId() ?></td>
    <td><input type=checkbox name="product_ids[]" value="<?php echo $product->getId()?>" /></td>
    <td><?php echo link_to($product->getName(),"product/view?id=".$product->getId()) ?></td>
    <td><?php echo $product->getDescription() ?></td>
    <td align=right><?php echo MyDecimal::format($product->getMaxsellprice()==""?0:$product->getMaxsellprice()) ?></td>
    <!--td><input name="maxsellprices[<?php echo $product->getId()?>]" size=1 /></td-->
    <td align=right><?php echo MyDecimal::format($product->getMinsellprice()==""?0:$product->getMinsellprice()) ?></td>
    <!--td><input name="minsellprices[<?php echo $product->getId()?>]" size=1 /></td-->
    <td align=right><font color=gray><?php echo MyDecimal::format($product->getMaxbuyprice()==""?0:$product->getMaxbuyprice()) ?></font></td>
    <!--td><input name="maxbuyprices[<?php echo $product->getId()?>]" size=1 /></td-->
    <td align=right><font color=gray><?php echo MyDecimal::format($product->getMinbuyprice()==""?0:$product->getMinbuyprice()) ?></fontx></td>
    <!--td><input name="minbuyprices[<?php echo $product->getId()?>]" size=1 /></td-->
    <td align=right><?php if($stock)echo link_to($stock->getCurrentQty()>0?$stock->getCurrentQty():" - - ","product/inventory?id=".$product->getId());?></td>
    <td><?php echo link_to("Edit","product/edit?id=".$product->getId()) ?></td>
    <td><?php echo link_to(
  'Delete',
  'product/delete?id='.$product->getId(),
  array('method' => 'delete', 'confirm' => 'Are you sure?')
) ?></td>
    <td><center><bold><?php //echo $max?$max:"" ?></bold></center></td>
  </tr>
  <?php }?>
</table>
<?php if($producttype->getId()==1){ ?>
More products not shown <?php echo link_to("Show All","producttype/view?id=1&showall=1");?>
<?php } ?>
<br>
<input type=submit name=submit value=Merge />
<input type=submit name=submit value=Save />
<input type=submit name=submit value=Rename />
<input type=submit name=submit value=Monitor />
<input type=submit name=submit value=Unmonitor />
</form>

<hr>
<?php echo form_tag("producttype/view?id=".$producttype->getId(),array("method"=>"get"))?>
View <input name=levels size=1 value=<?php echo $levels?>><input type=submit name=submit value=Levels />
</form>

<br>
<?php echo form_tag_for(new ProducttypeForm(),"producttype/massoper")?>
<table>
  <tr>
    <td>Id</td>
    <td><input id="sf_admin_list_batch_checkbox" onclick="checkAll();" type="checkbox"></td>
    <td>Name</td>
    <td>Description</td>
    <td>Status</td>
  </tr>

  <?php include_partial("showchildren",array("producttype"=>$producttype,"children"=>$producttype->getChildren(),"levels"=>$levels,"level"=>0)); ?>

</table>

<?php echo link_to("Add Child","producttype/new?parent_id=".$producttype->getId()) ?>
<br>
<br>
<input name=parent_id size=1 >
<input type=submit name=submit value=Move />
<input type=submit name=submit value=Copy />
</form>

<?php //echo $maxtotal?>
