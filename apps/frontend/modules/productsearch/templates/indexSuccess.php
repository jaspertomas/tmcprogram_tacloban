<?php slot('transaction_id', $transaction_id) ?>
<?php slot('transaction_type', $transaction_type) ?>
<h1>Product Search</h1>
<table border=1>
<tr>
  <?php if($transaction_type=="Invoice" or $transaction_type=="Purchase"){?>
	<td></td>
	<?php }?>
	<td>Id</td>
	<td>Name</td>
	<td>Description</td>
	<td>Max Sale</td>
	<td>Min Sale</td>
	<td>Max Vendor</td>
	<td>Min Vendor</td>
	<td>TMC Stock</td>
	<td>Edit</td>
	<td>Price List</td>
	<td>Transactions</td>
</tr>
<?php foreach($products as $product){@$stock=$stockarray[$product->getId()];?>
<tr>
  <?php if($transaction_type=="Invoice"){?>
	<td><?php echo link_to("Use in Invoice","invoice/view?id=".$transaction_id."&product_id=".$product->getId());?></td>
  <?php }elseif($transaction_type=="Purchase"){?>
	<td><?php echo link_to("Use in Purchase","purchase/view?id=".$transaction_id."&product_id=".$product->getId());?></td>
	<?php }?>
	<td><?php echo $product->getId()?></td>
	<td><?php echo $product->getName()?></td>
	<td><?php echo $product->getDescription()?></td>
	<td align=right><?php echo $product->getMaxsellprice()?></td>
	<td align=right><?php echo $product->getMinsellprice()?></td>
	<td align=right><font color=gray><?php echo $product->getMaxbuyprice()?></font></td>
	<td align=right><font color=gray><?php echo $product->getMinbuyprice()?></font></td>
	<td align=right><?php if($stock)echo link_to($stock->getCurrentQty()>0?$stock->getCurrentQty():" - - ","product/inventory?id=".$product->getId());?></td>
	<td><?php echo link_to("Edit","product/edit?id=".$product->getId());?></td>
	<td><?php echo link_to("Price List","producttype/view?id=".$product->getProducttypeId());?></td>
	<td><?php echo link_to("Transactions","product/view?id=".$product->getId());?></td>
</tr>
<?php	} ?>
<?php /*foreach($products as $product){?>
<tr>
	<td><?php echo $product->getId()?></td>
	<td><?php echo $product->getName()?></td>
	<td><?php echo $product->getDescription()?></td>
	<td><?php echo $product->getMaxsellprice()?></td>
	<td><?php echo $product->getMinsellprice()?></td>
	<td><?php echo $product->getMaxbuyprice()?></td>
	<td><?php echo $product->getMinbuyprice()?></td>
	<td><?php echo $product->getCurrentQty()?></td>
	<td><?php echo link_to("Edit","product/edit?id=".$product->getId());?></td>
	<td><?php echo link_to("Price List","producttype/view?id=".$product->getProducttypeId());?></td>
	<td><?php echo link_to("Stock","product/inventory?id=".$product->getId());?></td>
	<td><?php echo link_to("Transactions","product/view?id=".$product->getId());?></td>
</tr>
<?php	} */?>
</table>

