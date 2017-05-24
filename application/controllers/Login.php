<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    private $data;

	public function __construct()
	{
		parent::__construct();
		if($this->session->login === true)
		{
			redirect('home');
		}
	}

	public function index()
	{
		$this->data['title'] = "Testseite - Template";
		$this->data['content'] = "content/Home_view.php";
		$this->data['status'] = array
		(
			'navi' => true,
            'login' => ""
		);
		$this->load->view('includes/content.php', $this->data);
	}
}