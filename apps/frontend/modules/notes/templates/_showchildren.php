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
    <td><?php echo $spacer.link_to($child->getName(),"notes/view?id=".$child->getId()) ?></td>
    <td><?php echo $child->getDescription() ?></td>
    <td bgcolor=<?php echo $child->getStatus() ?>></td>
    <td><?php echo link_to("View","notes/view?id=".$child->getId()) ?></td>
    <td><?php echo link_to("Edit","notes/edit?id=".$child->getId()) ?></td>
    <td><?php echo link_to('Delete','notes/delete?id='.$child->getId(),array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
    <td><?php echo link_to("Add Child","notes/new?parent_id=".$child->getId()) ?></td>
    <?php echo form_tag("notes/sort"); ?>
    <input type=hidden name=id value=<?php echo $child->getId()?>>
    <td><input  size=1 name=priority value=<?php echo $child->getPriority()?>></td>
    <td><input type=submit value=Sort></td>
    <td>
    	<?php echo link_to("Red","notes/setstatus?id=".$child->getId()."&color=Red");?>
    	<?php echo link_to("Orange","notes/setstatus?id=".$child->getId()."&color=Orange");?>
    	<?php echo link_to("Yellow","notes/setstatus?id=".$child->getId()."&color=Yellow");?>
    	<?php echo link_to("Green","notes/setstatus?id=".$child->getId()."&color=Green");?>
    	<?php echo link_to("Blue","notes/setstatus?id=".$child->getId()."&color=Blue");?>
    	<?php echo link_to("Indigo","notes/setstatus?id=".$child->getId()."&color=Indigo");?>
    	<?php echo link_to("Violet","notes/setstatus?id=".$child->getId()."&color=Violet");?>
    </td>
    </form>
  </tr>
  <?php 
    $grandchildren=$child->getChildren();
    if($grandchildren and $levels>$level)include_partial("showchildren",array("notes"=>$child,"children"=>$grandchildren,"levels"=>$levels,"level"=>$level+1)); ?>
  <?php }?>

