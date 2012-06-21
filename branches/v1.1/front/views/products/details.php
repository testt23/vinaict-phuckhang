<?php
$object = $this->list['object'];
$image = $this->list['image'];
$show = 'no';
?>


<?php if ($image != '' && $image != null): ?>
<?php if (count($image) >= 2):?>
<?php $show = 'yes';?>
<?php endif; ?>
<?php endif; ?>

<?php if ($show == 'yes'): ?>
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
                })
            }
            changeNumber(1);
        });
        prev.click(function(){
            if (width > 4){
                var sec = $(".scrollable .items img:last");
                sec.css({'display':'none'});
                items.prepend(sec);
                sec.show(300,'linear');
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
<?php if ($object != '' && $object != null): ?>
    <div id="image">
        
        <?php if ($show == 'yes'):?> 
        <div style="height: 350px;">
        <img id="showimage" src="" height="350"/>
        </div>
        <?php else:?>
        <img id="showimage" src="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $object->file); ?>" height="350"/>
        <?php endif;?>
        
        <?php if ($show == 'yes') : ?>
            <div id="slide-images">
                <div class="slide">
                    <a class="prev browse left" id="prev-pointer" src="images/left_btn_blue.png" alt=" "><img src="<?php echo IMAGE_PATH; ?>/together/left_btn_blue.png" /></a>
                    <a class="next browse right" id="next-pointer" src="images/right_btn_blue.png" alt=" " ><img src="<?php echo IMAGE_PATH; ?>/together/right_btn_blue.png" /></a>
                    <div class="scrollable" id="scrollable">
                        <!-- root element for the items -->
                        <div class="items">
                            <?php $total_image = count($image); ?>
                            <?php for ($i = 0; $i < $total_image; $i++): ?>
                            <?php if ($i == 0 ):?>
                                     <img alt="<?php echo $i; ?>" class="active" src="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $image[$i]->file); ?>" height="350"/>
                            <?php else:?>
                                      <img alt="<?php echo $i; ?>" src="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $image[$i]->file); ?>" height="350"/>
                            <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div><!--end wrp-info-img-postname -->                              
                </div><!--end slide -->
            </div><!--end slide-images -->
        <?php endif; ?>
    </div>

    <div id="info">
        <div id="text">
            <h3> <?php echo getI18n($object->name, $_SESSION['language']); ?></h3>
            <p><b><?php echo getI18n(PRICE, $_SESSION['language']); ?>: <?php echo getI18n($object->price, $_SESSION['language']); ?> <?php echo getI18n($object->currency, $_SESSION['language']); ?></b></p>
            <p><b><?php echo getI18n($object->description, $_SESSION['language']); ?></b></p>
        </div>
        <div id="order">
            <form method="POST" action="<?php echo URL; ?>order">
                <input type="hidden" name="hcategory" value="<?php echo $object->clink; ?>"/>
                <input type="hidden" name="h_image" value="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_large.jpg', '_large.png', '_large.gif'), $object->file); ?>"/>
                <input type="hidden" name="h_id" value="<?php echo $object->id; ?>"/>
                <input type="hidden" name="h_name" value="<?php echo getI18n($object->name, $_SESSION['language']); ?>"/>
                <input type="hidden" name="h_price" value="<?php echo getI18n($object->price, $_SESSION['language']); ?>"/>
                <input type="submit" name="orderSubmit" value="<?php echo getI18n(ORDER, $_SESSION['language']); ?>"/>
            </form>
        </div>
    </div>

<?php else: ?>
    <h2>Không có sản phẩm nào</h2>
<?php endif; ?>
