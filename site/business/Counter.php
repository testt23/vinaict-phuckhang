<?php

class Counter extends Counter_model {

    function __construct() {
        parent::__construct();
    }

    function add() {
        $counter = new Counter();
        
        if (!$this->session->userdata('counter')){

            $counter = $counter->select();
            
            if($counter->countRows() > 0){
                
                $counter->fetchNext();

                $counter->count = $counter->count + 1;
                $counter->update();
                
            }else {
                
                $counter->count = 1;
                $counter->insert();
                
            }
            $this->session->set_userdata('counter',$counter->id);
        }
            $counter = $counter->select();
        
            $counter->fetchNext();
                
        return $counter->count;
    }

    function select() {

        $counter = new Counter();

        $counter->addSelect();
        $counter->addSelect('counter.*');
        $counter->find();

        return $counter;
    }

}
