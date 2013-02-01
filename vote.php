<?php session_start();?>
<title>South Western State College-2012</title>
<link rel="stylesheet" href="styles.css" type="text/css" />        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type = "text/javascript">
    function check(key,selected_project,tmp){
		var xmlhttp ;
        var params = "key="+key+"&selected_project="+selected_project+"&tempcode="+tmp;
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	
                //document.getElementById("login").innerHTML=xmlhttp.responseText;

                if(xmlhttp.responseText == "1"){
                    document.getElementById("msg").innerHTML ='<img src = "images/success.png"/><div id = "sucess_message">Sucess! Thanks for voting. Have a great Day!</div>';
                }
                else {
                    document.getElementById("msg").innerHTML ='<img src = "images/error.png"/><div id = "error_message">'+xmlhttp.responseText+'</div>';
                }
            }
            setTimeout('window.location = "index.php"',2000);
	
        }
        //Willing to send the form data using POST method
        xmlhttp.open("POST","database_write.php",true);
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
    $id = $_GET["id"];
	$tc = $_GET["tempcode"];
    ?>
    <div id="container">
        <?php
        //include "slide.php";
        ?>
        <div class="sidebar">
            <li>
                <ul>	

                    <li>
                        <h4><span>Finishing Vote:</span></h4>
                        <ul class="blocklist"><br><div id = "msg">
                        <center><font color="green"><strong>PLEASE BELOW ENTER THE PASSWORD PROVIDED.</strong></font><br/>
                                <input type = "password" name = "key" id = "pass" placeholder = "Your Voting Key:"><br/><br/>
                                <input type = "button" value = "VOTE NOW" onclick = "check(document.getElementById('pass').value,'<?php echo $id;?>','<?php echo $tc;?>');"></div></center>
                        </ul> 
                    </li>
                </ul>
            </li>
        </div>
        <div class="clear"></div>
    </div>

</div>

</div>
<?php
include "footer.php";
?>
</body>

