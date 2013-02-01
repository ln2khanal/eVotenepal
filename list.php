<?php session_start(); ?>
<?php include "sql_connection.php";?>

<div class="sidebar">
		<li>
            <ul>
                <li>
                    <h4><span>Please vote your favorite  project</span></h4>
					<ul class="blocklist">
					<?php 
					$i=1;
						$sql = "SELECT * FROM projects";
						$result = mysql_query($sql);
						$temp_code = md5(rand());
						$_SESSION['route'] = $temp_code;
						while($row = mysql_fetch_array($result))
						{
							?>
							<li><div id="list_body"><a href="vote.php?id=<?php echo $row["project_id"];?>&tempcode=<?php echo $temp_code;?>" title = "<?php echo $row["college"];?>"><?php echo $i.". <u>".$row["project_name"]."</u>:   <b>".$row["college"]."</b>";
							$i++;
						}?>
						</a></li></div>
            </ul> 
			</li>
			</ul>
			</li>
        </div>