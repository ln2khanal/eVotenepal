<?php session_start(); 
include "log.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vote Result</title>
<link rel="stylesheet" href="styles.css" type="text/css" />        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>

<script type="text/javascript" src="js/custom.js"></script>


</head>

<body>
	
	<div id="header">
    	<h1><a href="#"><strong>South Western State College</strong></a></h1>
        <h2>Final Result </h2>
        <div class="clear"></div>
    </div>
	<div id="container">
	<?php 
	
		include "slide.php";
		include "sql_connection.php";
			
		?>
		<div id= "admin_content">
		<?php
		$result = mysql_query("SELECT *FROM `permission`");
	
				$row = mysql_fetch_array($result);
				
				if($row["completevote"] == 1)
				{
			$sql = "SELECT *FROM `projects`ORDER BY votes DESC";
	
			$myresult = mysql_query($sql);
			for($i = 1;$i<=10;$i++)
			{				
				$sql = "SELECT `votes` FROM `projects` WHERE `project_id` = '".$i."'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
					{
						$vote_count =$vote_count + $row["votes"];
					}
			}
			echo'FINAL VOTE RESULT:<table height = "100%" width = "50%"  ><tr><td width = "50%" height = "25px"><b>PROJECTS:</b></td><td width = "50%"><center><b>VOTES:</b></center></td></tr>';
			$dcount = 1;
			while($row = mysql_fetch_array($myresult))
					{
						
						echo '<tr><td width = "50%"><h3>'.$dcount.'.<a href = "#">'.$row["project_name"].'</a></h3></td><td width = "50%" ><center><h3>'.(($row["votes"]/$vote_count)*100).'%</h3></center></td></tr>';
						
						$dcount++;
						
					}
	//Don't remove these three lines. To servive project these lines must be alive.
	//unlink("database_write.php");
	//unlink("admincontrol.php");
	//unlink("get_detail.php");
	//touch("database_write.php");
	//touch("admincontrol.php");
	//touch("get_detail.php");

		log_event("vote result viewed");
		echo'</center></table>';
		}
else
	echo'Voting is still going on, Please wait until the voting is completed!';
?>
	</div>
		<div class="clear"></div>
    </div>
    </div>
</div>
<?php 
	//Another footer is included here!
	include "footer.php";
	?>
</body>
</html>



