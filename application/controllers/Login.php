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
		$this->data['content'] = "content/Login_view.php";
		$this->data['status'] = array
		(
			'shownavi' => false,
            'login' => ""
		);
		$this->data['special'] = null;
		$this->load->view('includes/content.php', $this->data);
	}

    public function userlogin()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username', 'required');
        $this->form_validation->set_rules('password','Password', 'required|min_length[4]');
        if($this->form_validation->run() !== false){
            $this->load->model("EmployeeModel");
            $result = $this->EmployeeModel->verify($this->input->post('username'), $this->input->post('password'));
            if(isset($result)&& $result !== false){
                $userdata = array(
                    "login" => true,
                    "username" => $result->name,
                    "code" => $result->status
                );
                $this->session->set_userdata($userdata);
                redirect("home");
            }
            else{
                $this->index();
            }
        }
        else{
            $this->index();
        }
    }
}