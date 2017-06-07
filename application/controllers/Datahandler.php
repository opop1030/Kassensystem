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
        $this->data['header'] = $titleaddon;
        $this->data['content'] = $view;
        $template = array(
            'table_open' => '<table class="table table-bordered table-hover">'
        );
        $this->table->set_template($template);
        $this->table->set_heading($tableheader);
        $this->data['tabledata'] = $this->table->generate($tabledata);
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
        $this->data['special'] = null; //aufgrund von strukturfehler noch notwendig
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
        $this->load->model("OrderModel");
        $result = $this->OrderModel->getAllOrders();
        $tableheader=array('Kundenname', 'Kundenvorname', 'Bestelldatum');
        foreach($result as $entry){
            $this->table->add_row(array($entry["name"], $entry["vname"], $entry["datum"], anchor("Datahandler/show_bestellungenDetail/".$entry["id"],'Details','class="btn btn-default"')));
        }
        $this->setPageData("Bestellungs&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
	}

	public function show_lager()
	{
        $tableheader=array();
        $this->setPageData("Lager&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
	}

	public function show_kunden()
    {
        $temp = $this->session->code;
        if (!$temp > 0 && !$temp <= 2) {
            redirect('home');
        }
        else
        {
            $tableheader=array();
            $this->setPageData("Kunden&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
        }
    }

	public function show_mitarbeiter()
	{
        if($this->session->code != 2){
            redirect('home');
        }
        else
        {
            $tableheader=array();
            $this->setPageData("Mitarbeiter&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
        }
	}
}