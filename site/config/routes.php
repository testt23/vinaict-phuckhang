<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller'] = "index";
$route['controller_suffix'] = '_controller';
$route['404_override'] = '';
$route['directory'] = '';
// index page

$route['^'.Variable::getActiveShopPageString()] =  'product/active_cat';

$route['^'.Variable::getIndexPageString().'/(:num)'] =  'index/page/$1';

// order
$route['^'.Variable::getProductListCartPageString().''] =  'product/prod_list_cart';
        //$route['^product'] =  'product/prod_list_cart';
$route['^'.Variable::getProductOrderPageString().''] =  'product/prod_order_contact';
        //$route['^product/list-cart'] =  'product/prod_list_cart';

$route['^'.Variable::getProductPageString().'/'.Variable::getProductPageSearchString().''] =  'product/prod_search';
//$route['^products/search'] =  'product/prod_search';

$route['^'.Variable::getProductPageString().'/update_shop/(:num)/(:num)'] =  'product/update_shopping/$1/$2';
$route['^'.Variable::getProductPageString().'/delete_shop/(:num)'] =  'product/delete_shopping/$1';

// contact
$route['^'.Variable::getProductContactPageString().''] =  'product/prod_contact';

$route['^'.Variable::getProductPageString().'/(.+)/([a-zA-Z0-9-_]+).html'] =  'product/prod_detail/$2';
$route['^'.Variable::getProductPageString().'/(.+).html'] =  'product/prod_detail/$1';
$route['^'.Variable::getProductPageString().'/([a-zA-Z0-9-_]+)/(:num)'] =  'product/prod_list_by_category/$1/$2';
$route['^'.Variable::getProductPageString().'/(.+)/([a-zA-Z0-9-_]+)/(:num)'] =  'product/prod_list_by_category/$2/$3';
$route['^'.Variable::getProductPageString().'/(.+)/([a-zA-Z0-9-_]+)'] =  'product/prod_list_by_category/$2';
$route['^'.Variable::getProductPageString().'/([a-zA-Z0-9-_]+)'] =  'product/prod_list_by_category/$1';


$route['^([a-zA-Z0-9-_]+).html'] =  'page/the_page/$1';
$route['^([a-zA-Z0-9-_]+).htm'] =  'page/the_page/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */