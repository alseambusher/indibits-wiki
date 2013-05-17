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
	function search_wikis(){
		if($_POST['type']=="simple"){
			$results=$this->db->query("select wiki_title from wiki_data where wiki_title like '%".$_POST['sentence']."%' group by wiki_title")->result_array();
			foreach($results as $row){
				echo $row['wiki_title'].",";
			}
		}
		else if($_POST['type']="full"){
			$results=$this->db->query("select wiki_title,wikiid from wiki_data where wiki_title like '%".$_POST['sentence']."%' group by wiki_title")->result_array();
			$hits=array();//this has all the hits
			$wikiid=array();// this will have all the wikiids
			foreach($results as $row){
				$hits[$row['wiki_title']]=10;
				$wikiid[$row['wiki_title']]=$row['wikiid'];
			}
			$words=explode(" ",$_POST['sentence']);
			foreach($words as $word){
				$advanced_search=$this->db->query("select wiki_title,wiki_description,wikiid from wiki_data where wiki_description like '%".$word."%' group by wiki_title")->result_array();
				foreach($advanced_search as $row){
					if(!isset($hits[$row['wiki_title']])){
						$hits[$row['wiki_title']]=1;
						$wikiid[$row['wiki_title']]=$row['wikiid'];
					}
					else{
						$hits[$row['wiki_title']]+=1;
					}
				}
			}
			arsort($hits);
			$i=0;
			$wiki_titles=array_keys($hits);
			$result_array="";$url_array="";
			foreach($hits as $hit){
				$result_array.=$wiki_titles[$i].",";
				$url_array.=base_url().index_page()."/wiki?id=".$wikiid[$wiki_titles[$i]]."&version=0,";
				$i+=1;
			}
			echo $result_array."~".$url_array;
			//echo "1,2,3,4,5,6,7:q,w,e,r,t,y,u,";
		}
	}
}
