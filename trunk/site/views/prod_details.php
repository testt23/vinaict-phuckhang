<?php $this->load->view('lightbox'); ?>

<script languag="javascript">
    jQuery(function(){
        jQuery('#slide-show-image span').lightBox();
    }); 
</script>
<?php if ($product->countRows() > 0): ?>
    <?php $product->fetchFirst(); ?>
    <div id="detail-prod">
        <div id="slide-show-image">
            <h2>
                <span class="sliderelative" href="<?php echo $product->the_image_link(); ?>" title="">
                    <img id="showimage" src="<?php echo $product->the_image_link_medium(); ?>" title=""/>
                </span>
                <?php
                    if ($image != ''){
                        foreach ($image as $item){?>
                        <?php if ($item['id'] != $product->the_product_id()): ?>
                        <span style="display: none;" href="<?php echo $item['link']; ?>" title=""></span>
                        <?php endif; ?>
                  <?php }
                    }
                ?>
            </h2>
            <div id="wrapper-image-slider">
                noi dung
            </div>
        </div>
        <div id="info-show-image">
            <ul>
                <li><h1>tieu de san pham</h1></li>
                <li><strong>Price:</strong> <font style="color: tomato;">200.000.000 VND</font> </li>
                <li><strong>Keywords:</strong>sanpham, tuong doi, binh thuong, khong co gi hay</li>
                <li><strong>Description </strong>: Trong suốt thời gian chinh chiến với nhau qua các server, chỉ có anh em trong nhóm hỗ trợ lẫn nhau về mọi mặt, chưa bao giờ nhận bất kỳ sự hỗ trợ nào từ bên ngoài nhóm. Trong suốt thời gian chinh chiến với nhau qua các server, chỉ có anh em trong nhóm hỗ trợ lẫn nhau về mọi mặt, chưa bao giờ nhận bất kỳ sự hỗ trợ nào từ bên ngoài nhóm. Trong suốt thời gian chinh chiến với nhau qua các server, chỉ có anh em trong nhóm hỗ trợ lẫn nhau về mọi mặt, chưa bao giờ nhận bất kỳ sự hỗ trợ nào từ bên ngoài nhóm. Trong suốt thời gian chinh chiến với nhau qua các server, chỉ có anh em trong nhóm hỗ trợ lẫn nhau về mọi mặt, chưa bao giờ nhận bất kỳ sự hỗ trợ nào từ bên ngoài nhóm.</li>
                <li>
                    <div id="order">
                        <form method="POST" action="<?php echo Variable::getLinkShowListCart(); ?>">
                            <input type="hidden" name="h_category" value="<?php echo $product->the_image_link_thumb(); ?>"/>
                            <input type="hidden" name="h_image" value="<?php echo $product->the_image_link_thumb(); ?>"/>
                            <input type="hidden" name="h_id" value="<?php echo $product->the_product_id(); ?>"/>
                            <input type="hidden" name="h_link" value="<?php echo $product->the_product_link(); ?>" />
                            <input type="hidden" name="h_code" value="<?php echo $product->the_product_code(); ?>" />
                            <input type="hidden" name="h_name" value="<?php echo $product->the_product_name(true); ?>"/>
                            <input type="hidden" name="h_price" value="<?php echo $product->the_product_price(true); ?>"/>
                            <input type="hidden" name="h_description" value="<?php echo $product->the_product_description(true); ?>"/>
                            <input type="hidden" name="h_curency" value="<?php echo $product->the_product_currency(); ?>"/>
                            <input type="hidden" name="click_access" value="click_access"/>
                            <input style="border: none;" type="submit" name="orderSubmit" value="<?php echo lang('btn_order'); ?>"/>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
<?php endif; ?>
