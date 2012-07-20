<script type="text/javascript">
    function deletePage(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('webpage/delete'); ?>/" + id;
        }
       
    }
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th width="200px"><?php echo lang('txt_title'); ?></th> 
                <th width="250px"><?php echo lang('txt_content'); ?></th> 
                <th width="180px"><?php echo lang('txt_link'); ?></th> 
                <th width="100px"><?php echo lang('txt_keyword'); ?></th> 
                <th width="100px"><?php echo lang('txt_status'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($page->fetchNext()) { ?>
            
            <tr <?php if ($page->is_disabled == IS_DISABLED) { ?>class="row-disabled"<?php } ?> >
                <td><?php echo clean_html(getI18n($page->title)); ?></td>
                <td><?php echo truncateString(clean_html(getI18n($page->content)), 100); ?></td>
                <td><?php echo $page->link; ?></td>
                <td><?php echo $page->keywords; ?></td>
                <td><?php echo $page->is_disabled == IS_DISABLED ? lang('txt_hidden') : lang('txt_publishing'); ?></td>
                <td>
                    <?php if ($page->is_disabled == IS_DISABLED) { ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_toggle_publishing'); ?>" href="<?php echo base_url('webpage/toggleStatus/'.$page->id); ?>">
                            <span class="ui-icon ui-icon-check"></span>
                    </a>
                    <?php } else { ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_toggle_hidden'); ?>" href="<?php echo base_url('webpage/toggleStatus/'.$page->id); ?>">
                            <span class="ui-icon ui-icon-closethick"></span>
                    </a>
                    <?php } ?>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('webpage/edit/'.$page->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deletePage(<?php echo $page->id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>