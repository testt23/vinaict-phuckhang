<script language="javascript">
    $(document).ready(function(){
        var list = jQuery('#counter li');
        var width = list.length * 11;
        jQuery('#show-counter').css('width', width);
        jQuery('#show-counter').css('margin', '0px auto');
        
        var element = document.getElementById('show-counter');
        element.onselectstart = function () { return false; } // ie
        element.onmousedown = function () { return false; } // mozilla
        
    });
    
</script>

<?php $image_path = base_url() . $this->config->item('image_temp'); ?>        
    </div>
    </div>
</div>
        <div class="clear" id="footer-wrapper">
            <div id="footer" >
                <div id="linkbox">
                    <div class="box">
                        <a href="<?php echo base_url('products/souvenirs/');  ?>"><img src="<?php echo $image_path; ?>/pk-souvenirs.png"  alt=""/></a>
                    </div>
                    <div class="box" style="margin-left:112px;">
                        <a href="<?php echo base_url('products/interior/');  ?>"><img src="<?php echo $image_path; ?>/pk-interior.png"  alt=""/></a>
                    </div>
                    <div class="box" style="float:right;">
                        <a href="<?php echo base_url('products/spa/');  ?>"><img src="<?php echo $image_path; ?>/pk-spa.png"  alt=""/></a>
                    </div>
                </div>
                <div id="copyright">
                    <p>
                        <?php echo lang('site_footer_copy_right'); ?>
                    </p>
                    <div id="counter">
                        <?php echo lang('site_footer_visit'); ?>: <br/>
                        <div id="show-counter">
                            <?php include_once 'counter.php'; ?>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

