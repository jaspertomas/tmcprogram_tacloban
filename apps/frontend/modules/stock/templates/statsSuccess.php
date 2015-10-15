<table>
<tr>
  <td>Product</td>
  <td>Warehouse</td>
  <td>Quota</td>
  <td>Current Qty</td>
</tr>
<?php
foreach($stocks as $index=>$stock)
{
echo "<tr>";
	echo "<td>".$stock->getProduct()."</td>";
	echo "<td>".$stock->getWarehouse()."</td>";
	echo "<td>".$stock->getQuota()."</td>";
	echo "<td>".$stock->getCurrentqty()."</td>";
echo "</tr>";
}

?>
</table>
