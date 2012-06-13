<?php

class Image_controller extends CI_Controller {
    
    function process() {
        
        //if (User::isAccessAble($this->session->userdata('userID'), 'image/process')) {
            
            $str_config = $this->input->get('config');

            $config = unserialize(urldecode($str_config));
            
            $config['upload_path'] = realpath(config_item('upload_path')).'/images/'.$config['group_code'].'/';
            $config['source_image'] = $config['upload_path'].$config['source_image'];
            $config['new_image'] = $config['upload_path'].$config['new_image'];

            $this->load->library('image_lib', $config);

            if ($this->image_lib->resize())
                echo '[1]';
            else
                echo '[0]'.$this->image_lib->display_errors();
            
        //}
        //else {
            //echo '[0]'.lang('msg_not_granted_this_page');
        //}
        
    }
    
}