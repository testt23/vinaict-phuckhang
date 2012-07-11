<script type="text/javascript">
    function deletePage(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('article/delete'); ?>/" + id;
        }
       
    }
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th style="width:150px"><?php echo lang('txt_title'); ?></th> 
                <th style="width:300px"><?php echo lang('txt_content'); ?></th> 
                <th style="width:150px"><?php echo lang('txt_link'); ?></th> 
                <th style="width:150px"><?php echo lang('txt_keyword'); ?></th> 
                <th style="width:150px"><?php echo lang('txt_category'); ?></th>
                <th style="width:120px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($article->fetchNext()) { ?>
            
            <tr>
                <td><?php echo clean_html(getI18n($article->title)); ?></td>
                <td><?php echo truncateString(clean_html(getI18n($article->content)), 100); ?></td>
                <td><?php echo $article->link; ?></td>
                <td><?php echo $article->keywords; ?></td>
                <td><?php echo truncateString(clean_html(getI18n($article->name_category)), 100); ?></td>
                <td>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('article/edit/'.$article->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deletePage(<?php echo $article->id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>