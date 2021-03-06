<?php
//NOTE search_wikis is in welcome.php
/*
 * methods in this model:
 * fetch_wiki_list
 * fetch_wiki($id,$wikiid=0)
 * edit_wiki($id,$editdescription=NULL,$wikicontent=NULL,$wikimessage=NULL)
 * wiki_create($permittedtoeditors,$desciption)
 * wiki_delete($id)
 * get_comments($id)
 * add_comment($wikiid,$versionid,$message)
 */
class Wiki_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function fetch_wiki_list($order="random"){
		if($order=="random")
			return $this->db->query("select * from wikis inner join wiki_data on wikis.wikiid=wiki_data.wikiid group by wikis.wikiid order by rand()")->result_array();
		if($order=="recent")
			return $this->db->query("select * from wikis inner join wiki_data on wikis.wikiid=wiki_data.wikiid group by wikis.wikiid order by time desc")->result_array();
	}
	function fetch_wiki($wikiid,$versionid=0){
		if($versionid==0){
			$query=$this->db->query("select * from  wiki_data where wikiid='".$wikiid."' order by versionid desc")->result_array();
			return $query[0];
		}
		else{
			$query=$this->db->query("select * from  wiki_data where versionid='".$versionid."' and wikiid='".$wikiid."'")->result_array();
			return $query[0];
		}
		
	}
	function edit_wiki($wikiid,$wiki_description){
		$history=$this->fetch_wiki($wikiid,0);//get latest wiki
		$history['versionid']=1+$history['versionid'];
		$history['wiki_description']=$wiki_description;//htmlentities($wiki_description,ENT_QUOTES);
		$history['editorid']=$this->session->userdata('uid');
		$this->db->insert('wiki_data',$history);//inserts edited version of the recent history
	}
	function wiki_create(){
		$new['editors']=$this->session->userdata('uid');
		$this->db->insert('wikis',$new);
		$query=$this->db->query("select wikiid from wikis where editors='".$new['editors']."' order by wikiid desc")->result_array();
		return $query[0]['wikiid'];
	}
	function wiki_delete($wikiid){
		$this->db->query("delete from wikis where wikiid='".$wikiid."'");
		$this->db->query("delete from wiki_data where wikiid='".$wikiid."'");//delete all versions
	}
	function get_comments($wikiid,$versionid){
		$query=$this->db->query("select comments from wiki_data where wikiid='".$wikiid."' and versionid='".$versionid."'")->result_array();
		return unserialize($query[0]['comments']);
	}
	function add_comment($wikiid,$versionid,$message){
		$comment=get_comments($wikiid,$versionid);
		array_push($comment,$message);
		$this->db->update('wiki_data',array('comments'=>serialize($comment)),array('wikiid'=>$wikiid,'versionid'=>$versionid));
	}
}
?>
