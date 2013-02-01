<?php 
function log_event($message){
# total average time taken to execute this method is 0.002... 
	$log = fopen("logs/log.txt",a) or die("Couldn't open the log file.");
	if($log)
	{
		fwrite($log,date("Y-m-d:h-i-s")."|\t ".$message.".\n");
	}
	fclose($log);
	return ;
}
?>