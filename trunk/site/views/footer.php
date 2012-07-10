<?php $image_path = base_url() . $this->config->item('image_temp'); ?>        
</div>
        <div class="clear" id="footer-wrapper">
            <div id="footer" >
                <div id="linkbox">
                    <?php 
                    $Product = new Product();
                    $List = $Product->getListThreeCateFooter();
                    $total = count($List);
                    for ($i = 0; $i < $total; $i++):
                        $Ar = $List[$i];
                    ?>
                        <div class="box">
                            <a href="<?php echo $Ar['link'];  ?>"><img src="<?php echo $image_path; ?>/PK.png"  alt=""/><?php echo $Ar['name'];  ?></a>
                        </div>
                    <?php endfor; ?>
                </div>
                <div id="copyright">
                    <p>
                        <?php echo lang('site_footer_copy_right'); ?>
                    </p>
                    
                    <p><?php echo lang('site_footer_online_support'); ?>:<br/>
                        <a href="ymsgr:sendim?ngvancuong_thienduongmangtenem" mce_href="ymsgr:sendim?ngvancuong_thienduongmangtenem" border="0"><img class="online-counter" src="http://opi.yahoo.com/online?u=ngvancuong_thienduongmangtenem&t=1" mce_src="http://opi.yahoo.com/online?u=ngvancuong_thienduongmangtenem&t=1" height="20px" width="80px"></a>
                    </p>
                    <p>
                        <?php echo lang('site_footer_visit'); ?>: <br/>
                        <img src="http://hitwebcounter.com/counter/counter.php?page=4497634&style=0006&nbdigits=5&type=ip&initCount=0" title="Free Stats" Alt="<?php echo Variable::getDomainName(); ?>"   border="0" >
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>