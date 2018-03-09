<?php
	session_start();
	session_unset();
		
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
     header("Location: login.php");	
      exit();
}else {
	header("Location: login.php");
	exit();
}

?>
