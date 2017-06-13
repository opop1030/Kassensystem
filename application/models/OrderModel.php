<?php defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    private function getLastOrder(){
        $q = $this
            ->db
            ->get("bestellung");
        return $q->last_row()->id;
    }

    private function checkItemExists($idItem, $idOrder)
    {
        $q = $this->db->where("id_fi_bestellung",$idOrder)->where("id_fi_artikel", $idItem)->get("bestellpositionen");
        if($q->row(0) !== null){
            return true;
        }
        else{
            return false;
        }
    }

    public function addOrder($itemList, $idCostumer, $idEmployee){
        $qOrder = $this
            ->db
            ->insert("bestellung",array("id"=>"NULL", "fi_kunde"=>$idCostumer, "fi_angestellter"=>$idEmployee, "datum"=>"NOW()"/*mdate("%d-%m-%Y %H:%i:%s", now())*/), FALSE);
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
        $q = $this
            ->db
            ->select("person.name, person.vname, bestellung.datum, bestellung.id")
            ->join("kunde", "kunde.id = bestellung.fi_kunde")
            ->join("person", "kunde.fi_person = person.id")
            ->get("bestellung");
        return $q->result_array();
    }

    //wird für cancel und abschliessen einer Order genutzt
    public function deleteOrder($id)
    {
        $this->db->where("id_fi_bestellung", $id)->delete("bestellpositionen");
        $this->db->where("id", $id)->delete("bestellung");
    }

    public function changeAmount($idOrder, $idItem, $newAmount){
        $this->db->where("id_fi_bestellung", $idOrder)->where("id_fi_artikel", $idItem)->set("menge", $newAmount)->update("bestellpositionen");
    }

    public function addItemToOrder($idOrder, $idArticle, $amount)
    {
        if($this->checkItemExists($idArticle, $idOrder) === true)
        {
            $this->db->where("id_fi_artikel", $idArticle)->where("id_fi_bestellung", $idOrder)->set("menge", $amount)->update("bestellpositionen");
        }
        else
        {
            $this->db->set("id_fi_bestellung", $idOrder)->set("id_fi_artikel",$idArticle)->set("menge", $amount)->insert("bestellpositionen");
        }
    }

    public function deleteItemFromOrder($idOrder, $idItem)
    {
        $this->db->where("id_fi_artikel", $idItem)->where("id_fi_bestellung", $idOrder)->delete("bestellpositionen");
    }

    public function getOrderDetails($id)
    {
        $q = $this
            ->db
            ->select("artikel.artikelnr, artikel.name, artikel.preis, bestellpositionen.menge")
            ->join("bestellung", "bestellpositionen.id_fi_bestellung = bestellung.id")
            ->join("artikel", "bestellpositionen.id_fi_artikel = artikel.artikelnr")
            ->where("bestellung.id", $id)
            ->get("bestellpositionen");
        return $q->result_array();
    }
}