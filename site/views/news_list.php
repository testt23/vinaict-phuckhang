<div class="news">
    <?php $news_category->fetchNext(); ?>
    <h2 class="news-category"><?php echo $news_category->name; ?></h2>
    <?php while($article->fetchNext()){ ?>
        <p class="title"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->id; ?>"><?php  echo $article->title; ?></a>
        <h7 class="date"><?php echo date_sql_to_local_date($article->date); ?></h7>
        <p class="content-news"> <?php echo strlen($article->content) > 400 ? substr($article->content,0,400).'...' : $article->content; ?>
        <span class="view-more"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->id; ?>">Xem thêm &raquo;</a></span>
        </p>
    <?php } ?>
</div>