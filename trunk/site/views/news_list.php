<div class="news">
    <?php $news_category->fetchNext(); ?>
    <h2 class="news-category"><?php echo $news_category->get_name(); ?></h2>
    <?php while ($article->fetchNext()) { ?>
        <div class="article">    
            <p class="title">
                <span class="new-img"><a href="#"><img src="<?php echo Article::get_image_link_tiny($article->picture); ?>"></img></a></span>
                <a href="<?php echo base_url(); ?>news/detail/<?php echo $article->id; ?>"><?php echo $article->get_title(); ?></a>
                <h7 class="date"><?php echo lang('txt_' . date('D', strtotime($article->date))) . ', ' . date_sql_to_local_date($article->date); ?></h7>
            </p>
            <div class="content-news"> <?php echo truncateString((Article::get_content_html($article->get_content())), 400); ?></div>
            <span class="view-more"><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->id; ?>"><?php echo lang('view_more') ?> &raquo;</a></span>
            <div class="clear"></div>
        </div>
    <?php } ?>
</div>