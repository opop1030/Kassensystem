<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    private $data;

	public function __construct()
	{
		parent::__construct();
		if(isset($this->session->login) === true)
		{
			redirect('home');
		}
	}

	public function index()
	{
		$this->data['title'] = "Testseite - Template";
		$this->data['content'] = "content/Login_view.php";
		$this->data['status'] = array
		(
			'shownavi' => false,
            'login' => ""
		);
		$this->data['special'] = null;
		$this->load->view('includes/content.php', $this->data);
	}
}