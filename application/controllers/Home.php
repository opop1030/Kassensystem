<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    private $data;

	public function __construct(){
		parent::__construct();
        if($this->session->login !== true)
        {
            redirect('home');
        }
	}

	public function index()
	{
		if($this->session->login === true){
			$userdata = array(
				'username' => $this->session->username
			);
		}
		else{
			$userdata = false;
		}

		$this->data['title'] = "Kassensystem Emma - Hauptseite";
		$this->data['content'] = "content/Home_view.php";
		$this->data['status'] = array(
			'shownavi' => true,
            'login' => $userdata
		);
		$this->data['special'] = null;
		$this->load->view('includes/content.php', $this->data);
	}
}