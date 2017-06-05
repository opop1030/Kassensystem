<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ItemModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function getItemData($id){
        $q = $this
            ->db
            ->where("artikelnr", $id)
            ->limit(1)
            ->get("artikel");
        return $q->row(0);
    }

    public function addItem($id, $price, $amount){

    }

    public function deleteItem($id){

    }
}