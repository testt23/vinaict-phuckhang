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

$route['^index/(:num)'] =  'index/page/$1';


// order
$route['^list-cart'] =  'product/prod_list_cart';
$route['^order-contact'] =  'product/prod_order_contact';

//product page
$route['^products/search/(:num)'] =  'product/prod_search/$1';
$route['^products/search'] =  'product/prod_search';
$route['^products/contact'] =  'product/prod_order_contact';
$route['^products/update_shop/(:num)/(:num)'] =  'product/update_shopping/$1/$2';
$route['^products/delete_shop/(:num)'] =  'product/delete_shopping/$1';
$route['^products/(.+)/([a-zA-Z0-9-_]+).html'] =  'product/prod_detail/$2';
$route['^products/(.+).html'] =  'product/prod_detail/$1';
$route['^products/([a-zA-Z0-9-_]+)/(:num)'] =  'product/prod_list_by_category/$1/$2';
$route['^products/(.+)/([a-zA-Z0-9-_]+)/(:num)'] =  'product/prod_list_by_category/$2/$3';
$route['^products/(.+)/([a-zA-Z0-9-_]+)'] =  'product/prod_list_by_category/$2';
$route['^products/([a-zA-Z0-9-_]+)'] =  'product/prod_list_by_category/$1';


$route['^([a-zA-Z0-9-_]+).html'] =  'page/the_page/$1';
$route['^([a-zA-Z0-9-_]+).htm'] =  'page/the_page/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */