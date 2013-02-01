<?php session_start();?>
<?php 
include 'log.php';
include "sql_connection.php";
if($_SESSION["admin"])
{
	$key = htmlentities($_POST["key"]);
	
	$result = mysql_query("SELECT *
FROM `keis`
WHERE `key` = CONVERT( _utf8 '".$key."'
USING latin1 )");

	$r = mysql_fetch_array($result);
	
	if(mysql_num_rows($result) == 1)
	{
		if($r["status"] == 1){
		echo "Key: <b>".$r[0]."</b><br/>Status: <b>Used successfully.</b><br/>Voted through: <b>".$r[2]."</b>";
		}		
		else {
		echo "Key: <b>".$r[0]."</b><br/>Status: <b>Active</b>";
		}
	}
	else 
	{
		echo "The key <b>'".$key."'</b> was not issued!";
	}
	log_event("voting key '".$key."'checked for status check");
}
else
 {
	echo "You don't have permission.";
}

?>