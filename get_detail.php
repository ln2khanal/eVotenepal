<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>South Western State College-2012</title>
<link rel="stylesheet" href="styles.css" type="text/css" />        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>

<script type="text/javascript" src="js/custom.js"></script>


</head>

<body>
	
	<?php 
	//The site header is included here!
	include "header.php";
	include "sql_connection.php";
	?>
	<div id="container">
		<div id = "admin_content">
   
<?php 
mysql_query("UPDATE permission SET lockhome='1'");

if($_SESSION['admin']){
$count = $_POST["no"];
$_SESSION['count'] = $count;

if($_SESSION["lockentry"] != "true"){
//$_SESSION["lockhome"]="true";
?>
<form name = "add_projects" action = "add-todatabase.php" method = "post">
Please provide the project's short info in not more than 100 letters.<br/>
<?php
for($i = 1 ;$i<=$count;$i++)
	{
	echo'STALL ID:<br><input type = "text" name = "project'.$i.'" id = "name'.$i.'" placeholder = "Stall id "><br>
	Project'.$i.' TITLE:<br><textarea rows = "2" cols = "50" name = "projectdetail'.$i.'" id = "about'.$i.'" placeholder = "Title of project "></textarea><br/><br/><br/>';	
	
	}
	echo'<input type = "submit" value = "SEND"/></form>';

}
else { echo $_SESSION['count']." Project(s) is/are already entered!";}

 }
else echo 'bad request';
	
	?>
</div>
	</div>
		<div class="clear"></div>
		<?php include "footer.php"; ?>
</body>
</html>
