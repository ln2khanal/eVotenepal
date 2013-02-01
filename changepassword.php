<?php session_start();
include 'sql_connection.php';
include 'log.php';
class ChangePassword{
	private $pass,$pass1,$pass2,$u;
	public function __construct($p,$p1,$p2,$u)
	{
		$this->pass = $p;
		$this->pass1 = $p1;
		$this->pass2 = $p2;
		$this->u = $u;
	}
	public function change()
	{
		if($_SESSION['admin'])
			{
				if($this->pass1 == $this->pass2)
					{
						$valid = mysql_query("SELECT username FROM `admin` WHERE `username` = '".$_SESSION["username"]."' AND `password` = '".md5($this->pass)."'");
						if(mysql_num_rows($valid) != 0)
						{
							if($this->u == "" || $this->u == null){
								$uname = mysql_fetch_array($valid);
								$this->u = $uname[0];
							}
							$sql = "UPDATE `admin` SET `username` = '".$this->u."',`password` = '".md5($this->pass1)."' WHERE CONVERT( `username` USING utf8 ) = '".$_SESSION["username"]."'" ;
							mysql_query($sql);
							return true;
						}
						else
							{return false;}
					}
					else
						{return false;}
			}
			else 
				{return false;}
	}
}
$change = new ChangePassword(htmlentities($_POST["pass"]),htmlentities($_POST["pass1"]),htmlentities($_POST["pass2"]),htmlentities($_POST["username"]));
if($change->change())
{
	log_event('password changed successfully from ip='.$_SERVER['REMOTE_ADDR']);
	echo ' ';
}
else
{
	log_event('password couldn\'t be changed from ip='.$_SERVER['REMOTE_ADDR']);
	echo 'username/password couldn\'t be changed.';
}
?>