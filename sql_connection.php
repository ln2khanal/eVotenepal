<?php
  $db_link = mysql_connect("localhost","root");
  if(!$db_link)
    die("Error: Database connection refused! " .mysql_errno());
    
  $db_select=mysql_selectdb("swsc",$db_link);
  if(!$db_select)
  die("Error: Database not found! ".mysql_errno());
   
?>
