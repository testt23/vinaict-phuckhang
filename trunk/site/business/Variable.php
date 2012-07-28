<?php
class Variable {
    // URL VARIABLES AND PAGING
    // SESSION VARIABLES
    function __construct() {
        
    }
    
    
    // SETTING MAILER AND HOST AND DOMAIN
    
    public function getDomainName(){
        return defined('DOMAIN_NAME') ? DOMAIN_NAME : 'www.DatVangNgheThuat.com';
    }
    
    public function getSiteName(){
        return defined('SITE_NAME') ? SITE_NAME : '<en>Phuc Khang Gilding Store</en><vi>Cửa Hàng Dát Vàng Phúc Khang</vi>';
    }
    
    public function getCompanyName(){
        return defined('COMPANY_NAME') ? COMPANY_NAME : 'Công ty TNHH Dát Vàng Phúc Khang';
    }
    
    public function getCompanyAddress(){
        return defined('COMPANY_ADDRESS') ? COMPANY_ADDRESS : '207 Huỳnh Văn Nghệ, P.12, Q. Gò Vấp';
    }
    
    public function getCompanyPhone(){
        return defined('COMPANY_PHONE') ? COMPANY_PHONE : '(08)66806108';
    }
    
    public function getCompanyHotline(){
        return defined('COMPANY_HOTLINE') ? COMPANY_HOTLINE : '0973513579';
    }
    
     public function getCompanyFax(){
        return defined('COMPANY_FAX') ? COMPANY_FAX : '(08)66806108';
    }
    
    public function getCompanyMail(){
        return defined('COMPANY_MAIL') ? COMPANY_MAIL : 'thehalfheart@gmail.com';
    }
    public function getObjectNameEmail(){
        return defined('OBJECT_NAME_EMAIL') ? OBJECT_NAME_EMAIL : '<en>Your orders</en><vi>Đơn đăt hàng của bạn</vi>';
    }
    
    public function getTitelMail(){
        return defined('COMPANY_TITLE_EMAIL') ? COMPANY_TITLE_EMAIL : '<en>Verify order information</en><vi>Xác nhận thông tin đặt hàng</vi>';
    }
    
    public function getTitleContact(){
        return defined('CONTACT') ? CONTACT : '<en>contact</en><vi>liên hệ</vi>';
    }
    
    
    
    
    
    /***************************************************************/
    /******************** DEFAULT PAGE******************************/
    /***************************************************************/
    public function getDefaultPageString(){
        return defined('SITE_PAGE_DEFAULT_STRING') ? SITE_PAGE_DEFAULT_STRING : 'trang-chu.html';
    }
    
    
    /***************************************************************/
    /*******************VARRIABLE PAGES*****************************/
    /***************************************************************/
    
    // active product page string route
    public function getActiveShopPageString(){
        return defined('SITE_PAGE_ACTIVE_SHOP_STRING') ? SITE_PAGE_ACTIVE_SHOP_STRING : 'active.html';
    }
    
    // index page string route
    public function getIndexPageString(){
        return defined('SITE_PAGE_DEFAULT_STRING') ? SITE_PAGE_DEFAULT_STRING : 'index';
    }
    
    // page page string route
    public function getPagePageString(){
        return defined('SITE_PAGE_PAGE_STRING') ? SITE_PAGE_PAGE_STRING : 'page';
    }
    
    
    // product page string route
    public function getProductPageString(){
        return defined('SITE_PAGE_PRODUCT_STRING') ? SITE_PAGE_PRODUCT_STRING : 'san-pham';
    }
    
    // product page string route
    public function getProductOrderPageString(){
        return defined('SITE_PAGE_PRODUCT_ORDER_STRING') ? SITE_PAGE_PRODUCT_ORDER_STRING : 'order';
    }
    
    //product contact
    public function getProductContactPageString(){
        return defined('SITE_PAGE_PRODUCT_CONTACT_STRING') ? SITE_PAGE_PRODUCT_CONTACT_STRING : 'lien-he.html';
    }
    
    // product list cart 
    public function getProductListCartPageString(){
        return defined('SITE_PAGE_PRODUCT_LIST_CART_STRING') ? SITE_PAGE_PRODUCT_LIST_CART_STRING : 'gio-hang';
    }
    
    
    // product search string 
    public function getProductPageSearchString(){
        return defined('SITE_PAGE_PRODUCT__SEARCH_STRING') ? SITE_PAGE_PRODUCT__SEARCH_STRING : 'search';
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
        return defined('SITE_LIMIT_RECORD') ? SITE_LIMIT_RECORD : 20;
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
    
    
    // number words of product title
    // 
    public function getNumberOfProductTitle(){
        return defined('PRODUCT_TITLE_NUMBER_DISPLAY') ? PRODUCT_TITLE_NUMBER_DISPLAY : 9;
    }
    /// yahoo sopport online
    
    public function getYahooSupport(){
        return defined('YAHOO_SUPPORT_ONLINE') ? YAHOO_SUPPORT_ONLINE : 'ngvancuong_thienduongmangtenem';
    }
    
    
    /***************************************************************/
    /******************LINK*********************/
    /***************************************************************/
    
    
    // using for display list cart and when user click order at product detail
    public function getLinkShowListCart(){
        return base_url() . Variable::getProductListCartPageString();
    }
    
    // using for acceess when user want to contact or order product
    public function getLinkOrderContact(){
        return base_url()  . Variable::getProductOrderPageString();
    }
    
    // search link
    public function getLinkSearch(){
        return base_url()  . Variable::getProductPageString() . '/' . Variable::getProductPageSearchString();
    }
    public function getLinkActive($code, $id){
        return base_url()  . Variable::getActiveShopPageString() . '?code='.$code . '&id='. $id;
    }
    
    
    // article page string route
    public function getArticlePageString(){
        return defined('SITE_PAGE_ARTICLE_STRING') ? SITE_PAGE_ARTICLE_STRING : 'articles';
    }
    
    // article search string 
    public function getArticlePageSearchString(){
        return defined('SITE_PAGE_ARTICLE__SEARCH_STRING') ? SITE_PAGE_ARTICLE__SEARCH_STRING : 'search';
    }
    
    public function cut_string($string, $num){
        $arr = explode(' ', $string);
        $total = count($arr);
        if ($total <= $num){
            return $string;
        }else{
            $str_tmp = '';
            for ($i = 0; $i < $num; $i++){
                if ($i == ($num - 1)){
                    $str_tmp .= $arr[$i] . ' ...';
                }else{
                    $str_tmp .= $arr[$i] . ' ';
                }
            }
            return $str_tmp;
        }
    }
}

?>