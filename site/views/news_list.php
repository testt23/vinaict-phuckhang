<div class="news">
    <?php $news_category->fetchNext(); ?>
    <h2 class="news-category"><?php echo $news_category->get_name(); ?></h2>
    <?php while($article->fetchNext()){ ?>
        <p class="title"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->id; ?>"><?php  echo $article->get_title(); ?></a>
        <h7 class="date"><?php echo date_sql_to_local_date($article->date); ?></h7>
        <p class="content-news"> <?php echo strlen($article->get_content()) > 400 ? substr($article->get_content(),0,400).'...' : $article->get_content(); ?>
        <span class="view-more"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->id; ?>"><?php echo lang('view_more') ?> &raquo;</a></span>
        </p>
    <?php } ?>
</div>