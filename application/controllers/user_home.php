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
			$data['pageId']="notifications";
			$this->load->view("user_home_view",$data);
			//$this->wiki_acc->send_notification("This notification was added to test the notifications",'1');
			//TODO make notifications include who has sent the notification
			foreach($this->wiki_acc->get_notifications($this->session->userdata('uid')) as $row){
				echo $row['message']." by was sent at time ".$row['time']."<br>";
			}
		}
		else{
			echo "not logged in:(";
		}
	}
}
?>
