<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wiki extends CI_Controller {
	public function index()
	{
		$this->load->model("wiki_model");
		$this->load->model("wiki_acc");
		$this->load->view("includeBootstrap");
		$this->load->view("default_view");
		include("markdown.php");
		if(isset($_GET['id'])&&isset($_GET['version'])){
			$wiki_data=$this->wiki_model->fetch_wiki($_GET['id'],$_GET['version']);
			$wiki_data['wiki_description']=htmlspecialchars_decode(Markdown($wiki_data['wiki_description']));
			$this->load->view('wiki_view',$wiki_data);
		}
	}
	function preview(){
		$this->load->model("wiki_model");
		$this->load->model("wiki_acc");
		$this->load->view("includeBootstrap");
		$this->load->view("default_view");
		include("markdown.php");
		if(isset($_POST['wiki_title'])&&isset($_POST['wiki_description'])){
			//$_POST['wiki_description']=Markdown(trim($_POST['wiki_description']));
			echo "<br><br><div class='table-bordered'><h1>".$_POST['wiki_title']."</h1><br>".Markdown(trim($_POST['wiki_description']))."</div>";
		}
	}
	function create(){
		$this->load->model("wiki_acc");
		$this->load->model("wiki_model");
		if(!$this->wiki_acc->isLoggedIn())
			redirect(base_url());
		$this->load->view("includeBootstrap");
		$this->load->view("default_view");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('wiki_description','Name of the wiki application','required|xss_clean|prep_for_form');
		$this->form_validation->set_rules('wiki_title','Name of the wiki application','required|xss_clean|prep_for_form');
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				$new['wikiid']=$this->wiki_model->wiki_create();
				$new['versionid']='1';
				$new['wiki_title']=$_POST['wiki_title'];
				$new['wiki_description']=$_POST['wiki_description'];
				$new['editorid']=$this->session->userdata('uid');
				$this->db->insert('wiki_data',$new);
				foreach($this->wiki_acc->get_user_data('all_users') as $row){
					$this->wiki_acc->send_notification($new['wiki_title']." wiki was created",$row['id']);
				}
				redirect("user_home?tab=wikis");
			}
		}
		$this->load->view("wiki_new");
	}
	function edit(){
		$this->load->model("wiki_acc");
		$this->load->model("wiki_model");
		if(!$this->wiki_acc->isLoggedIn())
			redirect(base_url());
		$this->load->view("includeBootstrap");
		$this->load->view("default_view");
		$data=$this->wiki_model->fetch_wiki($_GET['id'],$_GET['version']);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('wiki_description','Name of the wiki application','required|xss_clean|prep_for_form');
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				$this->wiki_model->edit_wiki($_GET['id'],$_POST['wiki_description']);
				//$this->wiki_model->edit_wiki($_GET['id'],htmlentities($_POST['wiki_description'], ENT_COMPAT, "UTF-8"));
				redirect("wiki/edit?id=".$_GET['id']."&version=0");
			}
		}
		$this->load->view("wiki_edit",$data);
	}
	function compare(){
		include("markdown.php");
		if(isset($_GET['id'])&&isset($_GET['version1'])&&isset($_GET['version2'])){
			$this->load->model("wiki_model");
			$one=$this->wiki_model->fetch_wiki($_GET['id'],$_GET['version1']);
			$two=$this->wiki_model->fetch_wiki($_GET['id'],$_GET['version2']);
			$this->load->view("includeBootstrap");
			$this->load->view("default_view");
			echo "<style type='text/css'>
				del{
					color:red;
				}
				ins{
					color:green;
				}
			</style>";
			echo "<div class='container'>".$this->htmlDiff(Markdown(trim($one['wiki_description'])),Markdown(trim($two['wiki_description'])))."</div>";
		}
	}
	function diff($old, $new){
		$maxlen=0;
		foreach($old as $oindex => $ovalue){
			$nkeys = array_keys($new, $ovalue);
			foreach($nkeys as $nindex){
				$matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
					$matrix[$oindex - 1][$nindex - 1] + 1 : 1;
				if($matrix[$oindex][$nindex] > $maxlen){
					$maxlen = $matrix[$oindex][$nindex];
					$omax = $oindex + 1 - $maxlen;
					$nmax = $nindex + 1 - $maxlen;
				}
			}	
		}
		if($maxlen == 0) return array(array('d'=>$old, 'i'=>$new));
			return array_merge(
				$this->diff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
				array_slice($new, $nmax, $maxlen),
				$this->diff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen)));
	}

	function htmlDiff($old, $new){
		$ret='';
		$diff = $this->diff(explode(' ', $old), explode(' ', $new));
		foreach($diff as $k){
			if(is_array($k))
				$ret .= (!empty($k['d'])?"<del>".implode(' ',$k['d'])."</del> ":'').
					(!empty($k['i'])?"<ins>".implode(' ',$k['i'])."</ins> ":'');
			else $ret .= $k . ' ';
		}
		return $ret;
	}
}
