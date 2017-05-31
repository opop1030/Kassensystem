<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
    
    public function __construct(){
		parent::__construct();
	}

	public function verify($id, $pwd)
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

    public function register($id, $pwd, $email)
    {
        $array = array(
            'username' => $id,
            'email' => $email,
            'pwd' => $pwd,
            'active' => 0,
            'avatar' => 1
        );
        $q = $this->db->insert("member", $array);
        return $q;
    }

    public function showData($id){
        $q = $this->db->where("username", $id)->limit(1)->get("member");
        if($q->result() != null){
            return $q->row(0);
        }
        else{
            return false;
        }
    }

    public function unlock($id){

    }

    public function changeData($id, $dataArray){

    }

    public function addGame($id, $gameId){
        
    }

    public function addFriend($id, $friendId){

    }

    public function removeFriend($id, $friendId){

    }
}