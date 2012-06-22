<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function deleteProdCategory(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('prod_category/delete'); ?>/" + id;
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
                <th width="40px"><?php echo lang('txt_code'); ?></th> 
                <th width="200px"><?php echo lang('txt_name'); ?></th> 
                <th width="120px"><?php echo lang('txt_picture'); ?></th> 
                <th width="200px"><?php echo lang('txt_description'); ?></th> 
                <th width="200px"><?php echo lang('txt_link'); ?></th> 
                <th width="200px"><?php echo lang('txt_keyword'); ?></th> 
                <th width="200px"><?php echo lang('txt_parent_product_category'); ?></th> 
                <th width="120px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php foreach($arr_prod_category as $id => $prod_category) { ?>
            <tr>
                <td><?php echo $prod_category['code']; ?></td>
                <td><?php echo $prod_category['name']; ?></td>
                <td>
                    <?php echo $prod_category['picture'] ? 
                    '<a href="'.direct_url(base_url(UPLOAD_IMAGE_URL.$image_group_code.'/'.$prod_category['picture'])).'" title="'.$prod_category['description'].'" rel="prettyPhoto">
                        <img src="'.direct_url(base_url(UPLOAD_IMAGE_URL.$image_group_code.'/'.str_replace(array('.jpg','.png','.gif','.JPG','.PNG','.GIF'), array(BO_PROD_CATEGORY_IMG_SUFFIX.'.jpg',BO_PROD_CATEGORY_IMG_SUFFIX.'.png',BO_PROD_CATEGORY_IMG_SUFFIX.'.gif',BO_PROD_CATEGORY_IMG_SUFFIX.'.JPG',BO_PROD_CATEGORY_IMG_SUFFIX.'.PNG',BO_PROD_CATEGORY_IMG_SUFFIX.'.GIF'), $prod_category['picture']))).'" alt="'.$prod_category['name'].'" />
                    </a>' : lang('txt_no_picture'); ?>
                </td>
                <td><?php echo $prod_category['description']; ?></td>
                <td><?php echo $prod_category['link']; ?></td>
                <td><?php echo $prod_category['keywords']; ?></td>
                <td>
                <?php 
                $parents = explode(',', $prod_category['id_parent']);
                foreach ($parents as $key => $parent) {
                    echo trim($parent) && isset($arr_prod_category[trim($parent)]) ? '('.$arr_prod_category[trim($parent)]['code'].') '.$arr_prod_category[trim($parent)]['name'].'<br/>' : '';
                }
                ?>
                </td>
                <td>
                    <a class="btn_no_text btn ui-state-<?php if (!$prod_category['picture']) { echo 'alert'; } else { echo 'default'; } ?> ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('prod_category/edit/'.$id); ?>">
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