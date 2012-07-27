<script type="text/javascript" src="<?php echo base_url().'js/ckeditor/ckeditor.js'; ?>" ></script>
<script type="text/javascript">
    function validate() {
        
        document.prodform.submit();
       
    }
    
    $(document).ready(function() {
        
        $('#id_prod_category option').click(function() {
            $('#id_primary_product_category').html('<option value="0"><?php echo lang('txt_choose'); ?></option>');
            $('#id_prod_category option').each(function(){
                if ($(this).attr('selected') == true) {
                    $('#id_primary_product_category').append('<option value="'+$(this).val()+'">'+$(this).html()+'</option>');
                }
            });
        });
        
        $('#id_primary_product_category').html('<option value="0"><?php echo lang('txt_choose'); ?></option>');
        $('#id_prod_category option').each(function(){
            if ($(this).attr('selected') == true) {
                $('#id_primary_product_category').append('<option value="'+$(this).val()+'" '+ ($(this).val() == "<?php echo $product->id_primary_prod_category; ?>" ? "selected" : "") +'>'+$(this).html()+'</option>');
            }
        });
        
    });
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
    <div class="portlet-header ui-widget-header">
    <?php echo ($product->id ? lang('txt_edit_product') : lang('txt_add_product')); ?>
    </div>
    <div class="portlet-content">
        <form action="" method="post" enctype="multipart/form-data" class="forms" name="prodform" >
                <ul>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_product_code'); ?>
                                </label>
                                <div>
                                        <input type="text" id="code" name="code" value="<?php echo $product->code; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_product_name'); ?>
                                </label>
                                <div>
                                        <div type="text-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field text medium" id="name" name="name" value="<?php echo $product->name; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_short_description'); ?>&nbsp;(<?php echo lang('txt_about_50_words'); ?>)
                                </label>
                                <div>
                                        <div type="textarea-multilang" lang="en,vi" tabindex="1" maxlength="255" class="field textarea small" id="short_description" name="short_description" value="<?php echo $product->short_description; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_description'); ?>&nbsp;(<?php echo lang('txt_about_product_information'); ?>)
                                </label>
                                <div>
                                        <div type="texteditor-multilang" lang="en,vi" tabindex="1" class="field text medium" id="description" name="description" value="<?php echo $product->description; ?>" ></div>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_link'); ?>
                                </label>
                                <div>
                                        <?php 
                                        $arr_link = explode('-',  $product->link);
                                        $total_link = count($arr_link);
                                        $link = '';
                                        if ($total_link > 2){
                                            for ($i = 0; $i < $total_link - 1; $i++){
                                                $link[] = $arr_link[$i];
                                            }
                                            $link = implode('-', $link);
                                        }else{
                                            $link = $product->link;
                                        }
                                        
                                        
                                        ?>
                                    <input type="text" tabindex="1" maxlength="255" class="field text medium" id="link" name="link" value="<?php echo $link; ?>" />
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_price'); ?>
                                </label>
                                <div>
                                        <input type="text" class="field text" id="price" name="price" value="<?php echo $product->price; ?>" />
                                        <select id="currency" name="currency">
                                            <?php while ($currency->fetchNext()) { ?>
                                            <option value="<?php echo $currency->code; ?>" <?php if ($product->currency == $currency->code) { echo 'selected'; } ?> ><?php echo $currency->code; ?></option>
                                            <?php } ?>
                                        </select>
                                </div>
                        </li>
                        <li>
                            <label class="desc">
                                    <?php echo lang('txt_product_category'); ?> (<?php echo lang('txt_hold_ctrl_to_select_many'); ?>)
                            </label>
                            <div>
                                <select id="id_prod_category" name="id_prod_category[]" class="field select medium" multiple size="10" >
                                    <?php foreach ($categories as $category) { ?>
                                    <option <?php if (in_array($category['id'], $arr_prod_category)) { echo 'selected'; } ?> value="<?php echo $category['id']; ?>">
                                        <?php
                                        for($i=0; $i < $category['level']; $i++) {
                                            echo '--';
                                        }
                                        
                                        echo ($category['level'] == 0 ? '' : '&nbsp;').getI18n($category['name']);
                                        ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label class="desc">
                                <?php echo lang('txt_primary_product_category'); ?>
                                <select id="id_primary_product_category" name="id_primary_product_category">
                                    <option value="0"><?php echo lang('txt_choose'); ?></option>
                                </select>
                            </label>
                        </li>
                        <li>
                                <label class="desc">
                                        <?php echo lang('txt_keyword'); ?>&nbsp;(<?php echo lang('txt_separated_by_comma'); ?>)
                                </label>
                                <div>
                                        <input type="text" tabindex="1" maxlength="255" class="field text medium" id="keywords" name="keywords" value="<?php echo $product->keywords; ?>" />
                                </div>
                        </li>
                        <li>
                                <div>
                                    <input type="checkbox" class="field checkbox" id="is_featured" name="is_featured" value="1" <?php if ($product->is_featured) { echo "checked"; } ?> />
                                    <label for="is_featured" class="choice desc"><?php echo lang('txt_is_featured_product'); ?></label>
                                </div>
                        </li>
                        <li>
                                <label class="desc">
                                    <?php echo lang('txt_status'); ?>
                                </label>
                                <div>
                                    <input type="radio" class="field radio" id="is_disabled_1" name="is_disabled" value="<?php echo IS_NOT_DISABLED; ?>" <?php if ($product->is_disabled == IS_NOT_DISABLED) { echo "checked"; } ?> />
                                    <label for="is_disabled_1" class="choice desc"><?php echo lang('txt_publishing'); ?></label>
                                    <input type="radio" class="field radio" id="is_disabled_2" name="is_disabled" value="<?php echo IS_DISABLED; ?>" <?php if ($product->is_disabled == IS_DISABLED) { echo "checked"; } ?> />
                                    <label for="is_disabled_2" class="choice desc"><?php echo lang('txt_hidden'); ?></label>
                                </div>
                        </li>
                </ul>
            <input type="hidden" name="act" value="<?php echo ACT_SUBMIT; ?>" />
        </form>
    </div>
</div>
<div class="clearfix"></div>