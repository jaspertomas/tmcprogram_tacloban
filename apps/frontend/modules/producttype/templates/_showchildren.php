  <?php foreach($children as $child){
          if($child->isRoot())
            continue;
          $spacer="";
          for($step=0;$step<$level;$step++)
            $spacer.="&nbsp;>&nbsp;";
  ?>
  <tr>
    <td><?php echo $child->getId() ?></td>
    <td><input type=checkbox name="ids[]" value="<?php echo $child->getId()?>" /></td>
    <td><?php echo $spacer.link_to($child->getName(),"producttype/view?id=".$child->getId(),array('target'=>$child->getName())) ?></td>
    <td><?php echo $child->getDescription() ?></td>
    <td bgcolor=<?php echo $child->getStatus() ?>></td>
    <td><?php echo link_to("View","producttype/view?id=".$child->getId()) ?></td>
    <td><?php echo link_to("Edit","producttype/edit?id=".$child->getId()) ?></td>
    <td><?php echo link_to('Delete','producttype/delete?id='.$child->getId(),array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
    <td><?php echo link_to("Add Child","producttype/new?parent_id=".$child->getId()) ?></td>
    <td><input  size=1 value=<?php echo $child->getPriority()?>></td>
    <td><input type=submit value=Sort></td>
    <td>
    	<?php echo link_to("Red","producttype/setstatus?id=".$child->getId()."&color=Red");?>
    	<?php echo link_to("Orange","producttype/setstatus?id=".$child->getId()."&color=Orange");?>
    	<?php echo link_to("Yellow","producttype/setstatus?id=".$child->getId()."&color=Yellow");?>
    	<?php echo link_to("Green","producttype/setstatus?id=".$child->getId()."&color=Green");?>
    	<?php echo link_to("Blue","producttype/setstatus?id=".$child->getId()."&color=Blue");?>
    	<?php echo link_to("Indigo","producttype/setstatus?id=".$child->getId()."&color=Indigo");?>
    	<?php echo link_to("Violet","producttype/setstatus?id=".$child->getId()."&color=Violet");?>
    </td>
  </tr>
  <?php 
    $grandchildren=$child->getChildren();
    if($grandchildren and $levels>$level)include_partial("showchildren",array("producttype"=>$child,"children"=>$grandchildren,"levels"=>$levels,"level"=>$level+1)); ?>
  <?php }?>

