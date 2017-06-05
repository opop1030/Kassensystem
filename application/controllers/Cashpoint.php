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
            $this->itemList = array(
                array("id"=>1,"name"=>"Testitem","cost"=>2,"amount"=>1),
                array("id"=>2,"name"=>"Testitem2","cost"=>5,"amount"=>1),
                array("id"=>3,"name"=>"Testitem3","cost"=>1,"amount"=>1)
            );
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
		$this->data['special'] = $this->itemList;
		$this->load->view('includes/content.php', $this->data);
	}

    public function addItem($amount = 1)
    {
        $search = array_search($this->input->post('scan'), array_column($this->itemList, 'id'));
        if($search !== null)
        {
            $this->itemList[$search]["amount"] += $amount;
        }
        else
        {
            $this->load->model("ItemModel");
            $item = $this->ItemModel->getItemData($this->input->post("scan"));
            if (isset($item))
            {
                array_push($this->itemList, $item);
            }
        }
        $this->session->set_userdata('datalist', $this->itemList);
        redirect('Cashpoint');
}

    //"button" zum löschen von einträgen der Liste
    public function removeItem($id)
    {
        //löschen des Elements aus der Liste
        //aktualisieren der Sessiondaten
        redirect('Cashpoint');
    }

    //"Button" zum abschliessen einer Bestellung
	public function sendShoppingCart()
    {
        if($this->input->post('isPreorder') === true)
        {
            $this->load->model("OrderModel");
            $this->OrderModel->addOrder($this->itemList, 1, 1);
        }
        //entfernen der Items aus dem Lager
        $this->session->unset_userdata('datalist');
        redirect('Cashpoint');
	}
}