<?php $this->load->view('lightbox'); ?>

<script languag="javascript">
    jQuery(function(){
        jQuery('#slide-show-image span').lightBox();
    }); 
</script>
<?php if ($image != ''): ?>
    <script language="javascript">
                                
                                
        $(document).ready(function(){
                      
            var interval_sleep;
                        
            var interval;
            var next = $("#image-next");
            var prev = $("#image-prev");
            var items = $("#wrapper-item #items");
            var images = $("#wrapper-item #items img");
            var width = parseInt(images.length);
            var totalWidth = width * 115;
            jQuery('#items').css('width', totalWidth);
                                    
                                    
            var sleep = true;
                                    
                                    
            if (width < 1){
                jQuery('#slide-images').html('');
            }
                                    
            var first = jQuery("#wrapper-item #items img.active-slide");
            var src_first = first.attr('alt');
                                    
            $('#showimage').fadeOut(0,function(){
                $(this).attr('src', src_first).fadeIn(400);
            });
                                    
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
                            var sec = $("#wrapper-item #items img:nth-child(1)");
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
                        var sec = $("#wrapper-item #items img:last");
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
                        
            jQuery('#wrapper-item #items img').click(function(){
                clearInterval(interval);
                $("#wrapper-item #items img").removeClass('active-slide');
                $(this).addClass('active-slide');
                var src = $(this).attr('alt');
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
                var image = $("#wrapper-item #items img.active-slide");
                var number = parseInt(image.attr('title'));
                                    
                number = number + num;
                                        
                if (number == 0){
                    number = width;
                }
                if (number == width + 1){
                    number = 1;
                }
                var list = $("#wrapper-item #items img");
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
                <h1>
                    Thu vien mau
                </h1>
                <div class="t-slide">
                    <div class="wrap-tslide">
                        <img src="http://localhost/phuckhang/trunk/site/uploads/images/prod/fa12b9aed1cf562b476b46f298762ae0_medium.jpg"/>
                    </div>
                </div>
                <div class="t-list-slide">
                    <div class="next"></div>
                    <div class="prev"></div>
                    <div class="wrapper-t-list-slide">
                        <ul id="slide-ul">
                            <li><img src="http://localhost/phuckhang/trunk/site/uploads/images/prod/fa12b9aed1cf562b476b46f298762ae0_medium.jpg"/></li>
                            <li><img src="http://localhost/phuckhang/trunk/site/uploads/images/prod/fa12b9aed1cf562b476b46f298762ae0_medium.jpg"/></li>
                            <li><img src="http://localhost/phuckhang/trunk/site/uploads/images/prod/fa12b9aed1cf562b476b46f298762ae0_medium.jpg"/></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="container-slide">
                <h2>

                    <span class="sliderelative" href="<?php echo $product->the_image_link(); ?>" title="">
                        <div class="showimage-wrap">
                            <img id="showimage" src="<?php echo $product->the_image_link_medium(); ?>" title=""/>
                        </div>
                    </span>
                    <?php
                    if ($image != '') {
                        foreach ($image as $item) {
                            ?>
                            <?php if ($item['id'] != $product->the_product_id()): ?>
                                <span style="display: none;" href="<?php echo $item['link']; ?>" title=""></span>
                            <?php endif; ?>
                            <?php
                        }
                    }
                    ?>
                </h2>
                <?php if ($image != '') { ?>
                    <div id="wrapper-image-slider">
                        <div id="image-prev"></div>
                        <div id="image-next"></div>
                        <div id="wrapper-item">
                            <div id="items">
                                <?php $i = 0;
                                foreach ($image as $item): ?>
                                    <img title="<?php echo $i + 1; ?>" class="<?php
                        if ($i == 0) {
                            echo "active-slide";
                        }
                                    ?>" src="<?php echo $item['link_avata']; ?>" alt="<?php echo $item['link_medium']; ?>" />
                                         <?php $i++;
                                     endforeach; ?>
                            </div>
                        </div>

                    </div>
                <?php } ?>
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
