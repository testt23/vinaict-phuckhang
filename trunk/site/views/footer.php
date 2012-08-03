<script language="javascript">
   /* $(document).ready(function(){
        var list = jQuery('#counter li');
        var width = list.length * 11;
        jQuery('#show-counter').css('width', width);
        jQuery('#show-counter').css('margin', '0px auto');
        
        var element = document.getElementById('show-counter');
        element.onselectstart = function () { return false; } // ie
        element.onmousedown = function () { return false; } // mozilla
        
    });
    */
</script>

<?php $image_path = base_url() . $this->config->item('image_temp'); ?>        
    </div>
    </div>
</div>
        <div class="clear" id="footer-wrapper">
            <div id="footer" >
                <div id="linkbox">
                    <div class="box">
                        <a href="<?php echo base_url('san-pham/qua-luu-niem/');  ?>"><img src="<?php echo $image_path; ?>/pk-souvenirs.png"  alt="qua luu niem"/></a>
                    </div>
                    <div class="box" style="margin-left:112px;">
                        <a href="<?php echo base_url('san-pham/noi-that/');  ?>"><img src="<?php echo $image_path; ?>/pk-interior.png"  alt="noi that"/></a>
                    </div>
                    <div class="box" style="float:right;">
                        <a href="<?php echo base_url('san-pham/spa/');  ?>"><img src="<?php echo $image_path; ?>/pk-spa.png"  alt="spa"/></a>
                    </div>
                </div>
                <div id="footer-info">
                    <ul id="footer-menu">
                        <li><a href="<?php echo base_url(); ?>"><?php echo lang('site_home'); ?></a></li>
                        <li><a href="<?php echo base_url('gioi-thieu.html'); ?>"><?php echo lang('site_about_us'); ?></a></li>
                        <li><a href="<?php echo base_url('lien-he.html'); ?>"><?php echo lang('site_contact'); ?></a></li>
                        <li><a href="<?php echo base_url('site-map.html'); ?>"><?php echo lang('site_map'); ?></a></li>
                    </ul>
                    <div id="copyright">
                        <p>
                            &copy <b>Phuc Khang Gilding Store</b>. All rights reserved.<br/>Designed by VinaICT.com
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>

