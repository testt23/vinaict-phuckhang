<script type="text/javascript">
    function getHref() {
        // code
        var code = jQuery('#code').val();
        
        // name
        var name = jQuery('#name').val();
        
        // category
        var category = jQuery('#category').val();
        
        //keywords
        var keywords = jQuery('#keywords').val();
        
        // featured
        var is_featured = '0';
        if (jQuery('#is_featured').is(':checked')){
            is_featured = '1';
        }
        
        // disable
        var is_disabled_yes = '0';
        if (jQuery('#is_disabled_yes').is(':checked')){
            is_disabled_yes = '1';
        }
        var is_disabled_no = '0';
        if (jQuery('#is_disabled_no').is(':checked')){
            is_disabled_no = '1';
        }
        
        var price = jQuery('#price').val();
        var currency = jQuery('#currency').val();
        
        // sort by
        var sort_by = jQuery('#sort-by').val();
        
        // limit
        var limit = jQuery('#limit').val();
        var option_price = jQuery('#max-min-price').val();
        var href = "?name="+name+"&code="+code+"&category="+category+"&is_featured="+is_featured;
        href += "&disable_yes="+is_disabled_yes+"&disable_no="+is_disabled_no;
        href += "&option_price="+option_price+"&price="+price+"&currency="+currency+"&sort_by="+sort_by;
        href +="&limit=" + limit;
        return href;
    }
</script>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header ui-widget-header"><?php echo lang('txt_searchbox'); ?></div>
                <div class="portlet-content">
                    <form id="searchform" name="searchform" action="" method="post">
                            <ul>
                                <li>
                                    <label for="name">Mã sản phẩm</label>
                                    <div>
                                        <input type="text" id="code" name="code" value="<?php echo $filter['code']; ?>" />
                                    </div>
                                </li>
                                <li>
                                    <label for="name">Tên sản phẩm</label>
                                    <div>
                                        <input type="text" id="name" name="name" value="<?php echo $filter['name']; ?>" />
                                    </div>
                                </li>
                                <li>
                                    <label for="name">Từ khóa</label>
                                    <div>
                                        <input type="text" id="keywords" name="keywords" value="<?php echo $filter['keywords']; ?>" />
                                    </div>
                                </li>
                                <li>
                                    <label for="name">Chuyên mục</label>
                                    <div>
                                        <select id="category" name="category" class="field select medium">
                                        <option value="0" <?php if ($filter['id_prod_category'] == '0') echo 'selected'; ?>> -- <?php echo lang('txt_prod_cate_is_parent'); ?> </option>
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>" <?php if ($filter['id_prod_category'] == $category['id']) echo 'selected'; ?> >
                                            <?php
                                            $flag = 1;
                                            for($i=0; $i < $category['level']; $i++) {
                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            }

                                            echo ($category['level'] == 0 ? '&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;' : '&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;').getI18n($category['name']);
                                            ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                </li>
                                <li>
                                    <input type="checkbox" id="is_featured" name="is_featured" <?php if ($filter['is_featured'] == 1) echo 'checked' ?> value="1" />
                                    <strong style="font-weight: bold;">Đặc trưng</strong> 
                                </li>
                                <li>
                                    <label for="name">Hiển thị</label>
                                    <div>
                                        <input type="checkbox" name="is_disabled" id="is_disabled_yes" value="1"/> <strong style="font-weight: bold;">Có</strong> 
                                        <input type="checkbox" name="is_disabled" id="is_disabled_no" value="0"/> <strong style="font-weight: bold;">Không</strong> 
                                    </div>
                                </li>
                                <li>
                                    <label for="name">Giá</label>
                                    <div>
                                        
                                        <input type="text" value="<?php echo $filter['price']; ?>" name="price" id="price"  style="width: 110px !important;"/>
                                        <select id="currency" size="1" style="width: 60px;">
                                            <option value="">- Đơn giá -</option>
                                            <option value="VND" <?php if ($filter['currency'] == 'VND') echo 'selected'; ?>>VND</option>
                                            <option value="USD" <?php if ($filter['currency'] == 'USD') echo 'selected'; ?>>USD</option>
                                        </select>
                                        <select id="max-min-price" style="width: 110px;">
                                            <option value="1">Tất cả</option>
                                            <option value="2" <?php if ($filter['option_price'] == '2') echo 'selected'; ?>>Lớn hơn</option>
                                            <option value="3" <?php if ($filter['option_price'] == '3') echo 'selected'; ?>>Bé hơn</option>
                                            <option value="4" <?php if ($filter['option_price'] == '4') echo 'selected'; ?>>Bằng</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <label for="name">Sắp xếp theo</label>
                                    <div>
                                        <select id="sort-by">
                                            <option value="1">Sản phẩm mới nhất</option>
                                            <option value="2" <?php if ($filter['sort_by'] == '2') echo 'selected'; ?>>Mã sản phẩm</option>
                                            <option value="3" <?php if ($filter['sort_by'] == '3') echo 'selected'; ?>>Tên sản phẩm</option>
                                            <option value="4" <?php if ($filter['sort_by'] == '4') echo 'selected'; ?>>Giá sản phẩm</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <input type="button" value="Tìm kiếm" id="bnt_search"/>
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
                            <a href="<?php echo base_url('product/add'); ?>"><?php echo lang('txt_add_product'); ?></a>
                        </li>
                </ul>
        </div>
</div>
