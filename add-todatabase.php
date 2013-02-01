<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>South Western State College-2012</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<?php
include 'log.php';
include "header.php";
if($_SESSION['admin']){
	if($_SESSION["lockentry"]!= "true"){
	$_SESSION["lockentry"]= "true";
include "sql_connection.php";
$flag = array();
for($i = 1; $i<=$_SESSION["count"];$i++)
{
	$project = htmlentities($_POST["project".$i]);
	$about = htmlentities($_POST["projectdetail".$i]);
	$sql = "INSERT INTO projects(project_name,college) VALUES('".$project."','".$about."')";
	if(mysql_query($sql))
	{
		log_event("project: '".$project."'/about: '".$about."' added successfully");
	}
	else {
	
		$_SESSION["insert_error"] =  "project of ".$project." couldn't be added to the database";
		log_event("project: '".$project."'/about: '".$about."' couldn't be added");
	}
}
echo $_SESSION["count"]."project/s added successfully.";
}
else {echo "projects are already entered!";}
}
else{
header("Location:index.php");
}
?>
<br/><a href = 'admincontrol.php'>ADMIN</a>