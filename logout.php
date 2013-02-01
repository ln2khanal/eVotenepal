<?php session_start();?>
<?php 
if($_SESSION["admin"]){
	session_destroy();
	}
	header("Location:index.php");
?>