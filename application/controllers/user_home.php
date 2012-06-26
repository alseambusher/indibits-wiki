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
			$notifications=$this->wiki_acc->get_notifications($this->session->userdata('uid'));
			if($notifications!=Null)
				$data['notifications']=$notifications;
			else
				$data['notifications']=array();
			$this->load->view("user_home_view",$data);
			//$this->wiki_acc->send_notification("A new account has been made for editor: Spurthi ",'1');
			//TODO make notifications include who has sent the notification
			
				
		}
		else{
			echo "not logged in:(";
		}
	}
}
?>
