<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datahandler extends CI_Controller{

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

    private function setPageData($titleaddon, $view, $tableheader, $tabledata)
    {
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - ".$titleaddon;
        $this->data['content'] = $view;
        $this->data['tableheader'] = $tableheader;
        $this->data['tabledata'] = $this->table->generate($tabledata);
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
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
		redirect('home');
	}

	public function show_bestellungen()
	{
        $this->setPageData("Bestellungs&uuml;bersicht", "content/");
	}

	public function show_lager()
	{
        $this->setPageData("Lager&uuml;bersicht", "lager");
	}

	public function show_kunden()
	{
        $temp = $this->session->code;
        if(!$temp > 0 && !$temp <= 2){
            redirect('home');
        }
        $this->setPageData("Kunden&uuml;bersicht", "kunden");
	}

	public function show_mitarbeiter()
	{
        if($this->session->code != 2){
            redirect('home');
        }
		$this->setPageData("Mitarbeiter&uuml;bersicht", "mitarbeiter");
	}
}