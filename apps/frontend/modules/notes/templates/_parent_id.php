        <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_parent_id">
        <div>
      <label for="notes_parent_id">Parent Notes</label>
      <div class="content">
             
      <?php 
        $parent=$form->getObject()->getParent();
        echo '<input name="notes[parent_id]" value="'.$parent->getId().'" id="notes_parent_id" type="text" readonly=true> ';
        if($parent->getId())
        {
          echo link_to($parent,"notes/view?id=".$parent->getId());
          echo " ";
          echo link_to("(Edit)","notes/edit?id=".$parent->getId());
        }
      ?>
      </div>
      </div>
      </div>

