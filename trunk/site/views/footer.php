<?php $image_path = base_url() . $this->config->item('image_temp'); ?>        
</div>
        <div class="clear" id="footer-wrapper">
            <div id="footer" >
                <div id="linkbox">
                    <div class="box">
                        <a href="<?php  echo base_url(); ?>products/prod_cate/souvenirs"><img src="<?php echo $image_path; ?>/PK.png"  alt=""/>SOUVENIRS</a>
                    </div>
                    <div class="box">
                        <a href="<?php echo base_url(); ?>product/prod_cate/interior"><img src="<?php echo $image_path; ?>/PK.png"  alt=""/>INTERIOR</a>
                    </div>
                    <div class="box">
                        <a href="<?php echo base_url(); ?>product/prod_cate/spa-accessories"><img src="<?php //echo IMAGE_PATH; ?>together/PK.png"  alt=""/>SPA</a>
                    </div>
                </div>
                <div id="copyright">
                    <p><?php echo lang('site_footer_copy_right'); ?></p>
                    <p><?php echo lang('site_footer_online_support'); ?>:<br/></p>
                    <p><?php echo lang('site_footer_visit'); ?>: <br/></p>
                </div>
            </div>
        </div>
    </body>
</html>