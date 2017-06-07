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

    public function show_bestellungenDetail($id){
        if(!isset($id)){
            redirect('Datahandler/show_bestellungen');
        }
        else{
            $this->load->model("OrderModel");
            $result = $this->OrderModel->getOrderDetails($id);
            $tableheader=array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis');
            foreach($result as $entry){
                $this->table->add_row(array());
            }
            $this->setPageData("Detail&uuml;bersicht Bestellung Nr. ".$id, "content/DataListing_View.php", $tableheader, $this->table);
        }
    }

	public function show_lager()
	{
        $this->load->model("ItemModel");
        $tableheader=array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis');
        $result = $this->ItemModel->getAllItems();
        foreach($result as $entry){
            $deleteUrl = anchor('Datahandler/deleteItem/'.$entry["artikelnr"],'L&ouml;schen', 'class="btn btn-default"');
            $editUrl = anchor('Datahandler/editItem/'.$entry["artikelnr"], 'Editieren', 'class="btn btn-default"');
            $this->table->add_row(array($entry["artikelnr"], $entry["name"], $entry["bestand"], $entry["preis"], $editUrl, $deleteUrl));
        }
        $this->table->add_row(anchor('Datahandler/addItem','Hinzuf&uuml;gen', 'class="btn btn-default"'));
        $this->setPageData("Lager&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
	}

    public function refillItem()
    {
        if(!empty($this->input->post("scan")))
        {

        }
    }

    public function editItem($id)
    {

    }

    public function deleteItem($id)
    {

    }

	public function show_kunden()
    {
        $temp = $this->session->code;
        if (!$temp > 0 && !$temp <= 2) {
            redirect('home');
        }
        else
        {
            $this->load->model("CostumerModel");
            $result = $this->CostumerModel->getAllCostumers();
            foreach($result as $entry){
                $editUri = anchor("Datahandler/editCostumer/".$entry["fi_person"], "Editieren", "class='btn btn-default'");
                $deleteUri = anchor("Datahandler/deleteCostumer/".$entry["fi_person"], "L&ouml;schen", "class='btn btn-default'");
                $this->table->add_row(array($entry["name"], $entry["vname"], $entry["strasse"], $entry["hausnr"], $entry["plz"], $entry["ort"], $editUri, $deleteUri));
            }
            $this->table->add_row(anchor("Datahandler/addCostumer", "Hinzuf&uuml;gen", "class='btn btn-default'"));
            $tableheader=array("Name", "Vorname", "Strasse", "Hausnummer", "PLZ", "Ort");
            $this->setPageData("Kunden&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
        }
    }

    public function addCostumer(){

    }

    public function deleteCostumer($id){

    }

    public function editCostumer($id){

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