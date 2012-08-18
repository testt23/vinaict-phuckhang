<script type="text/javascript">
    $(document).ready(function(){
        $("#demoOne").jqGalScroll();
    
        var total = jQuery(".jqGSPagination ul li").length;
        var interval;
        function run(){
            clearInterval(interval);
            var currentImage = parseInt(jQuery(".jqGSPagination ul li a.selected").attr("title"));
            currentImage = currentImage + 1;
            var listA = jQuery(".jqGSPagination ul li a");
            var number = listA.attr("title");
            if (currentImage == total){
                currentImage = 0;
            }
            var obj = listA[currentImage];
            obj.click();
            interval = setInterval(run, 5000);
        }
        interval = setInterval(run, 5000);
                
    });
</script>

<div id="slide" class="slideShowNam">
    <ul id="demoOne">
        <?php
        $k = 1;
        for ($i = 1; $i <= 15; $i++) {
            ?>
                <li><img src="<?php echo config_item('source_image') . 'slide_show/slide' . $i . '.jpg'; ?>" alt="<?php echo $k++; ?>" /></li>    
            <?php
            
            //if (file_exists(direct_url(APPLICATION_PATH . '/' . config_item('upload_path') . 'images/slide_show/slide' . $i . '.png'))) {
                ?>
<!--                <li><img src="<?php echo config_item('source_image') . 'slide_show/slide' . $i . '.png'; ?>" alt="<?php echo $k++; ?>" /></li>    -->
                <?php
            //}
        }
        ?>
        <?php
        // OPEN FORDER
//        $dir = opendir(config_item('source_image') . 'slide_show');
//        $i = 1; $j = 1;
//        while (($file = readdir($dir)) !== FALSE) {
//            if ($j <= 2) {
//                $j++;
//            } else {
//                $arr = explode('.', $file);
//                $test_img = $arr[count($arr) - 1];
//                $test_img = strtolower($test_img);
//
//                if ($test_img == 'jpg' || $test_img == 'png' || $test_img == 'gif') {
//                    
        ?>
<!--        <li><img src="<?php // echo config_item('source_image') . 'slide_show/' . $file; ?>" alt="<?php //echo $i++; ?>" /></li>-->
        <?php
//                }
//            }
//        }
//        closedir();
        ?>
    </ul>
</div>
