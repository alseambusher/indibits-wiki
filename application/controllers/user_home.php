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
			$data['all_users']=$this->wiki_acc->get_user_data('all_users');
			$data['wiki_recent']=$this->wiki_model->fetch_wiki_list("recent");
			$this->load->view("user_home_view",$data);
			//$this->wiki_acc->send_notification("Congrats!!! Your account was created! ",'1');
			//$this->wiki_acc->send_notification("Congrats!!! You have been promoted to be owner!! ",'1');
			//$this->wiki_acc->send_notification("Congrats!!! You are editor again!! ",'1');
			//$this->wiki_acc->send_notification("Congrats!!! You have been promoted to be owner!! ",'1');
			//$this->wiki_acc->send_notification("A new account has been made for editor: Ananth ",'1');
			
				
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
	function updateUsers(){
		$this->load->model("wiki_acc");
		if(!$this->wiki_acc->isLoggedIn())
			redirect($this->config->base_url());
		if(isset($_POST['new_account_type'])){
			$this->db->update('users',array('account_type'=>$_POST['new_account_type']),array('id'=>$_POST['uid']));
			if($_POST['new_account_type']=="editor")
				$this->wiki_acc->send_notification("Congrats!!! You are editor again!! ",$_POST['uid']);
			else{
				foreach($this->wiki_acc->get_user_data("all_owners") as $row){
					$this->wiki_acc->send_notification("Editor ".$this->wiki_acc->get_individual_user_data($_POST['uid'],'fullname')." has been made owner.",$row['id']);
				}
				$this->wiki_acc->send_notification("Congrats!!! You have been promoted to be owner!! ",$_POST['uid']);
			}
			redirect($this->config->base_url());
		}
		else if(isset($_POST['delete_user'])){
			foreach($this->wiki_acc->get_user_data("all_owners") as $row){
				$this->wiki_acc->send_notification("User ".$this->wiki_acc->get_individual_user_data($_POST['delete_user'],'fullname')."'s account has been deleted.",$row['id']);
			}
			$this->db->query("delete from users where id='".$_POST['delete_user']."'");
			redirect($this->config->base_url());
		}
		else
			print_r($_POST);
	}
	function generate_editor(){
		if ((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))&&($_POST['first_name']!=NULL)&&($_POST['last_name']!=NULL)&&($_POST['timezone']!=NULL)){
			
			$result="<strong>First Name => </strong>".$_POST['first_name']."<br><strong>Last Name => </strong> ".$_POST['last_name']."<br><strong>Email => </strong> ".$_POST['email']."<br><strong>Time Zone => </strong> ".$_POST['timezone'];
			while(TRUE){
				$username=substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',5)),0,6);
				if($this->db->query("select username from users where username='".$username."'")->result_array()==NULL)
					break;
			}
			$password=substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',5)),0,6);
			$result=$result."<br><strong>Unique username => </strong> ".$username."<br><strong>Generated Password => </strong> ".$password;
			$result=$result."<input type='hidden' name='first_name' value='".$_POST['first_name']."'>
			<input type='hidden' name='last_name' value='".$_POST['last_name']."'>
			<input type='hidden' name='email' value='".$_POST['email']."'>
			<input type='hidden' name='password' value='".md5($password)."'>
			<input type='hidden' name='username' value='".$username."'>
			<input type='hidden' name='account_type' value='editor'>
			<input type='hidden' name='timezone' value='".$_POST['timezone']."'>";
			echo 'success:'.$result;
		}
		else{
			$result='<div id="notification">
						<div class="alert alert-error">						
						<strong>Failed to generate new editor..please Try again by carefully filling the details </strong>
						</div>
					</div>';
			echo 'failed:'.$result;
		}
	}
	function save_generated_editor(){
		$this->db->insert('users',$_POST);
		$this->load->model("wiki_acc");
		$this->wiki_acc->send_notification("Congrats!!! Your account was created!",$this->wiki_acc->get_id($_POST['username']));
		foreach($this->wiki_acc->get_user_data("all_owners") as $row){
			$this->wiki_acc->send_notification("Editor ".$_POST['first_name']." ".$_POST['last_name']." has been created.",$row['id']);
		}
		//Sending mail not done
		//$this->wiki_acc->send_mail($_POST['email'],"Congrats your $wikiapp_name account was created!!",$_POST['result']."<br>Login from here:".$this->config->base_url());
		redirect("user_home");
	}
	function save_wiki(){
		if($this->wiki_acc->isLoggedIn())
			$this->load->view("default_view");
	}
}
?>
