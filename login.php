<?php session_start();
include "sql_connection.php";
include 'log.php';
class Login
{
	private $username,$password,$result,$row ;
	public function __construct($u_n,$p_s)
	{
		$this->username = $u_n;
		$this->password = $p_s;
	}
	
	public function authenticate()
	{
		$this->result = mysql_query("SELECT * FROM `admin` WHERE `username` ='".$this->username."' AND `password` ='".md5($this->password)."'");
		if(mysql_num_rows($this->result) == 1)
			{			
				$_SESSION["admin"] = true;
				$_SESSION["username"] = $this->username;
				$result_control = mysql_fetch_array(mysql_query("SELECT iamadmin FROM permission"));
				if($result_control[0]==0)
				{
					mysql_query("UPDATE permission  SET iamadmin='1'");
					if(!(isset($_SESSION["iamadmin"])))
					{
						$_SESSION["iamadmin"]= true;
					}
				}
				return true;	
			}
		else
			{
				return false;
			}
	}
}
$login = new Login(htmlentities($_POST["username"]),htmlentities($_POST["password"]));
if($login->authenticate()){
	log_event("admin login successful");
	echo " ";
}
else{
	log_event("admin login was not successful");
	echo "login failed!";
} 
	
?>