<?php

class Dashboard_controller extends CI_Controller {

    function callFunction() {
        
        $objectfunction = $this->input->get('FUNC');
        $val_num = $this->input->get('VAL_NUM');
        
        $agrs = array();
        for($i=0; $i<$val_num; $i++){
                switch($this->input->get('VAL'.$i)){
                        case 'null':
                                $agrs[] = NULL;
                                break;
                        case 'true':
                                $agrs[] = TRUE;
                                break;
                        case 'false':
                                $agrs[] = FALSE;
                                break;
                        default:
                                $agrs[] = $this->input->get('VAL'.$i, false);
                }
        }

        $val = new JqueryValidator();
        echo $val->callFunction($objectfunction, $agrs);
        die();
        
    }
    
}

