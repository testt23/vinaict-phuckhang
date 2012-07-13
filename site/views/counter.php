    <?php 
        $count = Counter::add();
        $string = '';
        $string = $count;
    ?>
    <ul class ="counter">
        <?php for($i=0; $i<strlen($string); $i++){ ?>
        <li><?php echo $string[$i]; ?></li>
        <?php } ?>
    </ul>
   