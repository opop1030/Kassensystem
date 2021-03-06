<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CostumerModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function addCostumer($name, $vname, $adress, $hanr, $plz, $ort, $tel=0, $email=""){
        $qperson = $this
            ->db
            ->insert("person", array("id"=>null, "name"=>$name, "vname" =>$vname, "strasse" => $adress, "hausnr"=>$hanr, "plz" => $plz, "ort"=>$ort, "tel"=>$tel, "email"=>$email));
        if($qperson !== false){
            //suchen des letzten Eintrags
            $costumerId = $this
                ->db
                ->select("id")
                ->where("name",$name)
                ->where("vname", $vname)
                ->get("person")
                ->last_row()->id;
            //einf�gen des Kunden
            $this->db->insert("kunde", array("id" => null, "fi_person"=>$costumerId));
        }
    }

    public function removeCostumer($id){
        $select_q = $this
            ->db
            ->where("id", $id)
            ->get("kunde");
        if($select_q->result() != null){
            $personId = $select_q->row(0)->fi_person;
            $del_q = $this
                ->db
                ->where("id", $personId)
                ->delete("person");
            return $del_q;
        }
        else{
            return false;
        }
    }

    public function editCostumer($id, $name, $vname, $strasse, $hausnr, $plz, $ort, $tel, $email)
    {
        $this->
        db->
        where("kunde.id", $id)->
        join("kunde","person.id = kunde.fi_person")->
        set("name",$name)->
        set("vname",$vname)->
        set("strasse",$strasse)->
        set("hausnr",$hausnr)->
        set("plz",$plz)->
        set("ort",$ort)->
        set("tel",$tel)->
        set("email",$email)->
        update("person");
    }

    public function getAllCostumers(){
        $q = $this
            ->db
            ->select("kunde.id, kunde.fi_person, person.name, person.vname, person.strasse, person.hausnr, person.plz, person.ort")
            ->join("person", "person.id = kunde.fi_person")
            ->get("kunde");
        return $q->result_array();
    }

    public function getAllCostumersForDropDown(){
        $q = $this
            ->db
            ->select("kunde.id, person.name, person.vname")
            ->join("person", "person.id = kunde.fi_person")
            ->get("kunde");
        return $q->result();
    }

    public function getCostumerByName($name){
        $q = $this
            ->db
            ->select("kunde.id, person.name, person.vname")
            ->join("person", "person.id = kunde.id")
            ->where("person.name", $name)
            ->limit(1)
            ->get("kunde");
        return $q->row(0);
    }
}