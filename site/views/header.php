<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
            $image_path = base_url() . $this->config->item('image_temp');
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $this->config->item('app_name'); ?></title>
        <link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/js/jquery.js"></script>        
        <script language="javascript">
            jQuery(document).ready(function(){
                jQuery('#searchsubmit').submit(function(){
                    if (jQuery('input[name="txt-search"]').val() == ''){
                        return false;
                    }
                    return true;
                });
                jQuery('#searchbox').click(function(){
                    if (!jQuery('#box-search').hasClass('activ')){
                        jQuery('#box-search').removeClass('none').addClass('show')
                    }else{
                        jQuery('#box-search').removeClass('activ');
                    }
                });
                
                jQuery('#cancel').click(function(){
                     jQuery('#box-search').removeClass('show').addClass('none').addClass('activ');
                });
            });
          
               
          
            
        </script>
    </head>
    <?php
    $this->session->set_userdata('lang_url', curPageURL());
    ?>
    <body>
        <div id="header">
            <div id="language-wrapper">
                <form method="post" action="<?php echo base_url() . 'language/index/en' ?>" id="form-en">
                    <input type="hidden" value="en" name="display-lang"/>
                    <input id="lang-en" type="submit" value="" name="language"/>
                </form>
                <form method="post" action="<?php echo base_url() . 'language/index/vi' ?>" id="form-vi">
                    <input type="hidden" value="vi" name="display-lang"/>
                    <input id="lang-vi" type="submit" value="" name="language"/>
                </form>
            </div>
            <div id="searchbox" class="searchbox">
                Search
                <div id="box-search" class="none" >
                    <form method="post" action="">
                        Name: <input type="text"/><br/>
                        Price from: <input type="text"/><br/>
                        Price to: <input type="text"/><br/>
                        Price to: <input type="text"/><br/>
                        <input id="cancel" class="bt" type="button" value="Cancel"/> <input class="bt" type="submit" value="Search"/><br/>
                    </form>
                </div>
            </div>
            <div id="logo">
                <a href="#"><img src="<?php echo $image_path; ?>/Logo.png" alt="" /></a>
            </div>
            <?php //include_once 'menu.php'; ?>
            <div id="menu">
                <ul>
                    <?php Menu::drawMenu($array_menus, 'home'); ?>
                </ul>
            </div>
        </div>
        <div id="container">
    