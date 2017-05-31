<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datahandler extends CI_Controller{

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
		if(!isset($userdata)){
			redirect('home');
		}
	}

	public function index()
	{
		$userdata = $this->getLoginData();
		$this->data['title'] = "Testseite - Template";
		$this->data['content'] = "content/DataHandler_view.php";
		$this->data['status'] = array(
			'shownavi' => true,
            'login' => $userdata
		);
		$this->data['special'] = null;
		$this->load->view('includes/content.php', $this->data);
	}

	public function show_bestellungen()
	{

	}

	public function show_lager()
	{

	}

	public function show_kunden()
	{

	}
}