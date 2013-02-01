<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>South Western State College-2013</title>
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
	<?php 
		//include "slide.php";
			$result = mysql_fetch_array(mysql_query("SELECT lockhome,completevote FROM permission"));
			if($result[2]== 0){
				$_SESSION["completevote"]= "false";
			} else if($result[2]== 1){
				$_SESSION["completevote"]= "true";
			}
			
			if($result[1]== 0){
				$_SESSION["lockhome"] = "false";
			}else if($result[1]== 1){
				$_SESSION["lockhome"] = "true";
			}
			
	if($_SESSION["completevote"] != "true"){
		include "list.php";
	}
	else {?>
	<div id="admin_content">Voting is over! Thanks for using this application.&nbsp;Please suggest software &nbsp;<a href='http://www.facebook.com/ln2khanal' target="blank">developer</a> for any issues.</div><br/>
		
	<?php }?>
		<div class="clear"></div>
    </div>
<?php 
	//footer is included here!
	include "footer.php";
	?>
</body>
</html>
