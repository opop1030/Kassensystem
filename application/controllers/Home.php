<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    private $data;

    private function getLoginData(){
        $userdata = null;
        if($this->session->login === true){
            $userdata = array(
                true,
                $this->session->username,
            );
        }
        return $userdata;
    }

    public function __construct(){
		parent::__construct();
        if($this->session->login !== true)
        {
            redirect('login');
        }
	}

	public function index()
	{
		$userdata = $this->getLoginData();
		$this->data['title'] = "Kassensystem Emma - Hauptseite";
		$this->data['content'] = "content/Home_View.php";
		$this->data['status'] = array(
			'shownavi' => true,
            'login' => $userdata
		);
		$this->data['special'] = null;
		$this->load->view('includes/content.php', $this->data);
	}
}