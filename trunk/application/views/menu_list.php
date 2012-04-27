<script type="text/javascript">
    function deleteMenu(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('menu/delete'); ?>/" + id;
        }
       
    }
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th><?php echo lang('txt_name'); ?></th> 
                <th><?php echo lang('txt_uri'); ?></th> 
                <th><?php echo lang('txt_section'); ?></th> 
                <th style="width:50px;"><?php echo lang('txt_position'); ?></th> 
                <th><?php echo lang('txt_menu_upper_level'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($menu_item->fetchNext()) { ?>
            <tr>
                <td><?php echo getI18n($menu_item->name); ?></td>
                <td><?php echo $menu_item->link; ?></td>
                <td><?php echo $menu_item->section; ?></td>
                <td class="center"><?php echo $menu_item->position; ?></td>
                <td><?php echo getI18n($menu_item->parent_name); ?></td>
                <td>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('menu/edit/'.$menu_item->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteMenu(<?php echo $menu_item->id; ?>)">
                            <span class="ui-icon ui-icon-circle-close"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>