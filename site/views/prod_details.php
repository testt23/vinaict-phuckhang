<?php $this->load->view('lightbox'); ?>

<script languag="javascript">
    jQuery(function(){
        jQuery('#lightbox span').lightBox();
    }); 
</script>
<?php if ($image != ''): ?>
    <script language="javascript">
                                    
                                    
        $(document).ready(function(){
                          
            var interval_sleep;
                            
            var interval;
            var next = $(".t-list-slide #image-next");
            var prev = $(".t-list-slide #image-prev");
            var items = $(".t-list-slide #items");
            var images = $(".t-list-slide #items img");
            var width = parseInt(images.length);
            var totalWidth = width * 106;
            jQuery(items).css('width', totalWidth);
                                        
                                        
            var sleep = true;
            
            <?php if (count($image) > 1): ?>
                var first = jQuery(".t-list-slide #items li.slide-ul-wrap-active img");
                var src_first = first.attr('alt');

                $('#showimage').fadeOut(0,function(){    
                    $(this).attr('src', src_first).fadeIn(400);
                });
            <?php endif; ?>
                   
                   
            if (width <= 3){
                $(next).hide();
                $(prev).hide();
            }
            // initialize scrollable
            //  $(".scrollable").scrollable();
            var dont = true;
            next.click(function(){
                if (dont == true){
                    dont = false;
                    if (width > 3 ){
                        if (width > 3){
                            var sec = $(".t-list-slide  #items li:nth-child(1)");
                            sec.hide(300,"linear",function(){
                                items.append($(this));//chen img vua an vao cuoi
                                $(this).css({'display':'inline'});
                            });
                        }
                        changeNumber(1);
                        interval_sleep = setInterval(dellay, 500);
                    }
                }
            });
                      
                     
                            
            prev.click(function(){
                if (dont == true){
                    dont = false;
                    if (width > 3 ){
                        var sec = $(".t-list-slide  #items li:last");
                        sec.css({'display':'none'});
                        items.prepend(sec);
                        sec.show(300,'linear');
                        sec.css({'display':'inline'});
                    }
                    changeNumber(-1);
                    interval_sleep = setInterval(dellay, 500);
                }
            });
                            
            function dellay(){
                dont = true;
                clearInterval(interval_sleep);
            }
                            
            jQuery('.t-list-slide #items li').click(function(){
                clearInterval(interval);
                $(".t-list-slide #items li").removeClass('slide-ul-wrap-active');
                $(this).addClass('slide-ul-wrap-active');
                var src = $('.t-list-slide #items li.slide-ul-wrap-active img').attr('alt');
                $('#showimage').fadeOut(0,function(){
                    $(this).attr('src', src).fadeIn(400);
                });
                interval = setInterval(run, 6000);
            });
                            
                            
                            
            interval = setInterval(run, 6000);
                            
            function run(){
                jQuery(next).click();
            }
                            
            function changeNumber(num){
                clearInterval(interval);
                var image = $(".t-list-slide #items li.slide-ul-wrap-active img");
                var number = parseInt(image.attr('title'));
                                        
                number = number + num;
                                            
                if (number == 0){
                    number = width;
                }
                if (number == width + 1){
                    number = 1;
                }
                var list = $(".t-list-slide #items li img");
                for (var i = 0; i < width; i++){
                    var obj = jQuery(list[i]);
                    if (parseInt(obj.attr('title')) == number){
                        obj.click();
                    }
                }
                // interval = setInterval(run, 6000);      
            }			
        });
    </script>
<?php endif; ?>




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
                        <?php foreach($image as $item): ?>
                            <?php if ($item['id'] != $product->the_product_id()): ?>
                                <span accesskey="<?php echo $item['link']; ?>" style="display: none;"></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if (count($image) > 1): ?>
                <div class="t-list-slide">
                    <div id="image-prev"></div>
                    <div id="image-next"></div>
                    
                    <div id="slide-wrap-ul">
                        <ul id="items">
                            <?php $i = 0;
                            foreach ($image as $item): ?>
                                <li class="<?php
                                if ($i == 0) {
                                    echo "slide-ul-wrap-active";
                                }
                                        ?>" >
                                    <img title="<?php echo $i + 1; ?>" 
                                         src="<?php echo $item['link_avata']; ?>" alt="<?php echo $item['link_medium']; ?>" /></li>
                                    <?php $i++;
                                endforeach; ?>
                        </ul>
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
                    <strong>Price:</strong> <font style="color: tomato;">
                    <?php if ($product->the_product_price(true) == '' || $product->the_product_price(true) == '0'): ?> 
                                Call
                    <?php else: ?>
                                <?php echo $product->the_product_price() . ' '; ?>
                                <?php echo $product->the_product_currency(); ?>
                    <?php endif; ?>
                    
                    </font> 
                </li>
                <li><strong>Keywords:</strong> <?php echo $product->the_product_keywords(); ?></li>
                <li>
                    <strong>Description </strong>:
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
