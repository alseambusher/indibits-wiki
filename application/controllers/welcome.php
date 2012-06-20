<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->model('wiki_acc');
		if($this->wiki_acc->isLoggedIn())
			redirect("user_home");
		$this->load->helper('form');
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
			$session=$this->db->query("select id,account_type from users where username='".$_POST['username']."' and password='".md5($_POST['password'])."'")->result_array();
			$this->session->set_userdata(array('uid'=>$session[0]['id'],'account_type'=>$session[0]['account_type']));
			redirect("user_home");
			//echo $this->session->userdata('uid')." ".$this->session->userdata('account_type');
		}
		else{
			//show error message
			echo "failed to login:(";
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect($this->config->base_url());
	}
}
