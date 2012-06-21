<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form id="form" name="form" method="post" action="">
    <select name="id" id="select">
    <?php 
    while ($Items->fetchNext()){  
        
    ?>
        <option value="<?php echo $Items->id ; ?>"><?php echo $Items->name ; ?></option>
      <?php   
        }
      ?>
    </select>
    <input type="submit" value="OK">  
</form>
