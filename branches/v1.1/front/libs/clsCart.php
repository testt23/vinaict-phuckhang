<?php
class clsCart {
    var $_masanpham;
    var $_tensanpham;
    var $_image;
    var $_soluong;
    var $_giasanpham;
    function __construct() {
        
    }
    public function getMasanpham(){
        return $this->_masanpham;
    }
    public function setMasanpham($value){
        $this->_masanpham = $value;
    }
    public function getTensanpham(){
        return $this->_tensanpham;
    }
    public function setTensanpham($value){
        $this->_tensanpham = $value;
    }
    public function getImage(){
        return $this->_image;
    }
    public function setImage($value){
        $this->_image = $value;
    }
    public function getSoluong(){
        return $this->_soluong;
    }
    public function setSoluong($value){
        $this->_soluong = $value;
    }
    public function getGiasanpham(){
        return $this->_giasanpham;
    }
    public function setGiasanpham($value){
        $this->_giasanpham = $value;
    }
    public function getTongtien(){
        return $this->getSoluong() * $this->getGiasanpham();
    }
}