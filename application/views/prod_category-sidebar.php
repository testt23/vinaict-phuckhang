<script type="text/javascript">

    function getHref(){
        var code = jQuery('#code').val();
        var name = jQuery('#name').val();
        var keywords = jQuery('#keywords').val();
        var category = jQuery('#category').val();
        var sort_by = jQuery('#sort-by').val();
        var limit = jQuery('#limit').val();
        var href = '?code='+code+"&name="+name+"&keywords="+keywords;
        href += '&sort_by='+sort_by+"&category="+category+"&limit="+limit;
        return href;
    }
    
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
                <div class="portlet-content">
                    <form id="searchform" name="searchform" action="" method="post">
                        <ul>
                            <li>
                                <li>
                                <label for="title">Mã</label>
                                <div>
                                    <input type="text" id="code" name="code" value="<?php echo $filter['code']; ?>" />
                                </div>
                            </li>
                                <label for="title"><?php echo lang('txt_name'); ?></label>
                                <div>
                                    <input type="text" id="name" name="name" value="<?php echo $filter['name']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="keywords"><?php echo lang('txt_keyword'); ?></label>
                                <div>
                                    <input type="text" id="keywords" name="keywords" value="<?php echo $filter['keywords']; ?>" />
                                </div>
                            </li>
                            <li>
                                <label for="keywords">Tìm theo nhóm</label>
                                <div>
                                    <select id="category">
                                        <option value="0" <?php if ($filter['category'] == '0') echo 'selected'; ?>> -- <?php echo lang('txt_prod_cate_is_parent'); ?> </option>
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>" <?php if ($filter['category'] == $category['id']) echo 'selected'; ?> >
                                            <?php
                                                $flag = 1;
                                                for($i=0; $i < $category['level']; $i++) {
                                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                }

                                                echo ($category['level'] == 0 ? '&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;' : '&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;').getI18n($category['name']);
                                            }
                                            ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <label for="keywords"><?php //echo lang('txt_keyword'); ?>Sắp xếp theo</label>
                                <div>
                                    <select id="sort-by">
                                        <option value="1">Mới nhất</option>
                                        <option value="2" <?php if ($filter['sort_by'] == '2') echo 'selected'; ?>>Mã</option>
                                        <option value="3" <?php if ($filter['sort_by'] == '3') echo 'selected'; ?>>Tên</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <input type="button" id="bnt_search" value="<?php echo lang('txt_search'); ?>" />
                            </li>
                        </ul>
                    </form>
                </div>
        </div>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
        <div class="portlet-header ui-widget-header"><?php echo lang('txt_toolbox'); ?></div>
        <div class="portlet-content">
                <ul class="side-menu">
                        <li>
                            <span class="ui-icon ui-icon-triangle-1-e small-icon"></span>
                            <a href="<?php echo base_url('prod_category/add'); ?>"><?php echo lang('txt_add_product_category'); ?></a>
                        </li>
                </ul>
        </div>
</div>
