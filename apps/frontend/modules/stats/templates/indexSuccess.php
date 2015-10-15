<table>
<?php
foreach($productqtys as $id=>$qty)
{
echo "<tr>";
	echo "<td>".$productnames[$id]."</td>";
	echo "<td>".$qty."</td>";
echo "</tr>";
}

?>
</table>
