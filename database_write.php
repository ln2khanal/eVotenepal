<?php session_start();?>
<?php
include "log.php";
include "sql_connection.php";
$id = htmlentities($_POST["key"]);
$project = htmlentities($_POST["selected_project"]);
if ($_SESSION['route'] == htmlentities($_POST["tempcode"])){
	$sql = "SELECT * FROM `keis` WHERE `key`='".$id."' AND `status`='0'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 1)
	{
		$sql = "UPDATE `projects` SET `votes` = `votes`+'1' WHERE CONVERT( `projects`.`project_id` USING utf8 ) = '".$project."'";
		if(mysql_query($sql))
		{
			mysql_query("UPDATE `keis` SET `status` = '1',`voted_from` = '".$_SERVER['REMOTE_ADDR']."'  WHERE CONVERT( `key` USING utf8 ) = '".$id."'");			
			echo'1';
			log_event("voting was successful with the key:'".$id."' from '".$_SERVER['REMOTE_ADDR']);
			return;
		}
		else 
		{
			log_event("there was an error with the key:'".$id."' from '".$_SERVER['REMOTE_ADDR']);
			echo'Error: Your voting was not successful.';
			return;
		}
		
	}
	else 
	{
		log_event("voting attempt with the used or unknown key:'".$id."' from '".$_SERVER['REMOTE_ADDR']);
		echo'Error: The entered key is either invalid or already has been used.';
		return ;
	}
}
else{
	log_event("vote attempt from unauthorized route");
	echo "Request from wrong route.";
	return ;
	}
?>