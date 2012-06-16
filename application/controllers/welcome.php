<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->model("wiki_model");
		$this->load->view("includeBootstrap");
		$this->load->view("home_view");
	}
}
