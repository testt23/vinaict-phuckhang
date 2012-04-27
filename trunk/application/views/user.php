<script type="text/javascript">
    function deleteUser(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('user/delete'); ?>/" + id;
        }
       
    }
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th><?php echo lang('txt_profile'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($user->fetchNext()) { ?>
            <tr>
                    <td>
                        <table class="blank-table">
                            <tr>
                                <td colspan="2"><b><?php echo $user->last_name.' '.$user->first_name; ?></b></td>
                            </tr>
                            <tr>
                                <td width="150px"><?php echo lang('txt_address'); ?></td>
                                <td><?php echo $user->address; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_home_phone'); ?></td>
                                <td><?php echo $user->home_phone; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_work_phone'); ?></td>
                                <td><?php echo $user->work_phone; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_mobile_phone'); ?></td>
                                <td><?php echo $user->mobile_phone; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_email'); ?></td>
                                <td><?php echo $user->email; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_last_login_time'); ?></td>
                                <td><?php echo isset($user->date_last_login) ? date_sql_to_date($user->date_last_login) : lang('txt_never_login'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_group'); ?></td>
                                <td>
                                <?php 
                                $arr =  explode(',', $user->group_name);
                                
                                foreach ($arr as $k => $item)
                                    $arr[$k] = getI18n($item);
                                
                                echo implode(', ', $arr);
                                ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                <td>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_change_password'); ?>" href="<?php echo base_url('user/change_password/'.$user->id); ?>">
                            <span class="ui-icon ui-icon-key"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('user/edit/'.$user->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteUser(<?php echo $user->id; ?>)">
                            <span class="ui-icon ui-icon-circle-close"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
    <?php echo $pagination->create_links(); ?>
    
</div>