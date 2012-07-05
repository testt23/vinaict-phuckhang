<?php
class ShoppingCart {

    function __construct() {
        Session::init();
    }
    public function create(){
        if (!isset($_SESSION['giohang'])){
            Session::set('giohang', '');
        }
    }
    public function addCart($masanpham, $tensanpham, $giasanpham, $image){
        $this->create();
        $cart = new clsCart();
        $ListCart = Session::get('giohang');   
        $flag = 'yes';
        if ($ListCart != ''){
            $total = count($ListCart);    
            for ($i = 0; $i < $total; $i++){
                if ($ListCart[$i]->getMasanpham() == $masanpham){
                    $ListCart[$i]->setSoluong($ListCart[$i]->getSoluong() + 1);
                    $flag = 'no';
                    break;
                }
            }    
        }
        if ($flag == 'yes'){
            $cart->setMasanpham($masanpham);
            $cart->setTensanpham($tensanpham);
            $cart->setGiasanpham($giasanpham);
            $cart->setImage($image);
            $cart->setSoluong(1);
            $ListCart[] = $cart;
        }
        Session::set('giohang', $ListCart);
    }  
    public function deleteCart($masanpham){
        $ListCart = Session::get('giohang');
        $ListNew = '';
         if ($ListCart != ''){
            $total = count($ListCart);    
            for ($i = 0; $i < $total; $i++){
                if ($ListCart[$i]->getMasanpham() != $masanpham){
                    $ListNew[] = $ListCart[$i];
                }
            }    
        }
        Session::set('giohang', $ListNew);
    }
    public function listCart(){
        return Session::get('giohang');
    }
    public function clearAll(){
        Session::set('giohang', '');
    }
    public function isHave(){
        return Session::isHave('giohang');
    }
}