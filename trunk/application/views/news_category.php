<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteNewsCategory(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('news_category/delete'); ?>/" + id;
        }
       
    }
    
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
    });
    
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th width="40px"><?php echo lang('txt_id'); ?></th> 
                <th width="200px"><?php echo lang('txt_name'); ?></th>                 
                <th width="200px"><?php echo lang('txt_description'); ?></th> 
                <th width="200px"><?php echo lang('txt_link'); ?></th> 
                <th width="200px"><?php echo lang('txt_keyword'); ?></th> 
                <th width="200px"><?php echo lang('txt_parent_news_category'); ?></th> 
                <th width="120px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php foreach($arr_news_category as $id => $news_category) { ?>
            <tr>
                <td><?php echo $news_category['id']; ?></td>
                <td><?php echo $news_category['name']; ?></td>
                
                <td><?php echo $news_category['description']; ?></td>
                <td><?php echo $news_category['link']; ?></td>
                <td><?php echo $news_category['keyword']; ?></td>
                <td><?php echo $news_category['id_parent']; ?></td>
                <td>
                    <a class="btn_no_text btn ui-state-ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('news_category/edit/'.$id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteProdCategory(<?php echo $id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
</div>