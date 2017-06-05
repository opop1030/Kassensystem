<?php defined('BASEPATH') OR exit('No direct script access allowed');

class StorageModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function setAmount($id, $newAmount){
        $this->db->where("artikelnr", $id)->set("menge", $newAmount)->update("artikel");
    }
}