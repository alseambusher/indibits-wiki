<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_home extends CI_Controller {

	public function index()
	{
		$this->load->model("wiki_model");
		$this->load->model("wiki_acc");
		$this->load->view("includeBootstrap");
		if($this->wiki_acc->isLoggedIn()){
			$this->load->view("default_view");
			//$data['wiki_list']=serialize($this->wiki_model->fetch_wiki_list());
			//$this->load->view("home_view",$data);
		}
		else{
			echo "not logged in:(";
		}
	}
}
