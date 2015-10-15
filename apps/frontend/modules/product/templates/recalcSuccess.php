
<?php 
echo form_tag("product/recalc"); 
?>
<br>If an error occurs, decrease the interval.
<br>I
<br>Interval: <input name=interval value="<?php echo $interval?>">
<br>Start: <input name=start value="<?php echo $start?>" >
<br>
<br><button name=submit onclick="myFunction(); ">Submit</button>
</form>
<br>
<br>
Products recalculated:<br>
<?php
foreach($products as $product)
{
    echo "<br>".$product->getName();
    
}
?>
<script>
function myFunction() {
    document.getElementsByName("submit")[0].innerHTML ="Please Wait";
}
    </script>