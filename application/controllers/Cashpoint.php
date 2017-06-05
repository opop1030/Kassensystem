<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Cashpoint bedeutet auf Englisch Kasse, daher der Name :)
class Cashpoint extends CI_Controller{

    private $data, $itemList, $costumers;

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

    private function refreshList()
    {
        if(isset($_SESSION['costumers'])){
            $this->load->model("CostumerModel");
            $this->costumers = $this->CostumerModel->getAllCostumers();
            $this->session->set_userdata('costumers', $this->costumers);
        }
        else{
            $this->costumers = $this->session->userdata("costumers");
        }
        if(isset($_SESSION['datalist']))
        {
            $this->itemList = $this->session->userdata("datalist");
        }
        else
        {
            $this->itemList = array();
        }
    }

	public function __construct()
    {
		parent::__construct();
		if($this->session->login !== true)
		{
			redirect('login');
		}
        $this->load->model("OrderModel");
        $this->refreshList();
	}

	public function index()
	{
		$userdata = $this->getLoginData();
		$this->data['title'] = "Kassensystem Emma - Kasse";
		$this->data['content'] = "content/Cashpoint_View.php";
		$this->data['status'] = array(
			'shownavi' => true,
            'login' => $userdata
		);
		$this->data['special'] = array("itemlist"=>$this->itemList,"costumers"=>$this->costumers);
		$this->load->view('includes/content.php', $this->data);
	}

    public function addItem($amount = 1)
    {
        $search = array_search($this->input->post('scan'), array_column($this->itemList, 'id'));
        if($search !== false)
        {
            $this->itemList[$search]["amount"] += $amount;
        }
        else
        {
            $this->load->model("ItemModel");
            $item = $this->ItemModel->getItemData($this->input->post("scan"));
            if (isset($item))
            {
                $result = array(
                    "id" => $item->artikelnr,
                    "name" => $item->name,
                    "cost" => $item->preis,
                    "amount" => 1
                );
                array_push($this->itemList, $result);
            }
            else{
                redirect('Cashpoint');
            }
        }
        $this->session->set_userdata('datalist', $this->itemList);
        redirect('Cashpoint');
}

    //"button" zum löschen von einträgen der Liste
    public function removeItem($id)
    {
        $search = array_search($id, array_column($this->itemList, 'id'));
        if($search !== false){
            unset($this->itemList[$search]);
            $this->itemList = array_values($this->itemList);
            $this->session->set_userdata('datalist', $this->itemList);
        }
        redirect('Cashpoint');
    }

    //"Button" zum abschliessen einer Bestellung
	public function sendShoppingCart()
    {
        if($this->input->post('isPreorder') === true)
        {
            $this->load->model("OrderModel");
            $this->load->model("EmployeeModel");
            $employeeId = $this->EmployeeModel->getEmployeeByName($this->session->username);
            $this->OrderModel->addOrder($this->itemList, 1, $employeeId);
        }
        else{

        }
	}

    public function clearCashpoint()
    {
        $this->session->unset_userdata('datalist');
        redirect('Cashpoint');
    }
}