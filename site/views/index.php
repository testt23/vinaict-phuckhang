<div id="product-container">
    <ul>
        
        
     <?php if (isset($product) && $product): ?>
     <?php $i = 0; ?>
     <?php while($product->fetchNext()): ?>
        <?php if (($i % 4) !=0 ): ?>
         <li class="space"></li>
         <?php endif; ?>
            <li>
                <div class="wrapper-popup">
                    <a href="<?php echo $product->the_product_link(); ?>">
                        <img src="<?php echo $product->the_image_link_thumb(); ?>" alt="<?php echo $product->the_image_name(); ?>" />
                    </a>
                    <div class="p-popup">
                        <a><?php echo $product->the_product_name(); ?></a>
                    </div>
                </div>
            </li>     
        <?php $i++; ?>    
        <?php endwhile;?>
        <?php endif; ?>
    </ul>
    <div class="clear"></div>
    <div class="paging" style="text-align: center; clear:both;">
        <?php 
        echo $paging;
        ?>
    </div>
</div>