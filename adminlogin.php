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
<script type = "text/javascript">
function check(action){
var xmlhttp ;
if(action == 'login'){
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var params = "username="+username+"&password="+password;
	var url = "login.php";
}
else if (action == 'change'){
	var pass = document.getElementById('opass').value;
	var pass1 = document.getElementById('pass1').value;
	var pass2 = document.getElementById('pass2').value;
	var username = document.getElementById('username').value;
	var params = "pass="+pass+"&pass1="+pass1+"&pass2="+pass2+"&username="+username;
	var url = "changepassword.php";
}
if(window.XMLHttpRequest){
	xmlhttp = new XMLHttpRequest();
}
else{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
document.getElementById("login").innerHTML ='<div id = "success_message">waiting server response...</div>';
xmlhttp.onreadystatechange=function(){

	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
		if(xmlhttp.responseText == " "){
			document.getElementById("login").innerHTML = "Operation successful.";
		}
		else
		{
			document.getElementById("login").innerHTML ='<div id = "error_message">'+xmlhttp.responseText+'</div>';
		}
	setTimeout('window.location = "admincontrol.php"',2000);
	}
}
//Willing to send the form data using POST method
xmlhttp.open("POST",url,true);
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
		if(!$_SESSION['admin']){
	?>
	<form name = "adminlogin" action = "" method = "">
	<input type = "text" name = "username" id = "username" placeholder= "Username"><br/>
	<input type = "password" name = "password" id = "password" placeholder= "Password"><br/>
	<input type = "button" value = "LOGIN" onclick = "check('login')">
	</form>
	
	<div id ="success_message">
	<?php }else{?>
	<div id ='error_message'>CHANGE USERNAME/PASSWORD:</div>
	<table><tr><td width='50px'>
	<form name = "adminform" action = "" method = "">
	New Username</td><td width='50px'><input type = "text" name = "username" id = "username" placeholder= "New username"></td></tr><tr><td width='50px'>
	Current Password</td><td width='50px'><input type = "password" name = "password" id = "opass" placeholder= "Current password"></td></tr><tr><td width='50px'>
	New Password</td><td width='50px'><input type = "password" name = "password" id = "pass1" placeholder= "New password"></td></tr><tr><td width='50px'>
	Retype Password</td><td width='50px'><input type = "password" name = "password" id = "pass2" placeholder= "Re-password"></td></tr><tr><td width='50px'>
	<input type = "button" value = "CHANGE" onclick = "check('change')"></td><td width='50px'>Leave 'New username' field blank to use existing username.
	</form>
	</td></tr>
	</table>
	<?php }?>
		<div class="clear"></div>
    </div>
	<div id = "login"></div>
	</div>
	
    
    </div>
	
</div>
<?php 
	//Another footer is included here!
	include "footer.php";
	?>
</body>
</html>
