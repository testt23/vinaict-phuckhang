<style type="text/css">
    #content-container{
        border: none !important;
        background: none !important;
        width: 720px !important;
    }
</style>
<div class="slide-show">
    <?php $this->load->view('slide_show'); ?>
</div>
<div id="product-container">
    <ul>
        <?php if (isset($product) && $product): ?>
            <?php $i = 0; ?>
            <?php while ($product->fetchNext()): ?>
                <li>
                    <div class="img-product">   
                        <a href="<?php echo $product->get_product_link(); ?>">
                            <img src="<?php echo $product->get_image_link_thumb(); ?>" alt="<?php echo $product->get_product_name(); ?>" />
                        </a>
                    </div>
                    <div class="des-product">
                        <h3 class="name-pro"><a href="<?php echo $product->get_product_link(); ?>"><?php echo truncateString($product->get_product_name(), 45); ?></a></h3>
                        <span class="label-pro"><?php echo lang('lbl_prod_code') . ': '; ?></span>
                        <span class="value-pro"><?php echo $product->get_product_code(); ?></span>
                        <div class="description-pro"><?php echo trim(truncateString($product->get_product_description(), 270)); ?></div>
                        <p class="view-more"><a href="<?php echo $product->get_product_link(); ?>"><?php echo lang('view_more'); ?>&raquo;</a></p>
                    </div>
                    <div class="clear"></div>
                    
                </li>     
                <?php $i++; ?>    
            <?php endwhile; ?>
        <?php endif; ?>
    </ul>
    <div class="clear"></div>
    <div class="paging" style="text-align: center; clear:both;">
        <?php
        echo $paging;
        ?>
    </div>
</div>