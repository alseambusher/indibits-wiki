<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->model("wiki_model");
		$this->load->view("includeBootstrap");
		$data['wiki_list']=serialize($this->wiki_model->fetch_wiki_list());
		$this->load->view("default_view");
		$this->load->view("home_view",$data);
	}
}
