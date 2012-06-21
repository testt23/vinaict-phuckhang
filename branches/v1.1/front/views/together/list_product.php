<?php
$List = $this->list;
?>
<div id="product-container">
    <ul>
        <?php $total = count($List);?>
     <?php for ($i = 0; $i < $total; $i++){?>
        <?php if (($i % 4) != 0){ ?>
         <li class="space"></li>
        <?php } ?>
        <li><a href="<?php echo URL; ?>products/<?php echo $List[$i]->clink; ?>/<?php echo $List[$i]->plink; ?>.html"><img src="<?php echo URL; ?>../uploads/images/prod/<?php echo str_replace(array('.jpg', '.png', '.gif'), array('_thumb.jpg', '_thumb.png', '_thumb.gif'), $List[$i]->file); ?>" alt="" /></a></li>     
     <?php }?>
    </ul>
    <div class="clear"></div>
    <div class="paging" style="text-align: center; clear:both;">
        
        <?php 
        if (isset($this->paging)){
            if (isset($this->cate)){
                $paging = str_replace('(*)', URL . '/products/' . $this->cate , $this->paging);
                echo $paging;
            }else{
                $paging = str_replace('(*)', URL . 'index'  , $this->paging);
                echo $paging;
            }
            
        }
        
        ?>
        
    </div>
</div>