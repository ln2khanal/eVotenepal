<?php session_start();?>
<title>South Western State College-2013</title>
<link rel="stylesheet" href="styles.css" type="text/css" />        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>

<script type="text/javascript" src="js/custom.js"></script>
<script type = "text/javascript">
function check(number){
var xmlhttp ;
var params = "number="+number;


if(window.XMLHttpRequest){
	xmlhttp = new XMLHttpRequest();
}
else{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function(){

	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
		//document.getElementById("login").innerHTML=xmlhttp.responseText;
		
		document.getElementById("number").innerHTML =xmlhttp.responseText;
	}
	
}
//Willing to send the form data using POST method
xmlhttp.open("POST","add-project.php",true);
//These headers must be stated to inform the page about the request details.
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.setRequestHeader("Content-length", params.length);
xmlhttp.setRequestHeader("Connection", "close");

xmlhttp.send(params);
}
function check_key(key){
var xmlhttp ;
var params = "key="+key;


if(window.XMLHttpRequest){
	xmlhttp = new XMLHttpRequest();
}
else{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function(){

	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
		//document.getElementById("login").innerHTML=xmlhttp.responseText;
		
		document.getElementById("check_key").innerHTML =xmlhttp.responseText;
	}
	
}
//Willing to send the form data using POST method
xmlhttp.open("POST","check_key.php",true);
//These headers must be stated to inform the page about the request details.
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.setRequestHeader("Content-length", params.length);
xmlhttp.setRequestHeader("Connection", "close");

xmlhttp.send(params);
}
function register(projects,about){
var xmlhttp ;
var params = "projects="+projects+"&about="+about;


if(window.XMLHttpRequest){
	xmlhttp = new XMLHttpRequest();
}
else{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function(){

	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
		//document.getElementById("login").innerHTML=xmlhttp.responseText;
		
		document.getElementById("admin_content").innerHTML =xmlhttp.responseText;
	}
	
}
//Willing to send the form data using POST method
xmlhttp.open("POST","add-todatabase.php",true);
//These headers must be stated to inform the page about the request details.
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.setRequestHeader("Content-length", params.length);
xmlhttp.setRequestHeader("Connection", "close");

xmlhttp.send(params);
}

</script>


</head>

<body>
<div id="header">
		<!-- Insert the school logo here!-->
    	<h1><a href="http://localhost/swsc/"><strong>South Western State College</strong></a></h1>
        <h2>Adminstration...</h2>
        <div class="clear"></div>
    </div>	
	<div id = "admin_content">
<?php if($_SESSION['admin']) {
	include "sql_connection.php";
	$result = mysql_fetch_array(mysql_query("SELECT lockhome,completevote FROM permission"));

 	if($result[0] == 0)
 	{

	 	?>
<h2><u>Setting up the platform...</u></h2>
<div id = "number">
<p>Enter no of projects:<br>
<form name = "get_count" action = "get_detail.php" method = "POST">
<input type = "text" name = "no" id = "no" placeholder = "Projects"></p>
<input type = "submit" value = "ENTER"  ></form>
<?php } else if($result[1] == 0){ ?>
<form name = "control" action = "control.php" method = "post">
<div id = "success_message"><i>Welcome Admin.</i><br/></div>
<?php if($_SESSION["iamadmin"] == true){
$totalpasswords = mysql_fetch_array(mysql_query("SELECT count(*) from `keis`"));
$remainingpasswords = mysql_fetch_array(mysql_query("SELECT count(*) from `keis` WHERE `status`=0"));

?>
</br>
<input type = "text" name = "key_tocheck" placeholder = "Enter key to check" id = "key_tocheck"><br>
<input type = "button"  value = "Check" onclick = "check_key(document.getElementById('key_tocheck').value)"><div id = "check_key"></div>
<?php 
echo "Active passwords: '".$remainingpasswords[0]."' out of '".$totalpasswords[0]."'.";
?>
<li><input type = "radio" name = "what" value = "endvote">End vote</li>
<li><input type = "radio" name = "what" value = "generate_passwords">Generate Passwords</li>
<li><input type = "radio" name = "what" value = "resetpasswords">Reset All Passwords</li>

<?php 
}
?>
<li><input type = "radio" name = "what" value = "check_visitor">Enter Visitor</li>
<input type = "submit" value = "CONFORM">
</form>
<?php }
else {echo "Voting is completed.Thanks for using this application. If you have any suggestions,please contact developer at <b><u>ln2khanal@gmail.com</u></b>";} 
}
else {
echo 'You don\'t have permission. Grant permission <a href="adminlogin.php">here</a>.';
}
?>
</div></div>
<?php include 'footer.php';?>
