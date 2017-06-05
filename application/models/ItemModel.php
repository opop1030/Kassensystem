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
        if($q->result() !== null) {
            return $q->row(0);
        }
        else{
            return null;
        }
    }

    public function addItem($id, $price, $amount){
        $q = $this
            ->db
            ->insert("artikel", array("artikelnr"=>$id, ""));
    }

    public function deleteItem($id){

    }
}