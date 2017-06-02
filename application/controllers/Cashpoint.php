<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Cashpoint bedeutet auf Englisch Kasse, daher der Name :)
class Cashpoint extends CI_Controller{

    private $data;

	private function getLoginData(){
		$userdata = null;
		if($this->session->login === true){
			$userdata = array(
				$this->session->login,
				$this->session->username,
				$this->session->code
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
		$this->data['title'] = "Kassensystem Emma - Kasse";
		$this->data['content'] = "content/Cashpoint_View.php";
		$this->data['status'] = array(
			'shownavi' => true,
            'login' => $userdata
		);
		$this->data['special'] = null;
		$this->load->view('includes/content.php', $this->data);
	}
}