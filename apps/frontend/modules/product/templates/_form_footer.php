<?php 
if($form->getObject()->getId())
foreach(WarehouseTable::fetchAll() as $warehouse)
{
		$stock=StockTable::fetch($warehouse->getId(),$form->getObject()->getId());
		//$this->redirect("stock/view?id=".$stock->getId());
	echo link_to("Go to ".$warehouse." stock","stock/view?id=".$stock->getId())."<br>"; 
}
?>

