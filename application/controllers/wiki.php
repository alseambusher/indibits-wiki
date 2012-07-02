<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wiki extends CI_Controller {
	public function index()
	{
		//by default it is used to view
		$this->load->model("wiki_model");
		$this->load->model("wiki_acc");
		$this->load->view("includeBootstrap");
		$this->load->view("default_view");
		if(isset($_GET['id'])&&isset($_GET['version'])){
			$wiki_data=$this->wiki_model->fetch_wiki($_GET['id'],$_GET['version']);
			$this->load->view('wiki_view',$wiki_data);
		}
	}
	function create(){
		echo "new";
	}
	function edit(){
		echo "edit";
	}
}
