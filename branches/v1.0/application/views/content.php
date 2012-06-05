<div id="main-wrapper">
    <div id="main-content" <?php if ($section == 'login') { ?>style="width:400px;margin: 50px auto;"<?php } ?> >
        <?php if ($section != 'login') { ?>
        <div id="breadcrumb" class="title">
            <?php if( isset($cfer)) { ?><?php echo $cfer->display(); ?><?php } ?>
        </div>
        <?php } ?>
        
        <?php include_once "notification_bar.php"; ?>
        <?php include_once "$section.php"; ?>
        
    </div>
    <div class="clearfix"></div>
</div>