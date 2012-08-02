<!--
<?php if ($title_page != ''): ?>
            <h1 class="title-main">
    <?php echo $title_page; ?>
            </h1>
<?php endif; ?>
-->
<div>
    <a href="https://plus.google.com/113363812506979846549" rel="publisher">Tìm chúng tôi trên Google+</a>
    <h1>TEST</h1>
    

    <a href="<?php echo $openid->authUrl(); ?>">GOOGLE</a>
    <a href="<?php echo $openid->authUrl(); ?>">YAHOO</a>

    <HR/>

    <script language="javascript">
        gfc.id="15151858450723523553";
        
    </script>


    <hr/>

</div>
<div id="product-container">
    <ul>
        <?php if (isset($product) && $product): ?>
            <?php $i = 0; ?>
            <?php while ($product->fetchNext()): ?>

                <li>
                    <div class="wrapper-popup">
                        <div class="list-image-wrapper">
                            <a class="range-img" href="<?php echo $product->get_product_link(); ?>">
                                <img src="<?php echo $product->get_image_link_thumb(); ?>" alt="<?php echo $product->get_product_name(); ?>" />
                            </a>
                        </div>
                    </div>

                    <div class="name-pro">
                        <h3><a href="<?php echo $product->get_product_link(); ?>"><?php echo truncateString($product->get_product_name(), 30); ?></a></h3>
                        <div class="info">
                            <span class="label"><?php echo lang('lbl_prod_code') . ': '; ?></span>
                            <span class="value"><?php echo $product->get_product_code(); ?></span>
                        </div>
                        <div class="info">
                            <span class="label"><?php echo lang('lbl_price'); ?></span>
                            <span class="value">
                                <?php
                                if ($product->get_product_price() == '' || $product->get_product_price() == '0') {
                                    echo lang('lbl_call');
                                } else {
                                    echo $product->get_product_price() . ' ' . $product->get_product_currency();
                                }
                                ?> 
                            </span>
                        </div>
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