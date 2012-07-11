
<?php if ($image): ?>
<script language="javascript">
    
    $(document).ready(function(){
        var interval;
        var next = $("#next-pointer");
        var prev = $("#prev-pointer");
        var items = $(".scrollable .items");
        var images = $(".scrollable .items img");
        var width = parseInt(images.length);
        var totalWidth = width * 110;
        var no_click = 0;
        jQuery('.items').css('width', totalWidth);
        
        
        
        if (width < 1){
            jQuery('#slide-images').html('');
        }
        
        
        var first = jQuery(".scrollable .items img.active");
        var src_first = first.attr('src');
            src_first = src_first.replace('_thumb', '_large');
            $('#showimage').fadeOut(0,function(){
                $(this).attr('src', src_first).fadeIn(400);
            });
        if (width <= 4){
            $("#next-pointer").hide();
            $("#prev-pointer").hide();
        }
        // initialize scrollable
        //  $(".scrollable").scrollable();
        next.click(function(){
            //$('.wrp-info-img-postname li:first').fadeOut(1000).next().fadeIn(1000).end().appendTo('.wrp-info-img-postname ul')
                if (width > 4){
                    var sec = $(".scrollable .items img:nth-child(1)");
                    sec.hide(300,"linear",function(){
                        items.append($(this));//chen img vua an vao cuoi
                        $(this).css({'display':'block'});
                    });
                }
            changeNumber(1);
        });
        prev.click(function(){
            if (width > 4 ){
                
                var sec = $(".scrollable .items img:last");
                sec.css({'display':'none'});
                items.prepend(sec);
                sec.show(300,'linear', function(){
                });
                sec.css({'display':'block'});
            }
            
            changeNumber(-1);
        });
        jQuery('#scrollable .items img').click(function(){
            clearInterval(interval);
            $(".scrollable .items img").removeClass('active');
            $(this).addClass('active');
            var src = $(this).attr('src');
            src = src.replace('_thumb', '_large');
            $('#showimage').fadeOut(0,function(){
                $(this).attr('src', src).fadeIn(400);
            });
            interval = setInterval(run, 6000);
        });
    
        interval = setInterval(run, 6000);
        function run(){
            jQuery('#next-pointer').click();
        }
        function changeNumber(num){
            clearInterval(interval);
            var image = $(".scrollable .items img.active");
            var number = parseInt(image.attr('alt'));
        
            number = number + num;
            if (number == -1){
                number = width - 1;
            }
            if (number == width){
                number = 0;
            }else{
            }
            var list = $(".scrollable .items img");
            for (var i = 0; i < width; i++){
                var obj = jQuery(list[i]);
                if (parseInt(obj.attr('alt')) == number){
                    obj.click();
                    return false;
                }
            }
            interval = setInterval(run, 6000);
            
        }			
    });
</script>
<?php endif;?>




<?php if ($product->countRows() > 0): $product->fetchFirst(); ?>
<h1 class="title-main">
    
</h1>
    <div id="image">
            <div style="height: 350px;">
                <img id="showimage" src="<?php echo base_url() . $this->config->item('image_defailt_thum'); ?>" height="350"/>
            </div>
        <?php if ($image): ?>
            <div id="slide-images">
                <div class="slide">
                    <a class="prev browse left" id="prev-pointer" src="images/left_btn_blue.png" alt=" "><img src="<?php echo base_url(); ?>/images/site/left_btn_blue.png" /></a>
                    <a class="next browse right" id="next-pointer" src="images/right_btn_blue.png" alt=" " ><img src="<?php echo base_url(); ?>/images/site/right_btn_blue.png" /></a>
                    <div class="scrollable" id="scrollable">
                        <!-- root element for the items -->
                        <div class="items">
                            <?php $i = 0; $flag = 'no'; ?>
                            <?php if ($product->the_product_id_def_image() != '0'): ?>
                                <?php while($image->fetchNext()): ?> 
                                    <?php if ($image->the_image_id() == $product->the_product_id_def_image()):?>
                                             <img alt="<?php echo $i; ?>" class="active" src="<?php echo $image->the_image_link_thumb(); ?>" height="350"/>
                                    <?php else:?>
                                              <img alt="<?php echo $i; ?>" src="<?php echo $image->the_image_link_thumb(); ?>" height="350"/>
                                    <?php endif; $i++;?>
                                <?php endwhile; ?>
                            <?php else: ?>
                                   <?php while($image->fetchNext()): echo $i; ?> 
                                    <?php if ($i == 0):?>
                                             <img alt="<?php echo $i; ?>" class="active" src="<?php echo $image->the_image_link_thumb(); ?>" height="350"/>
                                    <?php else:?>
                                              <img alt="<?php echo $i; ?>" src="<?php echo $image->the_image_link_thumb(); ?>" height="350"/>
                                    <?php endif; $i++;?>
                                <?php endwhile; ?>                  
                             <?php endif; ?>
                        </div>
                    </div><!--end wrp-info-img-postname -->                              
                </div><!--end slide -->
            </div><!--end slide-images -->
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div id="info">
        <div id="text">
            <ul>
                <li><h2><?php echo $product->the_product_name(); ?></h2></li>
                <li>
                    <strong><?php echo lang('lbl_price');?></strong>
                    <span class="call-price">
                    <?php 
                    if ($product->the_product_price() == '0' || $product->the_product_price() == ''){
                        echo 'Call';
                    }else{
                        echo $product->the_product_price() . ' ' . $product->the_product_currency();
                    }
                    ?>
                 </span>
                </li>
                <li>
                    <strong><?php echo lang('lbl_description');?></strong>
                        <?php echo $product->the_product_description(); ?>
                </li>
            </ul>
        </div>
        <div id="order">
            <form method="POST" action="<?php echo Variable::getLinkShowListCart(); ?>">
                <input type="hidden" name="h_category" value="<?php echo $product->the_image_link_thumb(); ?>"/>
                <input type="hidden" name="h_image" value="<?php echo $product->the_image_link_thumb(); ?>"/>
                <input type="hidden" name="h_id" value="<?php echo $product->the_product_id(); ?>"/>
                <input type="hidden" name="h_link" value="<?php echo $product->the_product_link(); ?>" />
                <input type="hidden" name="h_code" value="<?php echo $product->the_product_code(); ?>" />
                <input type="hidden" name="h_name" value="<?php echo $product->the_product_name(true); ?>"/>
                <input type="hidden" name="h_price" value="<?php echo $product->the_product_price(); ?>"/>
                <input type="hidden" name="h_description" value="<?php echo $product->the_product_description(true); ?>"/>
                <input type="hidden" name="h_curency" value="<?php echo $product->the_product_currency(); ?>"/>
                <input type="hidden" name="click_access" value="click_access"/>
                <input style="border: none;" type="submit" name="orderSubmit" value="<?php echo lang('btn_order');?>"/>
            </form>
        </div>
    </div>
