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

    private function setPageData($titleaddon, $view, $tableheader, $tabledata, $datazusatz="")
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
        $this->data['special'] = $datazusatz;
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
            $this->table->add_row(
                array(
                    $entry["name"], $entry["vname"], $entry["datum"], anchor("Datahandler/show_bestellungenDetail/".$entry["id"],'Details','class="btn btn-default"'),
                    anchor("Datahandler/finishOrder/".$entry["id"], "Abschliessen!", "class='btn btn-default'"),
                    anchor("Datahandler/cancelOrder/".$entry["id"], "Canceln!","class='btn btn-default'")
                )
            );
        }
        $this->setPageData("Bestellungs&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
	}

    public function show_bestellungenDetail($id){
        $temp = $this->session->code;
        if (!$temp > 0 && !$temp <= 2) {
            redirect("Datahandler/show_bestellungen");
        }
        else
        {
            if (!isset($id)) {
                redirect('Datahandler/show_bestellungen');
            } else {
                $this->load->model("OrderModel");
                $result = $this->OrderModel->getOrderDetails($id);
                $tableheader = array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis');
                $price = 0;
                foreach ($result as $entry) {
                    $this->table->add_row(array($entry["artikelnr"], $entry["name"], $entry{"menge"}, $entry["preis"]));
                    $price += $entry["menge"] * $entry["preis"];
                }
                $this->table->add_row(array(anchor("Datahandler/finishOrder/".$id, "Abschliessen!","class='btn btn-default'"), anchor("Datahandler/cancelOrder/".$id, "Canceln!","class='btn btn-default'")));
                $pricetext = "Gesammtpreis : ".$price;
                $this->setPageData("Detail&uuml;bersicht Bestellung Nr. " . $id, "content/DataListing_View.php", $tableheader, $this->table, $pricetext);
            }
        }
    }

    //Nicht benutzt da Zeit fehlte zum Testen...
    public function showOrderEdit($id)
    {
        $this->load->model("OrderModel");
        $result = null;
        if(!isset($_SESSION['edit']))
        {
            $result = $this->OrderModel->getOrderDetails($id);
        }
        else{
            $result = $this->session->userdata('edit');
        }
        $tableheader = array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis');
        $price = 0;
        foreach ($result as $entry) {
            $id = $entry["artikelnr"];
            $this->table->add_row(array($entry["artikelnr"], $entry["name"], form_input('amount'.$id,set_value('amount'.$id,$entry{"menge"})), $entry["preis"]));
            $price += $entry["menge"] * $entry["preis"];
        }
        $this->table->add_row(array(anchor("Datahandler/finishOrder/".$id, "Bestellung Abschliessen!","class='btn btn-default'"), anchor("Datahandler/cancelOrder/".$id, "Bestellung Abschliessen!","class='btn btn-default'")));
        $pricetext = "Gesammtpreis : ".$price."<br/>".form_input('');
        $this->setPageData("Detail&uuml;bersicht Bestellung Nr. " . $id, "content/DataListing_View.php", $tableheader, $this->table, $pricetext);
    }

    public function cancelOrder($id)
    {
        if(isset($id)){
            $this->load->model("OrderModel");
            $this->load->model("ItemModel");
            $items = $this->OrderModel->getOrderDetails($id);
            foreach($items as $item){
                $this->ItemModel->addCurrendAmountById($item["artikelnr"], $item["menge"]);
            }
            $this->finsihOrder($id);
        }
        else{
            redirect("Datahandler/show_bestellungen");
        }
    }

    public function finsihOrder($id)
    {
        if (isset($id)) {
            $this->load->model("OrderModel");
            $this->OrderModel->deleteOrder($id);
            redirect("Datahandler/show_bestellungen");
        }
        else{
            redirect("Datahandler/show_bestellungen");
        }
    }

	public function show_lager()
	{
        $this->load->model("ItemModel");
        $tableheader=array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis');
        $result = $this->ItemModel->getAllItems();
        foreach($result as $entry){
            $deleteUrl = anchor('Datahandler/deleteItem/'.$entry["artikelnr"],'L&ouml;schen', 'class="btn btn-default"');
            $refillUrl = anchor('Datahandler/show_refill/'.$entry["artikelnr"],'Auff&uuml;llen', 'class="btn btn-default"');
            $repriceUrl = anchor('Datahandler/show_reprice/'.$entry["artikelnr"],'Preis &auml;ndern!', 'class="btn btn-default"');
            $this->table->add_row(array($entry["artikelnr"], $entry["name"], $entry["bestand"], $entry["preis"], $refillUrl, $repriceUrl, $deleteUrl));
        }
        $this->table->add_row(anchor('Datahandler/show_registerItem','Hinzuf&uuml;gen', 'class="btn btn-default"'));
        $this->setPageData("Lager&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
	}

    public function show_refill($id){
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - Wareneingang";
        $this->data['content'] = "content/Wareneingang_View.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );

        $this->load->model("ItemModel");
        $item = $this->ItemModel->getItemData($id);
        $this->table->set_heading(array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis'));
        $this->table->add_row(array($item->artikelnr, $item->name, $item->bestand, $item->preis));
        $this->data['tabledata'] = $this->table->generate();
        $this->data['itemId'] = $id;
        $this->data['special'] = "Eingangsmenge";
        $this->load->view('includes/content.php', $this->data);
    }

    public function show_reprice($id){
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - Preissetzer";
        $this->data['content'] = "content/Wareneingang_View.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );

        $this->load->model("ItemModel");
        $item = $this->ItemModel->getItemData($id);
        $this->table->set_heading(array('Artikelnr', 'Bezeichnung', 'Menge', 'Einzelpreis'));
        $this->table->add_row(array($item->artikelnr, $item->name, $item->bestand, $item->preis));
        $this->data['tabledata'] = $this->table->generate();
        $this->data['itemId'] = $id;
        $this->data['special'] = "Neuer Preis";
        $this->load->view('includes/content.php', $this->data);
    }

    public function refillItem($id)
    {
        if (!isset($id) && !isset($amount))
        {
            redirect("Datahandler/show_lager");
        }
        else
        {
            $input = $this->input->post("amount");
            if(!empty($input))
            {
                $this->load->model('ItemModel');
                $this->ItemModel->addCurrendAmountById($id, $input);
                redirect("Datahandler/show_lager");
            }
            else{
                $this->show_refill($id);
            }
        }
    }

    public function repriceItem($id)
    {
        if (!isset($id) && !isset($amount))
        {
            redirect("Datahandler/show_lager");
        }
        else
        {
            $input = $this->input->post("amount");
            if(!empty($input))
            {
                $this->load->model('ItemModel');
                $this->ItemModel->repriceItem($id, $input);
                redirect("Datahandler/show_lager");
            }
            else{
                $this->show_refill($id);
            }
        }
    }

    public function deleteItem($id)
    {
        $temp = $this->session->code;
        if (!$temp > 0 && !$temp <= 2)
        {
            redirect("Datahandler/show_lager");
        }
        else
        {
            if(isset($id)){
                $this->load->model('ItemModel');
                $this->ItemModel->deleteItem($id);
            }
            else{
                redirect('Datahandler/show_lager');
            }
        }
    }

    public function show_registerItem(){
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - Artikelregistrierung";
        $this->data['content'] = "content/RegisterItem_View.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
        $this->data['special'] = "";
        $this->load->view('includes/content.php', $this->data);
    }

    public function registerItem()
    {
        $temp = $this->session->code;
        if (!$temp > 0 && !$temp <= 2) {
            redirect("Datahandler/show_lager");
        }
        else
        {
            $artikelnr = $this->input->post("artikelnr");
            $name = $this->input->post("bezeichnung");
            $bestand = $this->input->post("bestand");
            $preis = $this->input->post("preis");
            if(!empty($artikelnr)&&!empty($name)&&!empty($bestand)&&!empty($preis))
            {
                $this->load->model("ItemModel");
                $this->ItemModel->addItem($artikelnr, $name, $preis, $bestand);
                redirect("Datahandler/show_lager");
            }
            else{
                redirect("Datahandler/show_lager");
            }
        }
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
                //$editUri = anchor("Datahandler/editCostumer/".$entry["fi_person"], "Editieren", "class='btn btn-default'");
                $deleteUri = anchor("Datahandler/deleteCostumer/".$entry["fi_person"], "L&ouml;schen", "class='btn btn-default'");
                $this->table->add_row(array($entry["name"], $entry["vname"], $entry["strasse"], $entry["hausnr"], $entry["plz"], $entry["ort"], $deleteUri));
            }
            $this->table->add_row(anchor("Datahandler/show_registerCostumer", "Hinzuf&uuml;gen", "class='btn btn-default'"));
            $tableheader=array("Name", "Vorname", "Strasse", "Hausnummer", "PLZ", "Ort");
            $this->setPageData("Kunden&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
        }
    }

    public function show_registerCostumer()
    {
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - Kundenregistrierung";
        $this->data['content'] = "content/RegisterCostumer_View.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
        $this->data['special'] = "";
        $this->load->view('includes/content.php', $this->data);
    }

    public function addCostumer(){
        $temp = $this->session->code;
        if (!$temp > 0 && !$temp <= 2)
        {
            redirect('Datahandler/show_kunden');
        }
        else
        {
            $name = $this->input->post("name");
            $vname = $this->input->post("vorname");
            $adress = $this->input->post("adress");
            $hanr = $this->input->post("hanr");
            $plz = $this->input->post("plz");
            $ort = $this->input->post("ort");
            $tel = $this->input->post("tel");
            $email = $this->input->post("email");

            if(!empty($name) && !empty($vname) && !empty($adress) && !empty($hanr) && !empty($plz) && !empty($ort)) {
                $this->load->model("CostumerModel");
                if (empty($tel) && empty($email)) {
                    $this->CostumerModel->addCostumer($name, $vname, $adress, $hanr, $plz, $ort);
                }
                elseif(!empty($tel) && empty($email)){
                    $this->CostumerModel->addCostumer($name, $vname, $adress, $hanr, $plz, $ort, $tel);
                }
                else{
                    $this->CostumerModel->addCostumer($name, $vname, $adress, $hanr, $plz, $ort, $tel, $email);
                }
                redirect("Datahandler/show_kunden");
            }
            else{
                $this->show_registerCostumer();
            }
        }
    }

    public function deleteCostumer($id){
        if ($this->session->code !== 2)
        {
            redirect('Datahandler/show_kunden');
        }
        else {
            if (isset($id)) {
                $this->load->model("CostumerModel");
                $this->CostumerModel->removeCostumer($id);
            }
            redirect('Datahandler/show_kunden');
        }
    }

    //noch nicht drinne aus Zeitgründen und Krankheit nicht
    public function editCostumer($id){
        if ($this->session->code !== 2)
        {
            redirect('Datahandler/show_kunden');
        }
        else
        {

        }
    }

	public function show_mitarbeiter()
	{
        if($this->session->code != 2)
        {
            redirect('home');
        }
        else
        {

            $this->load->model("EmployeeModel");
            $result = $this->EmployeeModel->getAllEmployees();
            foreach($result as $entry){
                $deleteUri = "";
                if($entry["rechte"] != 2) {
                    $deleteUri = anchor("Datahandler/deleteEmployee/" . $entry["fi_person"], "L&ouml;schen", "class='btn btn-default'");
                }
                $this->table->add_row(array($entry["name"], $entry["vname"], $entry["gehalt"], $deleteUri));
            }
            $this->table->add_row(anchor("Datahandler/show_registerEmployee", "Hinzuf&uuml;gen", "class='btn btn-default'"));
            $tableheader=array("Name", "Vorname", "Gehalt");
            $this->setPageData("Mitarbeiter&uuml;bersicht", "content/DataListing_View.php", $tableheader, $this->table);
        }
	}

    public function editEmployee($id)
    {
        if($this->session->code != 2)
        {
            redirect('Datahandler/show_mitarbeiter');
        }
        else
        {

        }
    }

    public function deleteEmployee($id)
    {
        if($this->session->code != 2)
        {
            redirect('Datahandler/show_mitarbeiter');
        }
        else
        {
            if(isset($id)){
                $this->load->model("EmployeeModel");
                $this->EmployeeModel->delete($id);
                redirect('Datahandler/show_mitarbeiter');
            }
        }
    }

    public function show_registerEmployee()
    {
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - Arbeiterregistrierung";
        $this->data['content'] = "content/RegisterEmployee_View.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
        $this->data['special'] = "";
        $this->load->view('includes/content.php', $this->data);
    }

    public function addEmployee()
    {
        if($this->session->code != 2)
        {
            redirect('Datahandler/show_mitarbeiter');
        }
        else
        {
            $name = $this->input->post('name');
            $vname = $this->input->post('vname');
            $pwd = $this->input->post('pwd');
            if(!empty($name) && !empty($vname) && !empty($pwd))
            {
                $this->load->model("EmployeeModel");
                $this->EmployeeModel->create($name,$vname,$pwd);
                redirect("Datahandler/show_mitarbeiter");
            }
            else{
                $this->show_registerEmployee();
            }
        }
    }
}