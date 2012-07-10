<?php

class Variable {
    // URL VARIABLES AND PAGING
    // SESSION VARIABLES
    function __construct() {
        
    }
    
    
    /***************************************************************/
    /******************** DEFAULT PAGE******************************/
    /***************************************************************/
    public function getDefaultPageString(){
        return defined('SITE_PAGE_DEFAULT_STRING') ? SITE_PAGE_INDEX_STRING : 'index';
    }
    
    
    /***************************************************************/
    /*******************VARRIABLE PAGES*****************************/
    /***************************************************************/
    
    
    // index page string route
    public function getIndexPageString(){
        return defined('SITE_PAGE_INDEX_STRING') ? SITE_PAGE_INDEX_STRING : 'index';
    }
    
    // page page string route
    public function getPagePageString(){
        return defined('SITE_PAGE_PAGE_STRING') ? SITE_PAGE_PAGE_STRING : 'page';
    }
    
    // product page string route
    public function getProductPageString(){
        return defined('SITE_PAGE_PRODUCT_STRING') ? SITE_PAGE_INDEX_STRING : 'products';
    }
    
    
    // product search string 
    public function getProductPageSearchString(){
        return defined('SITE_PAGE_PRODUCT__SEARCH_STRING') ? SITE_PAGE_INDEX_STRING : 'search';
    }
    
    
    /***************************************************************/
    /******************URL VARIABLES AND PAGING*********************/
    /***************************************************************/
    
    
    // get paging string url 
    // such as index.php?page=1, this function description for page
    public function getPaginationQueryString(){
        return defined('PAGINATION_QUERY_STRING_SEGMENT') ? PAGINATION_QUERY_STRING_SEGMENT : 'page';
    }
    
    
    // get how many record you want to display on screen
    public function getLimitRecordPerPage(){
        return 1;
    }
    
    
    
    
    
    // SESSION VARIABLES
    
    // session continue buy
    public function getSessionLinkContinueBuy(){
        return 'link_continue_buy';
    }
    
    // session shopping
    
    public function getSessionShopping(){
        return 'shopping';
    }
    
    
    
}

?>