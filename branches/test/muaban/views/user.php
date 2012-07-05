<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head></head>
    <body>
        <table>
            <?php while ($data->fetchNext()) { ?>
                <tr>
                    <td><?php echo $data->id; ?></td>
                    <td><?php echo $data->first_name; ?></td>
                    <td><?php echo $data->last_name; ?></td>
                    <td><?php echo $data->address; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td>
                        <form method="post" action="update_user">
                            <input type="hidden" name="id" value="<?php echo $data->id; ?>" />
                            <input type="submit" name="update_ok" value="Update" />
                        </form>
                    </td>
                    <td>
                        <form method="post" action="detele_user">
                            <input type="hidden" name="id" value="<?php echo $data->id; ?>" />
                            <input type="submit" name="del_ok" value="Detele" />
                        </form>
                    </td>

                </tr>
            <?php } ?>
        </table>
        <form method="post" action="insert_user">
            First name  : <input type="text" name="firstname" value="" />
            Last name   : <input type="text" name="lastname" value="" />
            Address     : <input type="text" name="address" value="" />
            Email       : <input type="text" name="email" value="" />
            <input type="submit" name="add_ok" value="Insert user" />
        </form>
    </body>
</html>