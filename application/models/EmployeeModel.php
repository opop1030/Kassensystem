<?php defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function verify($name, $pwd)
    {
        $q = $this
            ->db
            ->join("person", "person.id = angestellte.fi_person")
            ->where("person.name", $name)
            ->where("angestellte.passwort", sha1($pwd))
            ->limit(1)
            ->get("angestellte");
        if ($q->result() != null) {
            return $q->row(0);
        } else {
            return false;
        }
    }

    public function getEmployeeByName($name)
    {
        $q = $this
            ->db
            ->select("angestellte.id")
            ->join("person", "person.id = angestellte.fi_person")
            ->where("person.name", $name)
            ->limit(1)
            ->get("angestellte");

        return $q->result_array()[0]["id"];
    }

    public function getAllEmployees(){
        $q = $this->db->select("person.name, person.vname, angestellte.fi_person, angestellte.gehalt")->join("person","person.id = angestellte.fi_person")->get("angestellte");
        return $q->result_array();
    }

    public function create($name, $pwd)
    {
        //hier wird ein neuer angestellter eingefügt, allerdings ohne brechtigungen und ohne gehalt
        //weitere infos werden auch fürs erste nicht nötig sein
        //Schritt 1 person erzeugen
        //Schritt 2 ID raussuchen
        //Schritt 3 Mitarbeiter schreiben, mit berechtigung 0
    }

    public function delete($employeeId)
    {
        $select_q = $this
            ->db
            ->where("id", $employeeId)
            ->where_not_in("rechte", 2)
            ->get("angestellte");
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
}