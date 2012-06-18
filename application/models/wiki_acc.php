<?php
/*
 * methods in this model:
 * login
 * logout
 * handle_account
 * privillege
 */
class Wiki_acc extends CI_Model
{
	function __construct(){
		parent::__construct();
	}//now i edited your code so i dont know what this is the function i just commented after
	function login($username,$pass)
	{
        $this-> db -> select('id, username, password');
        $this-> db -> from('users');
        $this-> db -> where('username = ' . "'" . $username . "'");
        $this-> db -> where('password = ' . "'" . MD5($password) . "'");//i am assuming md5 if u want to salt it or any other thing lwt mw know
        $this-> db -> limit(1);

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
}		
?>
