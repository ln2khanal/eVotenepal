<?php session_start();
include "log.php";
?>
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
<script type = "text/javascript">
function check(name,college,roll_no,class_){
var xmlhttp ;

var params = "name="+name+"&college="+college+"&roll_no="+roll_no+"&class="+class_;
if(window.XMLHttpRequest){
	xmlhttp = new XMLHttpRequest();
}
else{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function(){

	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
		//document.getElementById("login").innerHTML=xmlhttp.responseText;
		if(xmlhttp.responseText == "Ok,Permit This Voter."){
		document.getElementById("check").innerHTML ='<div id = "sucess_message">'+xmlhttp.responseText+'</div>';
		}
		else
		document.getElementById("check").innerHTML ='<div id = "error_message">'+xmlhttp.responseText+'</div>';
	}
	setTimeout('window.location = "control.php"',2000)
	
}
//Willing to send the form data using POST method
xmlhttp.open("POST","check_visitor.php",true);
//These headers must be stated to inform the page about the request details.
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.setRequestHeader("Content-length", params.length);
xmlhttp.setRequestHeader("Connection", "close");

xmlhttp.send(params);
}
</script>


</head>

<body>
	
	<?php 

	//The site header is included here!
	include "header.php";
	?>
	<div id="container">
	<?php 
	
	include "slide.php";
	$value = $_POST["what"];
	include "sql_connection.php";
	if($value == "endvote")
	{
		mysql_query("UPDATE `permission` SET `completevote` = '1'");
		$sql = "UPDATE `permission` SET `resultpermission` = '1'";
		if(mysql_query($sql)){
		log_event("result view is allowed");
		}	
			log_event("voting completed successfully");
			echo'<div id = "admin_content"><br><a href = "result.php" target="blank" >GO FOR FINAL RESULT</a></div>';
	}
	else if($value == "generate_passwords")
	{
	$time1 = time();
	while(true)
		{
		$randomkey =substr(md5(rand()),0,6);
		if(mysql_query("INSERT INTO keis (`key`)VALUES ('".$randomkey."')"))
			{
				$file = fopen("passwords/pwd.docs","a") or die("Couldn't open the specified file");
				fwrite($file,$randomkey." Use this key to vote\n");
				fclose($file);
			}
			
			if((time() - $time1)>25){
				log_event("passwords are generated successfully");
				echo 'Passwords are generated successfully. GO<a href = "admincontrol.php">BACK</a>TO CONTROL ROOM.';
				
			break;
			}
		}
	}
	else if($value == "resetpasswords"){
		$sql = "UPDATE  `keis` SET  `status` =  '0' WHERE 1";
		if(mysql_query($sql)){
			log_event("all passwords are reset successfully");
			echo'<div id = "admin_content"><br>You can use all passwords that are previously used.GO <a href = "admincontrol.php" >BACK </a>TO CONTROL ROOM.</div>';
		}
	}
	
	else 
	{ ?><center><div id = "get_"><font color="red">Caution! Your typing mistake may lead to a fake vote count.</font>
	<table height="100%" width="50%"><tr><td>
		<li>Full Name:</td><td><input type = "text" name = "name" placeholder = "Visitor's Name" id = "name"></td></tr><tr><td width="200px"></li>
		<li>College Name:</td><td><input type = "text" name = "college" placeholder = "Visitor's College" id = "college"></td></tr><tr><td width="200px"></li>
		<li>Class :</td><td><input type = "text" name = "class" placeholder = "Class" id = "class"></td></tr><tr><td width="200px"></li>
		<li>Roll Number:</td><td><input type = "text" name = "name" placeholder = "Visitor's Roll no" id = "roll_no"></td></tr><tr><td width="200px"></li>

		<input width = "400px" type = "button" value = "CHECK THE AUTHENTICITY OF VOTER" onclick="check(document.getElementById('name').value,document.getElementById('college').value,document.getElementById('roll_no').value,document.getElementById('class').value)"></td><td width="200px"><div = id = "check"></div></td></tr></div></center></div>
	</div>
	</table>
	<?php }
			
		?>
		<div class="clear"></div>
    </div>
    </div>
	

<?php 
	//Another footer is included here!
	
	include "footer.php";
	?>
</body>
</html>
