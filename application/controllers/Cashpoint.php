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
                array("name"=>"Testitem","kosten"=>2),
                array("name"=>"Testitem2","kosten"=>5),
                array("name"=>"Testitem3","kosten"=>1)
            );
        }
    }

    public function addItem($amount = 1)
    {
        $search = array_search($this->input->post('scan'), array_column($this->itemList, 'id'));
        if($search !== null) {
            $this->itemList[$search]["menge"] += $amount;
        }
        else{
            $item = array(
                "id" => "",
                "name" => "",
                "kosten" => 0,
                "menge" => 1
            );
            array_push($this->itemList, $item);
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

    //"button" zum löschen von einträgen der Liste
    public function removeItem($id)
    {

    }

	public function sendShoppingCart()
    {

	}
}