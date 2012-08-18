<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteArticle(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('article/delete'); ?>/" + id;
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
                <th width="100px"><?php echo lang('txt_picture'); ?></th> 
                <th style="width:150px"><?php echo lang('txt_title'); ?></th> 
                <th style="width:300px"><?php echo lang('txt_content'); ?></th> 
                <th style="width:150px"><?php echo lang('txt_link'); ?></th> 
                <th style="width:100px"><?php echo lang('txt_keyword'); ?></th> 
                <th style="width:100px"><?php echo lang('txt_category'); ?></th>
                <th style="width:120px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while ($article->fetchNext()) { ?>

                <tr>
                    <td>
                        <?php echo $article->picture ?
                                '<a href="' . direct_url(base_url(config_item('source_image') . $image_group_code . '/' . $article->picture)) . '" title="' . clean_html(getI18n($article->title)) . '" rel="prettyPhoto">
                        <img src="' . direct_url(base_url(config_item('source_image') . $image_group_code . '/' . str_replace(array('.jpg', '.png', '.gif', '.JPG', '.PNG', '.GIF'), array(BO_PROD_CATEGORY_IMG_SUFFIX . '.jpg', BO_PROD_CATEGORY_IMG_SUFFIX . '.png', BO_PROD_CATEGORY_IMG_SUFFIX . '.gif', BO_PROD_CATEGORY_IMG_SUFFIX . '.JPG', BO_PROD_CATEGORY_IMG_SUFFIX . '.PNG', BO_PROD_CATEGORY_IMG_SUFFIX . '.GIF'), $article->picture))) . '" alt="' . clean_html(getI18n($article->title)) . '" />
                    </a>' : lang('txt_no_picture'); ?>
                    </td>
                    <td><?php echo clean_html(getI18n($article->title)); ?></td>
                    <td><?php echo truncateString(clean_html(getI18n($article->content)), 100); ?></td>
                    <td><?php echo $article->link; ?></td>
                    <td><?php echo $article->keywords; ?></td>
                    <td><?php echo truncateString(clean_html(getI18n($article->name_category)), 100); ?></td>
                    <td>
                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('article/edit/' . $article->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                        </a>
                        <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteArticle(<?php echo $article->id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                        </a>
                    </td>
                </tr> 
            <?php } ?>
        </tbody>
    </table>

</div>