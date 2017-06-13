<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Cashpoint bedeutet auf Englisch Kasse, daher der Name :)
class Cashpoint extends CI_Controller{

    private $data, $itemList;

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
		$this->data['special'] = array("itemlist"=>$this->itemList);
		$this->load->view('includes/content.php', $this->data);
	}

    public function addItem()
    {
        $search = array_search($this->input->post('scan'), array_column($this->itemList, 'id'));
        if($search !== false)
        {
            $item = $this->itemList[$search];
            if($item["max"]>= $item["amount"]+1) {
                $item["amount"] += 1;
            }
            $this->itemList[$search] = $item;
        }
        else
        {
            $this->load->model("ItemModel");
            $item = $this->ItemModel->getItemData($this->input->post("scan"));
            if (isset($item))
            {
                if($this->ItemModel->isItemAvailable($item->artikelnr) === true) {
                    $result = array(
                        "id" => $item->artikelnr,
                        "name" => $item->name,
                        "cost" => $item->preis,
                        "amount" => 1,
                        "max" => $item->bestand
                    );
                    array_push($this->itemList, $result);
                }
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
        if(Count($this->itemList) > 0) {
            $this->load->model("ItemModel");
            foreach ($this->itemList as $item) {
                $this->ItemModel->addCurrendAmountById($item["id"], $item["amount"] * -1);
            }
        }
        $this->clearCart();
	}

    public function showReservation(){
        $userdata = $this->getLoginData();
        $this->data['title'] = "Kassensystem Emma - Reservation";
        $this->data['content'] = "content/Reservation_View.php";
        $this->data['status'] = array(
            'shownavi' => true,
            'login' => $userdata
        );
        $this->load->model("CostumerModel");
        $result = $this->CostumerModel->getAllCostumersForDropDown();
        $this->data['select'] = array();
        foreach($result as $r){
            $this->data['select'][$r->id] = $r->name;
        }
        $this->data['special'] = array("itemlist"=>$this->itemList);
        $this->load->view('includes/content.php', $this->data);
    }

    public function reserveOrder()
    {
        $this->load->model("OrderModel");
        $this->load->model("EmployeeModel");
        $costumerId = $this->input->post("costumer");
        $employeeId = $this->EmployeeModel->getEmployeeByName($this->session->username);
        if($costumerId !== 0) {
            $this->OrderModel->addOrder($this->itemList, $costumerId, $employeeId);
            $this->sendShoppingCart();
        }
        else{
            $this->reserveOrder();
        }
    }

    private function clearCart()
    {
        $this->session->unset_userdata('datalist');
        $this->session->unset_userdata('costumers');
        redirect('Cashpoint');
    }
}