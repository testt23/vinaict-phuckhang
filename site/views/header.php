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
        
    </head>
    
    <body>
        <div id="header">
            <div id="language-wrapper">
                <form method="post" action="" id="form-en">
                    <input type="hidden" value="en" name="display-lang"/>
                    <input id="lang-en" type="submit" value="" name="language"/>
                </form>
                    <form method="post" action="" id="form-vi">
                        <input type="hidden" value="vi" name="display-lang"/>
                        <input id="lang-vi" type="submit" value="" name="language"/>
                    </form>
                
            </div>
            <div id="logo">
                <a href="#"><img src="<?php echo $image_path; ?>/Logo.png" alt="" /></a>
            </div>
            
            <div id="menu">
                <ul>
                    <?php $List = Menu::getList(); ?>
                   <?php while($List->fetchNext()): ?>
                    <li><a href="<?php echo $List->the_link(); ?>"><?php echo $List->the_name(); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <div id="container">
      