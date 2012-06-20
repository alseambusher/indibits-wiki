<?php
/*
 * methods in this model:
 * new_account(
 * login
 * logout
 * handle_account
 * privillege
 */
class Wiki_acc extends CI_Model
{
	function __construct(){//this function is a constructor of this class
		parent::__construct();
	}
	function new_account($data){
		$this->db->insert("users",$data);
	}
	function login($username,$pass)
	{
        $this-> db -> select('id, username, password');
        $this-> db -> from('users');
        $this-> db -> where('username = ' . "'" . $username . "'");
        $this-> db -> where('password = ' . "'" . md5($pass) . "'");//i am assuming md5 if u want to salt it or any other thing lwt mw know
        $this-> db -> limit(1);

        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        	    return $query->result();
         else
                     return false;
	}

//note that we need another function 


	function handle_account($username=0,$password=0,$email=0,$acctype=0,$action=1)// delete the account -1
	{
		if($action=-1)
		$this->db->query("delete from users where $username='".$username."'");
		else if($action==1)
		{
			//note that the validation for the username the email pass and the $acc has to be done on the part of the controller
			$newacc['username']=$username;//every edit is stored as a different version
			$newacc['password']=MD5($password);
			$newacc['email']=$email;
			if(trim($acctype))$newacc['acount_type']=$acctype;
					$this->db->insert('users',$newacc);
			//note that  i ll like to send an email to the email mentioned here or i think the controller should do it
		}
	}
	function privilege($username,$action=0)// if no second parameter gets the current privillege
	{
		if($action==1 )///make editor
		{
			$this->db->set('users.account_type', 1);
			$this->db->where('username = ' . "'" . trim($username) . "'");
		}
		if($action==2 )///make owner
		{
			$this->db->set('users.account_type', 2);
			$this->db->where('username = ' . "'" . trim($username) . "'");
		}
		if($action==3 )///sue the username
		{
			$this->db->set('users.account_type', 3);
			$this->db->where('username = ' . "'" . trim($username) . "'");
		}
		if($action==0 )///get thecurrent privillege
		{
		$this-> db -> select('account_type');
        $this-> db -> from('users');
        $this-> db -> where('username = ' . "'" . trim($username) . "'");
		$query = $this -> db -> get();
        if($query -> num_rows() == 1)
	        	{
        	    return $query->result();
                }
         else
     	        {
                     return false;
            	}
        }
		
	}
	function isLoggedIn(){
		if(($this->session->userdata('uid')=="")&&($this->session->userdata('account_type')==""))
			return FALSE;
		else
			return TRUE;
	}
	function get_user_data($type){
		if($type=="fullname"){
			$data=$this->db->query("select first_name,last_name from users where id='".$this->session->userdata('uid')."'")->result_array();
			return $data[0]['first_name']." ".$data[0]['last_name'];
		}
		else
			return "invalid request";
	}
	function send_notification($message,$uid){
		$query=$this->db->query("select notifications from users where id='".$uid."'")->result_array();
		if($query[0]['notifications']==NULL)
			$notifications=array();
		else
			$notifications=unserialize($query[0]['notifications']);
		$this->load->helper("date");
		array_push($notifications,array('time'=>standard_date('DATE_RFC822', time()),'message'=>$message));
		$data['notifications']=serialize($notifications);
		$this->db->update('users',$data,array('id'=>$uid));
	}
	function get_notifications($uid){
		$query=$this->db->query("select notifications from users where id='".$uid."'")->result_array();
		return unserialize($query[0]['notifications']);
	}
	function make_tables(){// this is used at the time of install
		$this->db->query("
	CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `account_type` varchar(30) DEFAULT NULL,
  `signup_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notifications` text
);");
				$this->db->query("
	CREATE TABLE IF NOT EXISTS `wikis` (
  `ownerid` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wikiid` int(11) NOT NULL AUTO_INCREMENT primary key,
  `editors` text
);");
				$this->db->query("
	CREATE TABLE IF NOT EXISTS `wiki_data` (
  `wikiid` int(11) DEFAULT NULL,
  `versionid` int(11) DEFAULT NULL,
  `wiki_title` text,
  `wiki_description` text,
  `editorid` int(11) DEFAULT NULL
);");
	}
}		
?>
