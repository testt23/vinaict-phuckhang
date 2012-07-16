<?php if ($title != ''): ?>
    <h1 class="title-main">
        <?php echo $title; ?>
    </h1>
<?php endif; ?>


<div id="product-container">
    <ul>
        <?php if (isset($product) && $product): ?>
            <?php $i = 0; ?>
            <?php while ($product->fetchNext()): ?>
                <?php if (($i % 4) == 0) { ?>
                    <li class="left">
                <?php } elseif ((($i - 3) % 4) == 0) { ?>    
                    <li class="right">
                <?php } else { ?>
                    <li>
                <?php } ?>
                    <div class="wrapper-popup">
                        <div class="list-image-wrapper">
                            <a class="range-img" href="<?php echo $product->the_product_link(); ?>">
                                <img src="<?php echo $product->the_image_link_thumb(); ?>" alt="<?php echo $product->the_image_name(); ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="name-pro">
                        <h3><a href="<?php echo $product->the_product_link(); ?>"><?php echo Variable::cut_string($product->the_product_name(), Variable::getNumberOfProductTitle()); ?></a></h3>
                        <strong><?php echo lang('lbl_price'); ?></strong><span style="color: #b41500;"> 
                            <?php
                            if ($product->the_product_price() == '' || $product->the_product_price() == '0') {
                                echo lang('lbl_call');
                            } else {
                                echo $product->the_product_price() . ' ' . $product->the_product_currency();
                            }
                            ?> 
                        </span>

                    </div>

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