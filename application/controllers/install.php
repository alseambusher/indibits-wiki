<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {
	public function index()
	{
		$this->load->view('includeBootstrap');
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('wikiapp_name','Name of the wiki application','required|xss_clean');
		$this->form_validation->set_rules('wikiapp_description','Description of wiki application','required|xss_clean');
		$this->form_validation->set_rules('db_host','Database Host','required|xss_clean');
		$this->form_validation->set_rules('db_username','Database Username','required|xss_clean');
		$this->form_validation->set_rules('db_password','Database Password','required|xss_clean');
		$this->form_validation->set_rules('db_name','Database name','required|xss_clean');
		$this->form_validation->set_rules('admin_username','Admin username','required|xss_clean');
		$this->form_validation->set_rules('admin_password','Admin password','required|xss_clean|matches[admin_password_confirm]');
		$this->form_validation->set_rules('admin_password_confirm','Admin password Confirmation','required|xss_clean');
		$this->form_validation->set_rules('first_name','First name','required|xss_clean');
		$this->form_validation->set_rules('last_name','Last name','required|xss_clean');
		$this->form_validation->set_rules('email','Email','required|xss_clean|valid_email');
		$this->form_validation->set_rules('timezone','Timezone','required|xss_clean');
		$this->form_validation->set_rules('username','username','required|xss_clean');
		$this->form_validation->set_rules('password','password','required|xss_clean|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Password Confirmation','required|xss_clean');
		$this->form_validation->set_error_delimiters('<div id="notification">
														<div class="alert alert-error">
															<button class="close" data-dismiss="alert">×</button>
															<strong>',
															'</strong>
														</div>
													</div>'
													);
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				$this->updateConfig(
					$_POST['wikiapp_name'],
					$_POST['wikiapp_description'],
					$_POST['db_host'],
					$_POST['db_username'],
					$_POST['db_password'],
					$_POST['db_name'],
					$_POST['admin_username'],
					$_POST['admin_password'],
					$_POST['copyright'],
					$_POST['terms']
				);
				//$this->db->query(file_get_contents('export.sql'));
				$this->load->model("wiki_acc");
				$this->wiki_acc->make_tables();
				$data =array("first_name"=>$_POST['first_name'],"last_name"=>$_POST['last_name'],"email"=>$_POST['email'],"timezone"=>$_POST['email'],"username"=>$_POST['username'],"password"=>md5($_POST['password']));
				$this->wiki_acc->new_account($data);
				redirect('install/success');
			}
		}
		$this->load->view('installView');
	}
	function success(){
		$this->load->view('includeBootstrap');
		echo '<div class="container">
				<div id="notification">
				<div class="alert alert-success">
					<br><br><h1><strong>Successfully Installed wiki application!!</strong></h1><br>
					<h3><a href="'.$this->config->base_url().'index.php/install/test">Click here to test the configuration</a><br></h3>
					The following link will take you to the home of your wiki application<br>
					<h3><a href="'.$this->config->base_url().'">'.$this->config->base_url().'</a><br></h3>
					To make any changes to the existing settings go to:<br>
					<a href="'.$this->config->base_url().'index.php/settings">'.$this->config->base_url().'index.php/settings</a><br>
				</div>
				</div>
			</div>';
	}
	function updateConfig($wikiapp_name,$wikiapp_description,$db_host,$db_username,$db_password,$db_name,$admin_username,$admin_password,$copyright="",$terms=""){
		//creates or updates config file
		$newconfig='<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");
					$wikiapp_name="'.$wikiapp_name.'";
					$wikiapp_description="'.$wikiapp_description.'";
					$db_host="'.$db_host.'";
					$db_username="'.$db_username.'";
					$db_password="'.$db_password.'";
					$db_name="'.$db_name.'";
					$admin_username="'.$admin_username.'";
					$admin_password="'.md5($admin_password).'";
					$copyright="'.$copyright.'";
					$terms="'.$terms.'";
					$default_controller="welcome";?>';	
		$fp = fopen('config.php', 'w');
		fwrite($fp, $newconfig);
		fclose($fp);	
	}
	function test(){
		echo "<p>You should see this:</p>";
		echo "<blockquote style='border:1px black solid;'>Array ( [0] => Array ( [Tables_in_indibits_wiki] => users ) [1] => Array ( [Tables_in_indibits_wiki] => wiki_data ) [2] => Array ( [Tables_in_indibits_wiki] => wikis ) ) </blockquote>";
		print_r($this->db->query("show tables")->result_array());
	}
}
