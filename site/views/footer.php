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
                    
<!--                    <p><?php echo lang('site_footer_online_support'); ?>:<br/>
                        <a href="ymsgr:sendim?<?php echo Variable::getYahooSopportOnline(); ?>" mce_href="ymsgr:sendim?<?php echo Variable::getYahooSopportOnline(); ?>" border="0"><img class="online-counter" src="http://opi.yahoo.com/online?u=ngvancuong_thienduongmangtenem&t=1" mce_src="http://opi.yahoo.com/online?u=<?php echo Variable::getYahooSopportOnline(); ?>&t=1" height="20px" width="80px"></a>
                    </p>-->
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

