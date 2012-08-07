
<link rel="stylesheet" href="<?php echo base_url('js/prettyPhoto/css/prettyPhoto.css'); ?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url('js/prettyPhoto/js/jquery.prettyPhoto.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script language="javscript">
    alert("vao");
    jQuery(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            social_tools: false
        });
    });
    
</script>
<div>
    <style type="text/css">
        .wrapper-image{
            margin: 0px auto;
            padding: 10px;
        }
        .wrapper-image ul{
        }
        .library-image li{
            margin: 14px;
            width: 198px;
            height: 198px;
            float:left;
            
        }
        .library-image li div{
            text-align: center;
            width: 198px;
            height: 198px;
            display: table-cell;
            vertical-align: bottom;
        }
    </style>
    
    
    <div class="wrapper-image">
            <ul class="library-image">
                <?php while ($images['image']->fetchNext()): ?>
                <li>
                    
                    <div>
                        <a rel="prettyPhoto[pp_gal]" href="<?php echo $images['image']->the_image_link(); ?>">
                        <img title="<?php echo $images['image']->the_image_name(); ?>" alt="<?php echo $images['image']->the_image_name(); ?>" src="<?php echo $images['image']->the_image_link_avata(); ?>" alt=""/>
                        </a>
                    </div>
                        
                </li>
                <?php endwhile; ?>
            </ul>
     </div>
    <div class="clear" style="height: 20px;"></div>
    <div class="paging" style="text-align: center; clear:both;">
        <?php echo $images['pagination']; ?>
    </div>
    
        
    
</div>