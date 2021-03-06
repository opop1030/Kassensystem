<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    private $data;

	public function __construct(){
		parent::__construct();
        if($this->session->login !== true)
        {
            redirect('login');
        }
	}

	public function index()
	{
		$this->data['title'] = "TeKassensystem Emma - Logout";
		$this->data['content'] = "content/Logout_View.php";
		$this->data['status'] = array(
			'shownavi' => false,
            'login' => array(false, "", 0)
		);
		$this->data['special'] = 'login';
        $this->session->sess_destroy();
		$this->load->view('includes/content.php', $this->data);
	}
}