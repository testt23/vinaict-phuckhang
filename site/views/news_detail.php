<div class="news">
    <?php $article->fetchNext(); ?>
    <h2 class="news-category"><?php echo $article->get_title(); ?></h2>
    <h4 class="date"><?php echo lang('txt_'.date('D',  strtotime($article->date))).', '.$article->get_date(); ?></h4>
    <p class="content-news"><?php echo $article->get_content(); ?></p>
</div>