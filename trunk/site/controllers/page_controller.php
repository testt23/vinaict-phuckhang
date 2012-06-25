<?php

	class Page_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
			// Your own construction code here
		}
                
                public function index(){
                    
                }
                public function the_page($link = ''){
                    if ($link != ''){
                        $Webpage = new WebPage();
                        $info = $Webpage->getPage($link);
                        if (empty($info) || $info->countRows() == 0){
                            redirect('index');
                        }
                        $data['page'] = $info;
                        $data['content'] = 'webpage';
                        $this->load->view('temp', $data);
                    }else{
                        redirect('index');
                    }
                }
                

	}
