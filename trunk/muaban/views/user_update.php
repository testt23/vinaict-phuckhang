<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head></head>
    <body>
        <?php $data->fechtNext() ?>
        <pre>
        First name: <input type="text" name="firstname" value="<?php echo $data->firstname ?>">
        Last name: <input type="text" name="lastname" value="<?php echo $data->lastname ?>">
        Address: <input type="text" name="address" value="<?php echo $data->address ?>">
        Email: <input type="text" name="email" value="<?php echo $data->email ?>">
        </pre>
        <br>
        
        <form method="post" action="update_user">
            <input type="hidden" name="email" value="<?php echo $data->id ?>">
            <input type="submit" name="update_ok" value="Update"> 
        </form>
        
        <form method="post" action="load_user">
            <input type="submit" name="cal_ok" value="Cancal"> 
        </form>
        
    </body>
</html>