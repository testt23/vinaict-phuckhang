<div class="news-detail">
    <?php $article->fetchNext(); ?>
    <span class="img-detail"><img src="<?php echo Article::get_image_link_small($article->picture); ?>"  /></span>
    <h2 class="title-detail"><?php echo $article->get_title(); ?></h2>
    <h4 class="date"><?php echo lang('txt_'.date('D',  strtotime($article->date))).', '.$article->get_date(); ?></h4>
    <div class="content-detail"><?php echo $article->get_content(); ?></div>
</div>