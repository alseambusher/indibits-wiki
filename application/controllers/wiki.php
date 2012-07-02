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
		$this->load->model("wiki_acc");
		if(!$this->wiki_acc->isLoggedIn())
			redirect(base_url());
		include("markdown.php");// this is apready there dont change this to include_once or require_once
		//version and wikiid is got from $_GET['version'] and $_GET['id']
		//sample url
		echo "new";
	}
	function edit(){
		
		if(!$this->wiki_acc->isLoggedIn())
			redirect(base_url());
		include("markdown.php");
		//sample url http://localhost/indibits_wiki/index.php/wiki/edit?id=2&version=1
		echo "edit";
	}
}
