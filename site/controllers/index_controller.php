<?php

	class Index_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
		}

		function index(){
                    
                    $product = new Product();
                    $info = $product->getNewProduct();
                    
                    // Menu 
                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    Menu::getMenuTree($array_menus, $filter);
                    // end menu
                    
                    
                    $data['selected'] = 'home';
                    $data['product']  = $info['product'];
                    $data['paging']   = $info['paging'];
                    $data['content']  = 'index';
                    $data['array_menus'] = $array_menus;
                    
                    $data['title_page'] = getI18n(FO_META_OVERALL_TITLE);
                    $data['description'] = getI18n(FO_META_DESCRIPTION);
                    $data['keywords'] = FO_META_KEYWORDS;
                    
                    $this->load->view('temp', $data);
		}

                
                public function switch_currency($code_currency = NULL){
                    
                    $currency = Currency::getCurrencyByCode($code_currency);
                    $currency->fetchNext();
                    $curr_array = Array(
                        'code'  =>  $currency->code,
                        'rate'  =>  $currency->rate,
                        'id'    =>  $currency->id
                    );
                    $this->session->set_userdata('currency', $curr_array);
                    redirect($this->session->userdata('lang_url'));
                    
                }
                
                public function sitemap(){
                    // Menu 
                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    Menu::getMenuTree($array_menus, $filter);
                    // end menu
                    
                    @$sitemaps = file_get_contents(base_url().'sitemap.html');
                    
                    $sitemap = "";
                    $temp = explode('<table', $sitemaps);
                    
                    for($i=1; $i<count($temp); $i++){
                        $sitemap .= '<table '.trim($temp[$i]).' ';
                    }
                    
                    $temp = explode('<div id="footer">', $sitemap);
                    
                    $sitemap = "";
                    for($i=0; $i<count($temp)-1; $i++){
                        $sitemap .= trim($temp[$i]).'';
                    }
                    $sitemap = str_replace('Cửa Hàng Dát Vàng Phúc Khang - ','',$sitemap);
                    $data['sitemap'] = $sitemap;
                    $data['selected'] = '';
                    $data['content']  = 'site_map';
                    $data['array_menus'] = $array_menus;
                    
                    $data['title_page'] = lang('title_home_page');
                    $data['description'] = getI18n(FO_META_DESCRIPTION);
                    $data['keywords'] = FO_META_KEYWORDS;
                    
                    $this->load->view('temp', $data);
                }
	}
