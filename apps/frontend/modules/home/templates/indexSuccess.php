<h1>Home Page</h1>

<?php if($sf_user->hasCredential(array('admin', 'sales', 'encoder'), false)){?>
<h1><?php echo link_to("Create temporary invoice",'invoice/new'); ?></h1>
<h1><?php if($sf_user->hasCredential(array('admin', 'sales', 'encoder'), false))echo link_to("View temporary invoices (New)",'invoice/listnew'); ?> </h1> 
<?php } ?>

<?php if($sf_user->hasCredential(array('admin', 'cashier', 'encoder'), false)){?>
<h1><?php echo link_to("View temporary invoices (Checked out)",'invoice/listcheckedout'); ?></h1>
<?php } ?>

<?php if($sf_user->hasCredential(array('admin', 'encoder'), false)){?>
<h1><?php echo link_to("New Product",'product/new'); ?></h1>
<table>
<tr valign=top>
  <td width=50%>
<?php echo link_to("Invoices",'invoice/index'); ?>
<br><?php echo link_to("Purchases",'purchase/index'); ?>
<br><?php echo link_to("Invoice Templates",'invoice_template/index'); ?>
<br><?php echo link_to("Purchase Templates",'purchase_template/index'); ?>
<br><?php echo link_to("Terms",'terms/index'); ?>
<br><?php echo link_to("Products",'product/index'); ?>
<br><?php echo link_to("Brands",'brand/index'); ?>
<br><?php echo link_to("Product Types",'producttype/view?id=1'); ?>
<br><?php echo link_to("Customers",'customer/index'); ?>
<br><?php echo link_to("Vendors",'vendor/index'); ?>
<br><?php echo link_to("Employees",'employee/index'); ?>
<br><?php echo link_to("Daily Sales Report",'invoice/dsr'); ?>
<br><?php echo link_to("Price List Recalculation",'product/recalc'); ?>

  </td>
  <td width=50%>
<?php echo link_to("Accounts",'account'); ?>
<br><?php echo link_to("Account Categories",'account'); ?>
<br><?php echo link_to("Journals",'journal'); ?>

  </td>
  <td width=50%>
<?php echo link_to("Stock",'stock/index'); ?>
<br><a href="/productchange2/productchangedetector.php">Product Change</a>
<?php //echo link_to("Stock quotas",'stock/stats'); ?>

  </td>
</tr>
</table>
<?php } ?>

<?php
Doctrine_Query::create()
  ->update('Product p')
  ->set('p.autocalcbuyprice', '?', true)
  ->execute();
?>

<?php
/*
      $products= Doctrine_Query::create()
        ->from('Product p')
  ->where('p.id >=390')
  ->andWhere('p.id<=395')
  ->execute();

foreach($products as $product)
{
	$product->setName($product->getName()." Square Raised");
	$product->save();
}
*/
?>
