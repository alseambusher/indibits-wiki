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
		$data['wiki_list']=serialize($this->wiki_model->fetch_wiki_list("random"));
		$data['wiki_recent']=serialize($this->wiki_model->fetch_wiki_list("recent"));
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
			$this->load->view('includeBootstrap');
			echo '<div class="container">
				<div id="notification">
				<div class="alert alert-error">
					<br><br><h2><strong>Failed to login :(</strong></h2><h3>Please check the login information and try again.</h3>
					<br>
					<h3><a href="'.$this->config->base_url().'">Click here to go back to main page</a><br></h3>
				</div>
				</div>
			</div>';
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect($this->config->base_url());
	}
	function terms(){
		include("config.php");
		$this->load->view('includeBootstrap');
		echo "<script type='text/javascript'>document.title='Terms and Conditions';</script>";
		echo "<h1>Terms and Conditions</h1>";
		echo "<pre>$terms</pre>";
	}
}
