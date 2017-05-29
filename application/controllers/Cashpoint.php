<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Cashpoint bedeutet auf Englisch Kasse, daher der Name :)
class Cashpoint extends CI_Controller{

    private $data;

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if($this->session->login === true){
			$userdata = array(
				false,
				$this->session->username,
			);
		}
		else{
			$userdata = false;
		}

		$this->data['title'] = "Testseite - Template";
		$this->data['content'] = "content/Cashpoint_view.php";
		$this->data['status'] = array(
			'shownavi' => true,
            'login' => $userdata
		);
		$this->load->view('includes/content.php', $this->data);
	}
}