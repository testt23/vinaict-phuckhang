<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url('js/treeview/jquery.treeview.css'); ?>" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/uploadifive/uploadifive.css'); ?>">
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('js/treeview/jquery.treeview.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url('js/zclip/jquery.zclip.min.js'); ?>"></script>
<script src="<?php echo base_url('js/uploadifive/jquery.uploadifive-v1.0.js'); ?>" type="text/javascript"></script>
<?php
        $image_size = ImageSize::getImageSizeByCode('small');
        $image_size = explode('x', strtolower($image_size->value));
?>
<style>
    .thumbnail img {
        max-width: <?php echo $image_size[0]; ?>px;
        max-height: <?php echo $image_size[1]; ?>px;
    }
    .thumbnail .image-container {
        width: <?php echo $image_size[0]; ?>px;
        height: <?php echo $image_size[1]; ?>px;
    }
</style>

<script type="text/javascript">
    
    var image_group_code = '';
    var buttonClass = 'ui-state-default ui-corner-all';
    
    function loadUpload() {
        
        $('#file_upload').uploadifive({
                    'auto'         : false,
                    'queueID'      : 'queue',
                    'buttonClass'   : 'btn ui-state-default ui-corner-all',
                    'uploadScript' : '<?php echo base_url("image/uploadifive"); ?>/'+image_group_code,
                    'buttonText'   : '<?php echo lang('txt_select_files'); ?>',
                    'onUploadComplete' : function(file, data) {
                        if (data == 1) {
                            //console.log(image_group_code);
                        }

                    }
            });
        
    }
    
    function reloadTrees() {
        
        var agr = new Array();
        var data = ajaxCallFunction('Image::renderFolderTrees',agr,'json');
        var tooltipimg = '';
        
        if(data) {
            $("#browser").html(data);
        }
        
        $('#browser li a').click(function(){
            $('#browser li a').each(function(){
                $(this).attr('class', $(this).attr('class').toString().replace(' select', ''));
            });
            $(this).attr('class', $(this).attr('class')+' select');
        });
        
        $('#browser .folder-link').click(function() {
            image_group_code = $(this).attr('foldername');
            
            $('#file_upload').uploadifive("destroy");
            loadUpload();
            
            var htmlcontent = '<ul>';
            $(this).parent().parent().find('li .file-link').each(function() {
                htmlcontent += '<li id="item_'+$(this).parent().parent().attr('id')+'" class="thumbnail" style="width:<?php echo $image_size[0]; ?>px;height:<?php echo $image_size[1]; ?>px" ><a href="<?php echo direct_url(site_url().'../uploads/images/'); ?>'+$(this).attr('path')+'" rel="prettyPhoto" title="'+$(this).attr('description')+'<br/><?php echo lang('txt_creation_date'); ?>: '+$(this).attr('cdate')+'"><div class="image-container"><img src="<?php echo direct_url(site_url().'../uploads/images/'); ?>'+$(this).attr('path')+'" alt="'+$(this).html()+'" /></div><h3>'+$(this).html()+'</h3></a></li>';
            });
            htmlcontent += '</ul>';
            $('#viewport').html(htmlcontent);
            
            $('#viewport li.thumbnail').mouseover(function() {
                $(this).attr('class', 'thumbnail thumbnail-hover');
            });
            
            $('#viewport li.thumbnail').mouseout(function() {
                $(this).attr('class', $(this).attr('class') + 'thumbnail');
            });
            
            $("a[rel^='prettyPhoto']").prettyPhoto({
                animation_speed: 'fast',
                social_tools: false
            });
            
        });
        
        $('#browser a.file-link').each(function(){
            $(this).qtip({
                content: {url: 'image_gallery/viewThumbnailPopup/'+$(this).attr('path').toString().replace('/', '-slash-')},
                position: {
                   target: 'mouse',
                   adjust: { mouse: true },
                   corner: {
                     tooltip: 'leftTop' // Use the corner...
                  }
                },
                style: {
                  border: {
                     width: 3,
                     radius: 5
                  },
                  padding: 10, 
                  textAlign: 'center',
                  tip: true, // Give it a speech bubble tip with automatic corner detection
                  name: 'light' // Style it according to the preset 'cream' style
               }
           });
        });
        
        $("#browser").treeview({
                toggle: function() {
                        console.log("%s was toggled.", $(this).find(">span").text());
                }
        });
        
    }
    
    $(document).ready(function(){
            
            reloadTrees();
            loadUpload();
            
            $('#upload-box').dialog({
		autoOpen: false,
		width: 600,
		bgiframe: false,
		modal: true,
                close: function() {
                    reloadTrees();
                }
            });
            
            $('#openUploadBox').click(function() {
                $('#upload-box').dialog("open");
            });
    });
    
</script>

<div id="upload-box" title="<?php echo lang('txt_upload_image'); ?>">
    <form>
            <div id="queue"></div>
            <input id="file_upload" name="file_upload" type="file" multiple="true" />
            <a class="btn ui-state-default ui-corner-all" style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>
    </form>
</div>
<div class="treeview-container">
    <ul id="browser" class="filetree treeview"></ul>
</div>
<div id="viewport" class="viewport-container"></div>
<div class="clearfix"></div>