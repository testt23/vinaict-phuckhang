<?php
$theme_folders = $this->config->item('themes_folder') . '/';
$theme = $this->config->item('current_theme') . '/';
$skin = $this->config->item('current_skin');
$skin = $skin ? $skin . '/' : '';
$app_name = SITE_NAME;
$this->load->helper('url');
$base_url = base_url();
$theme_url = $base_url . $theme_folders . $theme . $skin;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit image</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="<?php echo $theme_url; ?>js/jquery-1.3.2.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
        <script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
        <link href="<?php echo $theme_url; ?>css/style.css" rel="stylesheet" media="all" />
        <link href="<?php echo base_url(); ?>css/common.css" rel="stylesheet" media="all" />
        <style>
            #wrapper{
                width: 100%;
                height: 100%;
            }
            #box{
                width: 500px;
                height: 400px;
                margin: 0px auto;
            }
            body{
                width: 500px;
                height: 400px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="box">
            <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container" >
                <div class="portlet-header ui-widget-header">
                    Sửa hình ảnh
                </div>
                
                
                <?php if($image): ?>
                <?php 
                $image->fetchFirst(); ?>
                <div class="portlet-content">
                    <form action="" method="post" enctype="multipart/form-data" class="forms" name="customerform" >
                        <ul>
                            <li>
                                <label for="is_business" class="desc">
                                        Tên
                                </label>
                                <div id="control-type" class="col">
                                        <input type="text" name="name" value="<?php echo $image->name; ?>"/>
                                        <input type="hidden" name="id" value="<?php echo $image->id; ?>"/>
                                </div>
                            </li>
                            <li>
                                <label for="is_business" class="desc">
                                        Mô tả
                                </label>
                                <div id="control-type" class="col">
                                        <input type="text" name="description" value="<?php  echo $image->description; ?>"/>
                                </div>
                            </li>
                            <li>
                                <label for="is_business" class="desc">
                                        Hiển thị thư viện ảnh
                                </label>
                                <div id="control-type" class="col">
                                        <input type="radio" name="is_display_front_end" value="1" <?php if ($image->is_display_front_end == '1') echo 'checked'; ?>/> Yes
                                        <input type="radio" name="is_display_front_end" value="0"  <?php if ($image->is_display_front_end == '0') echo 'checked'; ?>/> No
                                </div>
                            </li>
                            <li>
                                <div id="control-type">
                                    <h5 style=" margin-top: 10px;Color: blue;"><?php echo $mess; ?></h5>
                                        <input type="submit" value ="Save" name="save"/>  
                                </div>
                            </li>
                            
                        </ul>
                    </form>
                </div>
                <?php else: ?>
                    <h4>Hình ảnh này không được chỉnh sửa</h4>
                <?php endif; ?>
            </div>
        </div>
            </div>
    </body>
</html>
