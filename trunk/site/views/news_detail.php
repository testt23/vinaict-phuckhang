<div class="news">
    <?php $article->fetchNext(); ?>
    <h2 class="news-category"><?php echo $article->getTitle(); ?></h2>
    <h4 class="date"><?php echo date_sql_to_local_date($article->date); ?></h4>
    <p class="content-news"><?php echo $article->content; ?></p>
</div>