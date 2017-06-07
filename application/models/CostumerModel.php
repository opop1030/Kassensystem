<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CostumerModel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function addCostumer($name, $vname){
        $qperson = $this
            ->db
            ->insert("person", array("id"=>null, "name"=>$name, "vname" =>$vname));
        if($qperson !== false){
            //suchen des letzten Eintrags
            $costumerId = $this
                ->db
                ->select("id")
                ->where("name",$name)
                ->where("vname", $vname)
                ->get("person")
                ->last_row(0);
            //einfügen des Kunden
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

    public function editCostumer($id, $dataArray)
    {

    }

    public function getAllCostumers(){
        $q = $this
            ->db
            ->select("kunde.id, person.name, person.vname, person.strasse, person.hausnr, person.plz, person.ort")
            ->join("person", "person.id = kunde.fi_person")
            ->get("kunde");
        return $q->result_array();
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