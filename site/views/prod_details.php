<?php $this->load->view('lightbox'); ?>

<script languag="javascript">
    jQuery(function(){
        jQuery('#lightbox span').lightBox();
        jQuery('#slide-wrap-ul img').lightBox();
    }); 
</script>

<?php if ($product->countRows() > 0): ?>
    <?php $product->fetchFirst(); ?>
    <div id="detail-prod">
        <div id="slide-show-image">


            <div class="t-slide-wrapper-1">
                <div class="t-slide">
                    <div id="lightbox" class="wrap-tslide">
                        <span accesskey="<?php echo $product->the_image_link(); ?>">
                            <img id="showimage" src="<?php echo $product->the_image_link_medium(); ?>"/>
                        </span>
                        <?php if ($image != ''): ?>
                            <?php foreach($image as $item): ?>
                                <?php if ($item['id'] != $product->the_product_id()) : ?>
                                    <?php if($item['link'] != $product->the_image_link()): ?>
                                        <span accesskey="<?php echo $item['link']; ?>" style="display: none;"></span>
                                    <?php endif; ?>        
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (count($image) > 1): ?>
                    <div class="t-list-slide">
                        
                        <div id="slide-wrap-ul">
                            
                            <?php foreach ($image as $item): ?>
                            
                                   <img accesskey="<?php echo $item['link']; ?>"  src="<?php echo $item['link_avata']; ?>" alt="<?php echo $item['link_medium']; ?>" />
                                   
                            <?php  endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
        <div id="info-show-image">
            <ul>
                <li><h1><?php echo $product->the_product_name(); ?></h1></li>
                <li>
                    <strong><?php echo lang('lbl_price');?></strong> <font style="color: tomato;">
                    <?php if ($product->the_product_price(true) == '' || $product->the_product_price(true) == '0'): ?> 
                                <?php echo lang('lbl_call');?>
                    <?php else: ?>
                                <?php echo $product->the_product_price() . ' '; ?>
                                <?php echo $product->the_product_currency(); ?>
                    <?php endif; ?>
                    
                    </font> 
                </li>
                <li>
                    <?php echo $product->the_product_description(); ?>
                </li>
                <li>
                    <div id="order">
                        <form method="POST" action="<?php echo Variable::getLinkShowListCart(); ?>">
                            <input type="hidden" name="h_id" value="<?php echo $product->the_product_id(); ?>"/>
                            <input type="hidden" name="h_code" value="<?php echo $product->the_product_code(); ?>" />
                            <input type="hidden" name="h_name" value="<?php echo $product->the_product_name(true); ?>"/>
                            <input type="hidden" name="h_price" value="<?php echo $product->the_product_price(true); ?>"/>
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
