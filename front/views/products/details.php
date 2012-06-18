<?php
$object = $this->list['object'];
$image = $this->list['image'];
?>



<script language="javascript">
    
    $(document).ready(function(){
        var interval;
        var next = $("#next-pointer");
        var prev = $("#prev-pointer");
        var items = $(".scrollable .items");
        var images = $(".scrollable .items img");
        var width = parseInt(images.length);
        var totalWidth = width * 110;
        jQuery('.items').css('width', totalWidth);
        if (width < 1){
            jQuery('#slide-images').html('');
        }
        if (width <= 4){
            $("#next-pointer").hide();
            $("#prev-pointer").hide();
        }
        // initialize scrollable
        //  $(".scrollable").scrollable();
        next.click(function(){
            //$('.wrp-info-img-postname li:first').fadeOut(1000).next().fadeIn(1000).end().appendTo('.wrp-info-img-postname ul')
            var sec = $(".scrollable .items img:nth-child(1)");
            sec.hide(300,"linear",function(){
                items.append($(this));//chen img vua an vao cuoi
                $(this).css({'display':'block'});
            })
            changeNumber(1);
        });
        prev.click(function(){
            var sec = $(".scrollable .items img:last");
            sec.css({'display':'none'});
            items.prepend(sec);
            sec.show(300,'linear');
            sec.css({'display':'block'});
            changeNumber(-1);
        });
        
    jQuery('#scrollable .items img').click(function(){
        clearInterval(interval);
        $(".scrollable .items img").removeClass('active');
        $(this).addClass('active');
        var src = $(this).attr('src');
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
                return;
            }
        }
        interval = setInterval(run, 6000);
    }
				
    });
</script>
<?php if ($object != '' && $object != null): ?>
    <div id="image">
        <img id="showimage" src="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $object->file); ?>" height="350"/>
        <div id="slide-images">
            <div class="slide">
                <a class="prev browse left" id="prev-pointer" src="images/left_btn_blue.png" alt=" "><img src="<?php echo IMAGE_PATH; ?>/together/left_btn_blue.png" /></a>
                <a class="next browse right" id="next-pointer" src="images/right_btn_blue.png" alt=" " ><img src="<?php echo IMAGE_PATH; ?>/together/right_btn_blue.png" /></a>
                <div class="scrollable" id="scrollable">
                    <!-- root element for the items -->
                        <div class="items">
                             <?php if (!empty($image)) : var_dump($image);?>
                            <?php $total_image = count($image); ?>
                            <?php for ($i = 0; $i < $total_image; $i++): ?>
                            
                            <img alt="<?php echo $i; ?>" class="active" src="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $image->file); ?>" height="350"/>
                            <?php endfor;?>
                            
                            <?php endif; ?>
                        </div>
                </div><!--end wrp-info-img-postname -->                              
            </div><!--end slide -->
        </div><!--end slide-images -->
    </div>

    <div id="info">
        <div id="text">
            <h3> <?php echo getI18n($object->name, 'en'); ?></h3>
            <p><b>Giá: <?php echo getI18n($object->price, 'en'); ?> <?php echo getI18n($object->currency, 'en'); ?></b></p>
            <p><b><?php echo getI18n($object->description, 'en'); ?></b></p>
        </div>
        <div id="order">
            <form method="POST" action="<?php echo URL; ?>order">
                <input type="hidden" name="hcategory" value="<?php echo $object->clink; ?>"/>
                <input type="hidden" name="h_image" value="hinhanh"/>
                <input type="hidden" name="h_id" value="<?php echo $object->id; ?>"/>
                <input type="hidden" name="h_name" value="ten"/>
                <input type="hidden" name="h_price" value="gia"/>
                <input type="submit" name="orderSubmit" value="ĐẶT HÀNG"/>
            </form>
        </div>
    </div>

<?php else: ?>
    <h2>Không có sản phẩm nào</h2>
<?php endif; ?>
