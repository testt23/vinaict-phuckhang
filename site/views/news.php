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
                 
//                    echo '<pre>';
//                    var_dump($article); 
//                    echo '<pre>';
                 for( $j = 0 ; $j < count($article['id']) ; $j++ ){
                     if( $i < 2 ){
             
        ?>
        <p class="title"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article['id'][$j]; ?>"><?php  echo getI18n($article['title'][$j]); ?></a>
        <h7 class="date"><?php echo lang('txt_'.date('D',  strtotime($article['date'][$j]))).', '.date_sql_to_local_date($article['date'][$j]); ?></h7>
        </p>
        <p class="content-news"> <?php echo strlen(getI18n($article['content'][$j])) > 200 ? substr(getI18n($article['content'][$j]),0,200).'...': getI18($article['content'][$j]) ; ?>
        <span class="view-more"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article['id'][$j]; ?>"><?php echo lang('view_more'); ?> &raquo;</a></span>
        </p>
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
//                    echo '<pre>';
//                    var_dump($list_article); 
//                    echo '<pre>';
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