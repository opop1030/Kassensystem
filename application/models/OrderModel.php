<?php defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    private function getLastOrder(){
        $q = $this
            ->db
            ->get("bestellung");
        return $q->last_row("id");
    }

    public function addOrder($itemList, $idCostumer, $idEmployee){
        $qOrder = $this
            ->db
            ->insert("bestellung",array("id"=>null, "fi_kunde"=>$idCostumer, "fi_angestellter"=>$idEmployee));
        if($qOrder == true) {
            $idList = array();
            foreach ($itemList as $item) {
                array_push($idList, array($item["id"],$item["amount"]));
            }
            $orderId = $this->getLastOrder();
            $error = false;
            foreach ($idList as $item) {
                $qItemInsert = $this
                    ->db
                    ->insert("bestellpositionen", array("id_fi_bestellung"=>$orderId, "id_fi_artikel"=>$item[0], "menge"=>$item[1]));
                if($qItemInsert == false){
                    $error = true; //Fehler ist passiert...
                }
            }
            if($error === false) {
                return true;
            }
            else{
                return $error;
            }
        }
        else{
            return false; //nicht erfolgreich!
        }
    }

    public function getAllOrders(){

    }
}