<script type="text/javascript">
    function deleteGroup(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('usr_group/delete'); ?>/" + id;
        }
       
    }
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th style="width:200px"><?php echo lang('txt_code_group'); ?></th> 
                <th><?php echo lang('txt_name_group'); ?></th>
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($group->fetchNext()) { ?>
            <tr>
               <td><?php echo $group->code; ?></td>
               <td><?php echo clean_html(getI18n($group->name)); ?></td>
                <td>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_list_urser') .': '. clean_html(getI18n($group->name)); ?>" href="<?php echo base_url('user/?name=&id_usr_group='.$group->id); ?>">
                            <span class="ui-icon ui-icon-folder-open"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('usr_group/edit/'.$group->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteGroup(<?php echo $group->id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>