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

    public function addItem($id, $name, $kategorie, $price, $amount){
        $this->db->insert("artikel", array("artikelnr"=>$id, "name"=>$name, "fi_kategorie"=>$kategorie, "bestand"=>$amount, "preis"=>$price));
    }

    public function deleteItem($id){
        $this->db->delete("artikel", "artikelnr = ".$id);
    }

    public function isItemAvailable($id){
        $currendAmount = $this->getCurrendAmountById($id);
        if($currendAmount > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function getCurrendAmountById($id){
        $currendAmount = $this
            ->db
            ->select("bestand")
            ->where("artikelnr", $id)
            ->get("artikel")->row(0)->bestand;
        return $currendAmount;
    }

    public function setCurrendAmountById($id, $difference){
        $currendAmount = $this->getCurrendAmountById($id);
        $newAmount = $currendAmount + $difference;
        $this->db->where("artikelnr", $id)->set("bestand", $newAmount)->update("artikel");
    }
}