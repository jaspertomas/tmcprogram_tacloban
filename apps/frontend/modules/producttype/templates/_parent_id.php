        <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_parent_id">
        <div>
      <label for="producttype_parent_id">Parent Producttype</label>
      <div class="content">
             
      <?php 
        $parent=$form->getObject()->getParent();
        echo '<input name="producttype[parent_id]" value="'.$parent->getId().'" id="producttype_parent_id" type="text" readonly=true> ';
        if($parent->getId())
        {
          echo link_to($parent,"producttype/view?id=".$parent->getId());
          echo " ";
          echo link_to("(Edit)","producttype/edit?id=".$parent->getId());
        }
      ?>
      </div>
      </div>
      </div>

