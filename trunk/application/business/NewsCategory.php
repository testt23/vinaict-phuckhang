<?php

class NewsCategory extends News_category_model {

    function __construct() {
        parent::__construct();
    }
    function getList($filter = array()) {

        $news_category = new NewsCategory();
        
        $news_category->addSelect();
        $news_category->addSelect('news_category.*');
        
        if (isset($filter['name']) && $filter['name'])
            $news_category->addWhere("news_category.name LIKE '%".$filter['name']."%'");

        if (isset($filter['keyword']) && $filter['keyword'])
            $news_category->addWhere("FIND_IN_SET('".$filter['keyword']."', news_category.keyword)");

        $news_category->find();
        return $news_category;

    }
    
    function getTree($filter = array(), $id_news_category_excluded = null) {

        $arrNewsCategory = array();

        $news_category = new NewsCategory();
        $news_category->addSelect();
        $news_category->addSelect('news_category.*');
       
        if ($id_news_category_excluded)
            $news_category->addWhere("news_category.id <> $id_news_category_excluded");

        if (isset($filter['id_news_category_parent']) && $filter['id_news_category_parent'])
            $news_category->addWhere("FIND_IN_SET('".$filter['id_news_category_parent']."', id_parent)");
        else
            $news_category->addWhere("id_parent IS NULL");

        if (!isset($filter['level']))
            $filter['level'] = 0;
        else
            $filter['level'] += 1;

        $news_category->find();

        while ($news_category->fetchNext()) {
            $arrNewsCategory[] = array(
                        'id' => $news_category->id,                        
                        'name' => $news_category->name,
                        'description' => $news_category->description,
                        'id_parent' => $news_category->id_parent,                        
                        'link' => $news_category->link,
                        'keywords' => $news_category->keyword,
                        'level' => $filter['level']
                    ); 
            $filter['id_news_category_parent'] = $news_category->id;
            $arrNewsCategory = array_merge($arrNewsCategory, NewsCategory::getTree($filter, $id_news_category_excluded));
        }

        return $arrNewsCategory;

    }
}
