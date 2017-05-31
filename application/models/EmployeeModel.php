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
            ->where("username", $id)
            ->where("pwd", sha1($pwd))
            ->limit(1)
            ->get("member");
        if ($q->result() != null) {
            return $q->row(0);
        } else {
            return false;
        }
    }
}