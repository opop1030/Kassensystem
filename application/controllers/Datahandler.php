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

    private function setPageData($titlesufix, $methodInfo = null)
    {
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - ".$titlesufix;
        $this->data['content'] = "content/DataHandler_view.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
        $this->data['special'] = $methodInfo;
        $this->load->view('includes/content.php', $this->data);
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
		$this->setPageData("Hauptseite");
	}

	public function show_bestellungen()
	{
        $this->setPageData("Hauptseite", "bestellungen");
	}

	public function show_lager()
	{
        $this->setPageData("Hauptseite", "lager");
	}

	public function show_kunden()
	{
        $this->setPageData("Hauptseite", "kunden");
	}
}