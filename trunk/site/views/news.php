<?php while($news_category->fetchNext()){ ?>

<div class="news">
    <h2 class="news-category"><?php echo $news_category->get_name(); ?></h2>
    <div class="news-new">
        <?php
         $i = 0;
         $list_article = Array();
         $article = Array();
         foreach($article_array as $key => $article){
             if($key == $news_category->id){

                 for( $j = 0 ; $j < count($article['id']) ; $j++ ){
                     if( $i < 2 ){
        ?>
        <div class ="article">
        <p class="title">
            <span class="new-img"><a href="#"><img src="<?php echo Article::get_image_link_tiny($article['picture'][$j]); ?>" /></a></span>
            <a href="<?php echo base_url(); ?>news/detail/<?php echo $article['id'][$j]; ?>"><?php  echo clean_html(getI18n($article['title'][$j])); ?></a>
            <h7 class="date"><?php echo lang('txt_'.date('D',  strtotime($article['date'][$j]))).', '.date_sql_to_local_date($article['date'][$j]); ?></h7>
        </p>
        <div class="content-news"> 
            <?php echo truncateString(Article::get_content_html($article['content'][$j]),200); ?>
        </div>
        <span class="view-more"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article['id'][$j]; ?>"><?php echo lang('view_more'); ?> &raquo;</a></span>
        <div class="clear"></div>
        </div>
        <?php 
                        $i++;
                     }elseif( $i < 8 ){
                         $list_article['id'][] =  $article['id'][$j];
                         $list_article['title'][] =  getI18n($article['title'][$j]);
                         $list_article['date'][] =  $article['date'][$j];
                         $i++;
                     }else break;
                 }
                 
                 break;
            }
        } 
        ?>
        
    </div>
    <div class="list-new-old">
        
        <?php if(count($list_article) > 0){ ?>

            <ul>
                <?php for($k = 0; $k < count($list_article['id']); $k++){ ?>
                <li>    <a href="<?php echo base_url(); ?>news/detail/<?php echo $article['id'][$k]; ?>">
                            <?php echo $list_article['title'][$k]; ?>
                        </a>
                        <h7 class="date"><?php echo lang('txt_'.date('D',  strtotime($list_article['date'][$k]))).', '.date_sql_to_local_date($list_article['date'][$k]); ?></h7>
                </li>
                <?php } ?>
            </ul>
        
            <span class="view-more"><a href="<?php echo base_url(); ?>news/list_article/<?php echo $news_category->id; ?>"><?php echo lang('view_more_other'); ?> &raquo;</a></span>
        
        <?php } ?>
    </div>
    <div class="clear"></div>
</div>

<div class="rule"></div>

<?php } ?>