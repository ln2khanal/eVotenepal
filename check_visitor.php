<?php session_start();?>
<?php
include "sql_connection.php";
if($_SESSION["admin"])
{
	$name = $_POST["name"];
	$college = $_POST["college"];
	$roll_no = $_POST["roll_no"];
	$class = $_POST["class"];
	
	$sql = "SELECT * FROM visitors WHERE visitor_name = '".$name."' AND college = '".$college."' AND roll_no = '".$roll_no."' AND class = '".$class."'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		echo 'Error! Duplicate Entry!';
	}
	else
	{
		$sql = "INSERT INTO visitors(visitor_name,college,roll_no,class) VALUES('".$name."','".$college."','".$roll_no."','".$class."')";
		if(mysql_query($sql))
		{
			echo "Ok,Permit This Voter.";
		}
	}
}
else {echo'Bad request';}


?>