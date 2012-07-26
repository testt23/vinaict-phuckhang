<?php

	class Article extends Article_model {

		function __construct() {
			parent::__construct();
		}
                
                 public function getList($filter = array()) {
        
                    $article = new Article();

                    $article->addJoin(new NewsCategory);

                    $article->addSelect();
                    $article->addSelect('article.*, news_category.name name_category');

                    if (isset($filter['title']) && $filter['title'])
                        $article->addWhere("title LIKE '%".$filter['title']."%'");

                    if (isset($filter['keywords']) && $filter['keywords'])
                        $article->addWhere("keywords LIKE '%".$filter['keywords']."%'");

                    if (isset($filter['id_news_category']) && $filter['id_news_category'])
                        $article->addWhere("id_news_category = ".$filter['id_news_category']);

                    $article->orderBy(getI18nRealStringSql("title"));

                    $article->find();

                    return $article;

                }
                
	}
