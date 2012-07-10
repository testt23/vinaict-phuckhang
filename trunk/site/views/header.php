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
            $(document).ready(function(){
                jQuery('#advance').click(function(){
                    if (jQuery('.search-popup').hasClass('hide')){
                        jQuery('.search-popup').removeClass('hide').addClass('show');
                    }else{
                        jQuery('.search-popup').removeClass('show').addClass('hide');
                    }
                });
                jQuery('.close-search-pop').click(function(){
                    jQuery('.search-popup').removeClass('show').addClass('hide');
                });
            });
            
        </script>
        
        <!--[if IE]> 
        <style typte="text/css">
        #box-search, .search-popup, .wrapper-popup, #showimage{
            border: solid 1px gray;
        }
        #order input{margin-top:  0px;}
        </style>
        <![endif]-->
        
            
        
    </head>
    
    <?php
    $this->session->set_userdata('lang_url', curPageURL());
    ?>
    <body>
        <div id="header">
            <div id="language-wrapper">
                <?php 
                   if($lang = Language::getArraylangIso()){
                           for($i = 0; $i < count($lang); $i ++){
                ?>
                            <a href="<?php echo base_url(); ?>language/index/?lang=<?php echo $lang[$i] ?>" class="float-right"><img style="width: 24px; height: 24px;" src="<?php echo base_url(); ?>/images/icons/<?php echo $lang[$i] ?>.png" /></a>	 
                 <?php 
                            } 
                      } 
                  ?>
            </div>
            
            
            <div id="searchbox">
                <form method="post" action="<?PHP echo base_url() . 'products/search'; ?>">
                    <input class="name-search" type="text" name="search-name" value=''/>
                    <input class="button-search" type="submit" name="button-search" value='Search'/>
                    <a href="#" id="advance">Option</a>
                    <div class="search-popup hide">
                        <div class="close-search-pop">X</div>
                        <div class="clear"> </div>
                        <div style="margin-right: 15px;">
                            Price From <input type="text" name="price-from-search" value=""/> <br/>
                            Price To <input type="text" name="price-to-search" value=""/><br/>
                            <select name="currency-search">
                                <option value="">Currency</option>
                            <?php $currency = new Currency();
                                $list_currence = $currency->get_list();
                                while($list_currence->fetchNext()):
                            ?>
                            <option value="<?php echo $list_currence->code; ?>"><?php echo $list_currence->code; ?></option>
                            <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </form>
                
            </div>
            <div id="logo">
                <a href="#"><img src="<?php echo $image_path; ?>/Logo.png" alt="" /></a>
            </div>
            <div id="menu">
                <ul>
                    <?php Menu::drawMenu($array_menus, $selected); ?>
                </ul>
            </div>
        </div>
        <div id="container">
    