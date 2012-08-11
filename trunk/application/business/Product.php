<?php

class Product extends Product_model {

    function __construct() {
        parent::__construct();
    }

    public function getList($filter = array()) {
        $product = new Product();
        $product->addJoin(new Image(), 'LEFT', 'image img', 'img.id = product.id_def_image');
        $product->addSelect();
        $product->addSelect('product.*, img.file picture');
        // add where condition
        $product->addWhereSearch($filter);
        // order access
        $order = 'id';
        if (isset($filter['sort_by']) && $filter['sort_by']) {
            switch ($filter['sort_by']) {
                case '1': $order = 'id';
                    break;
                case '2': $order = 'code';
                    break;
                case '3': $order = 'name';
                    break;
                case '4': $order = 'price';
                    break;
            }
        }
        if (isset($filter['limit']) && $filter['limit'] && isset($filter['start']) && is_numeric($filter['start']))
            $product->limit($filter['start'] . ',' . $filter['limit']);


        $product->orderBy(getI18nRealStringSql("product." . $order));
        $product->find();
        return $product;
    }

    public function getTotalRecord($filter = array()) {
        $product = new Product();
        $product->addJoin(new Image(), 'LEFT', 'image img', 'img.id = product.id_def_image');
        $product->addSelect();
        $product->addSelect('count(product.id) as total');
        $product->addWhereSearch($filter);
        $product->find();
        $product->fetchFirst();
        return $product->total;
    }

    public function addWhereSearch( $filter = array()) {
        $this->addWhere('product.is_deleted = ' . IS_NOT_DELETED);

        if (isset($filter['code']) && $filter['code'])
            $this->addWhere("product.code LIKE '%" . $filter['code'] . "%'");

        if (isset($filter['name']) && $filter['name'])
            $this->addWhere("product.name LIKE '%" . $filter['name'] . "%'");

        if (isset($filter['keywords']) && $filter['keywords'])
            $this->addWhere("FIND_IN_SET(product.keywords, '" . $filter['keywords'] . "')");


        if (isset($filter['id_prod_category']) && $filter['id_prod_category'])
            $this->addWhere('product.id_prod_category = ' . $filter['id_prod_category']);

        if (isset($filter['is_featured']) && $filter['is_featured'])
            $this->addWhere('product.is_featured = 1');

        if (isset($filter['disable_yes']) && $filter['disable_yes'] && (!isset($filter['disable_no']) or !$filter['disable_no']))
            $this->addWhere('product.is_disabled = 1');
        else if (isset($filter['disable_no']) && $filter['disable_no'] && (!isset($filter['disable_yes']) or !$filter['disable_yes']))
            $this->addWhere('product.is_disabled = 0');

        if (isset($filter['currency']) && $filter['currency'])
            $this->addWhere("product.currency = '" . $filter['currency'] . "'");

        if (isset($filter['price']) && $filter['price'] != '' && isset($filter['option_price'])) {
            $sosanh_price = '';
            switch ($filter['option_price']) {
                case 2: $sosanh_price = '>';
                    break;
                case 3: $sosanh_price = '<';
                    break;
                case 4: $sosanh_price = '=';
                    break;
                default: $sosanh_price = '';
            }

            if ($sosanh_price != '') {
                $this->addWhere('product.price ' . $sosanh_price . ' ' . $filter['price'] * 1);
            }
        }
    }

    function validateInput() {

        $this->code = strtoupper(trim($this->code));
        $this->name = trim($this->name);
        $this->short_description = trim($this->short_description);
        $this->description = trim($this->description);
        $this->price = trim($this->price);
        $this->currency = trim($this->currency);
        $this->keywords = trim(trim($this->keywords), ',');
        $this->link = trim($this->link);

        $lang = Language::getList();

        if (!$this->code || $this->code == "") {
            MessageHandler::add(lang('err_empty_product_code'), MSG_ERROR, MESSAGE_ONLY);
        } elseif ($this->isExistedByCode()) {
            MessageHandler::add(lang('err_product_code_exists'), MSG_ERROR, MESSAGE_ONLY);
        }

        if ($this->name == "") {
            MessageHandler::add(lang('err_empty_product_name'), MSG_ERROR, MESSAGE_ONLY);
        }

        if ($this->link == "") {
            MessageHandler::add(lang('err_empty_product_link'), MSG_ERROR, MESSAGE_ONLY);
        } elseif (!validate_uri($this->link, URI_PATTERN, PRODUCT_URI_PREFIX, PRODUCT_URI_SUFFIX)) {
            MessageHandler::add(lang('err_invalid_link'), MSG_ERROR, MESSAGE_ONLY);
        }

        if (!$this->id_prod_category) {
            MessageHandler::add(lang('err_empty_product_category'), MSG_ERROR, MESSAGE_ONLY);
        }

        if (!$this->id_primary_prod_category) {
            MessageHandler::add(lang('err_empty_primary_product_category'), MSG_ERROR, MESSAGE_ONLY);
        }

        while ($lang->fetchNext()) {

            if (strlen(getI18n($this->name, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add(lang('err_product_name_too_long') . ': ' . lang('msg_please_check') . ' "' . getI18n($this->name, $lang->code) . '"', MSG_ERROR, MESSAGE_ONLY);
            }

            if (strlen(getI18n($this->short_description, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add(lang('err_short_desc_too_long') . ': ' . lang('msg_please_check') . ' "' . getI18n($this->short_description, $lang->code) . '"', MSG_ERROR, MESSAGE_ONLY);
            }
        }

        return MessageHandler::countError() > 0 ? false : true;
    }

    function isExistedByCode() {
        $product = new Product();

        if ($this->id)
            $product->addWhere("id <> $this->id");

        $product->addWhere("code = '$this->code'");
        $product->addSelect();
        $product->addSelect("COUNT(*) count");
        $product->find();
        $product->fetchNext();

        return $product->count > 0 ? true : false;
    }

    function generateCode() {

        if ($this->id_primary_prod_category) {
            $prod_category = new ProductCategory();
            $prod_category->get($this->id_primary_prod_category);

            $prod = new Product();
            $prod->addSelect();
            $prod->addSelect('COUNT(*) count');
            $prod->find();
            $prod->fetchNext();

            $this->code = $prod_category->code . sprintf('%05d', ($prod->count + 1));
        }
    }

    function toggleStatus() {
        $this->is_disabled = $this->is_disabled == IS_DISABLED ? "'" . IS_NOT_DISABLED . "'" : IS_DISABLED;
        $this->update();
    }

    function delete() {

        $this->is_deleted = 1;
        $this->code = appendIdtoName($this->id, $this->code);
        $this->name = appendIdtoName($this->id, $this->name);
        $this->update();
    }

    function getPictures() {

        if (!$this->id || !$this->id_prod_image || trim($this->id_prod_image) == '')
            return false;

        $img = new Image();
        $img->addJoin(new ImageGroup());
        $img->addWhere("image.id IN ($this->id_prod_image)");
        $img->addSelect();
        $img->addSelect('image.*, CONCAT(image_group.code, \'/\', image.file) image_path');
        $img->find();
        return $img;
    }

    function deletePicture($id) {

        $image = new Image();
        $image->get($id);
        $image->delete();
        $arr_img_id = explode(",", $this->id_prod_image);

        $found = array_search($id, $arr_img_id);

        if ($this->id_def_image == $arr_img_id[$found]) {
            $this->id_def_image = '0';
        }

        unset($arr_img_id[$found]);

        if (count($arr_img_id) > 0)
            $this->id_prod_image = implode(',', $arr_img_id);
        else
            $this->id_prod_image = '';

        $this->update();
    }

    function deleteAllPictures() {

        $image = new Image();
        $image->addWhere("id IN ($this->id_prod_image)");
        $image->addSelect();
        $image->addSelect('id');
        $image->find();

        while ($image->fetchNext()) {

            $img = new Image();
            $img->get($image->id);
            $img->delete();
        }

        $this->id_prod_image = '';
        $this->id_def_image = 0;
        $this->update();
    }

    function addPictureById($id_picture = null) {

        if ($id_picture) {

            $image = new Image();

            if ($image->get($id_picture)) {

                if (!$this->id_prod_image || $this->id_prod_image == '')
                    $this->id_prod_image = $image->id;
                else {
                    $pictures = explode(',', $this->id_prod_image);

                    if (!in_array($id_picture, $pictures))
                        $this->id_prod_image .= ",$image->id";
                }

                $this->update();

                if ($image->name != $this->code || $image->description != getI18n($this->name)) {
                    $image->name = $this->code;
                    $image->description = getI18n($this->name);
                    $image->update();
                }
            }
        }
    }

    function addPicture($field = 'image') {

        $image = new Image();

        if ($image->upload($field, IMG_PRODUCT_CODE, array('name' => $this->code, 'description' => getI18n($this->name)))) {

            if (!$this->id_prod_image || $this->id_prod_image == '')
                $this->id_prod_image = $image->id;
            else
                $this->id_prod_image .= ",$image->id";

            $this->update();

            return true;
        }
        else {
            return false;
        }
    }

    function getProductByID($id) {
        $pro_det = new Product();
        $pro_det->get($id);
        return $pro_det;
    }

}
