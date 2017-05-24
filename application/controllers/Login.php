<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    private $data;

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if($this->session->login === true){
			$userdata = array(
				true,
				$this->session->username,
			);
		}
		else{
			$userdata = false;
		}

		$this->data['title'] = "Testseite - Template";
		$this->data['content'] = "content/Home_view.php";
		$this->data['status'] = array(
			'navi' => true,
            'login' => $userdata
		);
		$this->load->view('includes/content.php', $this->data);
	}
}