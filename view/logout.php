<?php
session_start();


if  (isSet($_SESSION["username"])) {
	
	session_unset();		
	session_destroy();														
}

echo "session destroyed";
echo "->".$_SESSION."<-";
header("Location: main.php");
?>
