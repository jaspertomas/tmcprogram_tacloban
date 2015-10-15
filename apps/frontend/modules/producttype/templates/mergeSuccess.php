<?php use_helper('I18N', 'Date') ?>

<?php echo form_tag_for(new ProducttypeForm(),"producttype/merge")?>

<table border=1>
  <tr>
    <td>Product: </td>
  </tr>
  <tr>
    <td><?php echo $product->getId()?></td>
    <td><?php echo $product->getName()?></td>
    <td><?php echo $product->getDescription()?></td>
  </tr>
  <tr>
    <td>Duplicate Products: </td>
  </tr>
<?php foreach($duplicateproducts as $duplicate){?>
  <tr>
    <td><?php echo $duplicate->getId()?></td>
    <td><?php echo $duplicate->getName()?></td>
    <td><?php echo $duplicate->getDescription()?></td>
  </tr>
<?php }?>
</table>


<input type=hidden name=product_id value=<?php echo $product->getId()?>>
<input type=hidden name=duplicate_ids value=<?php echo $duplicate_ids?>>
<input type=hidden name=producttype_id value=<?php echo $producttype_id?>>
<input type=submit name=submit value="Execute and Delete">
<input type=submit name=submit value=Execute>
</form>
