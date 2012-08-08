
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/js/jquery.js"></script>        
        <style type="text/css" rel="stylesheet">
            *{
                padding: 0px;
                margin: 0px;

            }
            #wrapper{
                width: 479.5px;
                margin: 0px auto;
            }
            .clear{
                clear:both;
            }
            #title{
                padding: 10px 0px 10px 10px;
                background: yellowgreen;
                height: 60px;
            }

            #title h1{
                float:left;
                width: 100px;
            }
            #title p{
                margin-top: 15px;
                float:right;
                width: 350px;
                font-size: 1.4em;
            }
            #title p a{
                color: #fff;
                font-weight: bold;
                text-decoration: none;

            }
            .content{
                width: 400px;
                margin: 20px auto;
                position: relative;
            }
            .content a{
                margin: 0px 10px;
            }
            .select-login{
                margin: 20px 0px 0px 20px;
                text-decoration: underline;
                font-size: 1.0em;
            }
            .customer{
                width: 410px;
                margin: 10px auto;
            }
            .customer ul li{
                list-style: none;
                float:left;
                width: 50px;
                height: 50px;
                background: wheat;
                margin: 3px;
                border: solid 1px gray;
            }
            .paging{
                text-align: center;
            }
            .paging a{
                padding: 5px 10px;
                -moz-border-radius: 5px 5px 5px 5px;
                border-radius: 5px 5px 5px 5px;
                text-decoration: none;
                background: gray;
                margin: 0px 2px;
                line-height: 25px;
                color: #ffffff !important;
                text-transform: uppercase;
                font-size: 12px;
                font-weight: bold;

            }

            .next-prev-active{
                padding: 4.5px 10px;
                font-size: 0.9em;
                color: white;
                background: #D7D7D7;
                border-radius: 5px 5px 5px 5px;
            }

            .paging a:hover{
                color: yellow !important;
            }

            .paging a.page-active{
                color: yellow !important;
            }
            .waitting{
                position: absolute;
                top: 40px;
                left: 48%;
                display: none;
            }
        </style>
        <script language="javascript">
            $(document).ready(function(){
                jQuery('.waitting').hide();
                jQuery('.content a').click(function(){
                    jQuery('.waitting').show();
                });
            });
        </script>
    </head>
    <body>
            
        <div id="wrapper">
            <div id="title">
                <h1>
                    <?php $image_path = base_url() . $this->config->item('image_temp'); ?>
                    <a href="<?php echo base_url(); ?>"><img width="60px" height="50px" src="<?php echo $image_path; ?>/Logo.png" alt="<?php echo getI18n(SITE_NAME) . ', ' . FO_META_KEYWORDS; ?>" /></a>
                </h1>
                <p>
                    <a href="<?php echo base_url(); ?>">www.datvangnghethuat.com </a><br/>
                </p>
            </div>
            <div class="clear"></div>
            <?php if (Customer::getSessionLogin() == false): ?>
            <h2 class="select-login">Lựa chọn phương thức đăng nhập:</h2>
            <div class="content">
                <img class="waitting" src="<?php echo base_url('images/loadding.gif'); ?>"/>
                <a href="<?php echo $url_login_google; ?>"><img src="<?php echo base_url('images/google.jpg'); ?>"/></a>
                <!--<a href="<?php echo $url_login_tweet; ?>"><img src="<?php echo base_url('images/twitter.jpg'); ?>"/></a>-->
                <a href="<?php echo $url_login_yahoo; ?>"><img src="<?php echo base_url('images/yahoo.jpg'); ?>"/></a>
                <a href="<?php echo $url_login_facebook; ?>"><img src="<?php echo base_url('images/facebook.jpg'); ?>"/></a>
            </div>
            <?php endif; ?>
            
            <?php if ($customer->countRows() > 0): ?>
            <h2 class="select-login">Danh sách thành viên:</h2>
            <div class="customer">
                <ul>
                    <?php while ($customer->fetchNext()): ?>
                        <?php if (!empty($customer->link_profile)): ?>
                            <li><a href="<?php echo $customer->link_profile; ?>"><img alt="" width="100%" height="100%" src="<?php echo $customer->image; ?>"/></a></li>        
                        <?php else: ?>
                            <li><img width="100%" height="100%" src="<?php echo $customer->image; ?>"/></li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="paging" style="text-align: center; clear:both;">
                <?php
                echo $paging;
                ?>
            </div>
            <?php endif; ?>
        </div>
    </body>
</html>
