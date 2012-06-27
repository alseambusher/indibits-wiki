<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_home extends CI_Controller {

	public function index()
	{
		$this->load->model("wiki_model");
		$this->load->model("wiki_acc");
		$this->load->view("includeBootstrap");
		$data=array();
		if($this->wiki_acc->isLoggedIn()){
			$this->load->view("default_view");
			
			$data['wiki_list']=serialize($this->wiki_model->fetch_wiki_list());
			$data['notifications']=$this->wiki_acc->get_notifications($this->session->userdata('uid'));
			$data['editors']=$this->wiki_acc->get_user_data('all_editors');
			$data['owners']=$this->wiki_acc->get_user_data('all_owners');
			$this->load->view("user_home_view",$data);
			//$this->wiki_acc->send_notification("A new account has been made for editor: Spurthi ",'1');
			//TODO make notifications include who has sent the notification
			
				
		}
		else{
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
}
?>
