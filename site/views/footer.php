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
                        <a href="ymsgr:sendim?<?php echo Variable::getYahooSopportOnline(); ?>" mce_href="ymsgr:sendim?<?php echo Variable::getYahooSopportOnline(); ?>" border="0"><img class="online-counter" src="http://opi.yahoo.com/online?u=ngvancuong_thienduongmangtenem&t=1" mce_src="http://opi.yahoo.com/online?u=<?php echo Variable::getYahooSopportOnline(); ?>&t=1" height="20px" width="80px"></a>
                    </p>
                    <p>
                        <?php echo lang('site_footer_visit'); ?>: <br/>
                        <?php include_once 'counter.php'; ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>