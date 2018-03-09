<?php
	
	session_start();
	$username = $_POST["username"];
	$password = $_POST["password1"];

	if (isset($username))
	{

	unset($_SESSION["errorMessage"]);	
	$_SESSION["username"] = $username;	
	// Fetch if the user is there 
	// Connect with db
	$connect = mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
	if (!$connect)
	{
		echo "Failed to connect to mySQL". mysqli_connect_error();
	
	}	
	$sql_user = "select * from user where userEmail='$username' and password='$password' limit 1";
	$result_user = mysqli_query($connect,$sql_user);
	$row_count_result = mysqli_num_rows($result_user);
	if ($row_count_result != 1)
	{
		header("Location: login.php");
		exit();	
	}
	else
	{
		$row_user = mysqli_fetch_assoc($result_user);
		$_SESSION["user_id"] = $row_user["user_id"];
		$_SESSION["name"] = $row_user["firstName"]. " ". $row_user["lastName"];		

		$_SESSION["admin"] = $row_user["adminUser"];
		// check if the user is admin. Navigate them to admin page
		if ($_SESSION["admin"] == 1)
		{
			header("Location: admin.php");
			exit();
		}
		else {
		header("Location: VerifiedUser.php");
		exit();
		}
	}

	}
?>
