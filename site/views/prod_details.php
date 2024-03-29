<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>

<script languag="javascript">
  
    function validate() {
        
        document.order_form.submit();
       
    }
    
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
    });
    
</script>

<?php if ($product->countRows() > 0): ?>
    <?php $product->fetchFirst(); ?>
    <div id="detail-prod">
        <div class="title-prod"><h1><?php echo $product->get_product_name(); ?></h1></div>
        
        <div id="slide-show-image">
                <a rel="prettyPhoto[pp_gal]" href="<?php echo $product->get_image_link(); ?>" title="<?php echo $product->get_product_name(); ?>">
                    <img src="<?php echo $product->get_image_link_medium(); ?>"/>
                </a>
        </div>
        
        <div id="info-show-image">
            <ul>
                <li>
                    <strong><?php echo lang('lbl_price');?></strong> <font style="color: tomato;">
                    <?php if ($product->get_product_price(true) == '' || $product->get_product_price(true) == '0'): ?> 
                                <?php echo lang('lbl_call');?>
                    <?php else: ?>
                                <?php echo $product->get_product_price() . ' '; ?>
                                <?php echo $product->get_product_currency(); ?>
                    <?php endif; ?>
                    
                    </font> 
                </li>
                <li>
                    <div class="description-pro"><?php echo $product->get_product_description(); ?></div>
                </li>
                <li>
                    <div id="order" style="background:url(<?php echo base_url(); ?>images/site/<?php echo lang('txt_btn_order'); ?>) no-repeat;" onclick="validate()">
                        <form method="POST" name="order_form" action="<?php echo Variable::getLinkShowListCart(); ?>">
                            <input type="hidden" name="h_id" value="<?php echo $product->get_product_id(); ?>"/>
                            <input type="hidden" name="h_code" value="<?php echo $product->get_product_code(); ?>" />
                            <input type="hidden" name="h_name" value="<?php echo $product->get_product_name(true); ?>"/>
                            <input type="hidden" name="h_price" value="<?php echo $product->get_product_price(true); ?>"/>
                            <input type="hidden" name="h_curency" value="<?php echo $product->get_product_currency(); ?>"/>
                            <input type="hidden" name="click_access" value="click_access"/>
                            <input style="border: none;" type="submit" name="orderSubmit"  value=""/>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="clear"></div>
        
         <?php if (count($image) > 1): ?>
                    <div class="t-list-slide">
                        <label><?php echo lang('txt_other_pictures'); ?></label>
                        <div id="slide-wrap-ul">
                            
                            <?php foreach ($image as $item): ?>
                                <?php if($product->get_image_link() != $item['link']) : ?>
                            
                                    <a rel="prettyPhoto[pp_gal]" href="<?php echo $item['link']; ?>" title="<?php echo $product->get_product_name(); ?>" > <img src="<?php echo $item['link_avata']; ?>" /></a>
                                   
                                <?php endif; ?>       
                            <?php  endforeach; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>
    </div>
    <div class="clear"></div>
<?php endif; ?>