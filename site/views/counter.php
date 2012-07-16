    <?php 
        $count = Counter::add();
        $string = '';
        $string = $count;
    ?>
    <ul class ="counter">
        <?php if(strlen($string) < 6){ 
            $n = 6 - strlen($string);
            for($j=0;$j<$n;$j++){
        ?>
        <li>0</li> 
        <?php 
            }
        } 
        ?>
        
        <?php for($i=0; $i<strlen($string); $i++){ ?>
        <li><?php echo $string[$i]; ?></li>
        <?php } ?>
    </ul>
   