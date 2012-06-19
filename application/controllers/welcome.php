<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model("wiki_model");
		$this->load->view("includeBootstrap");
		$data['wiki_list']=serialize($this->wiki_model->fetch_wiki_list());
		$this->load->view("default_view");
		$this->load->view("home_view",$data);
	}
	function login(){
		$this->load->model("wiki_acc");
		if($this->wiki_acc->login($_POST['username'],$_POST['password'])==TRUE){
			$this->load->library('session');
			echo "Logged in !!!!!";
		}
		else{
			//show error message
			echo "failed to login:(";
		}
	}
}
