<?php 
$connect=mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
// Check connection
if (!$connect)
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else 
	{
	}
?>


<?php
	session_start();
	// Fetching the data from the user table
	$user_id = $_SESSION["user_id"];
		$new = $_POST["new"];	
		if ($new != "" ) {
		$mysql = "update user set password='$new' where user_id='4'";
		if(!mysqli_query($connect,$mysql))
		{
			echo ("Something went wrong");
		}	
	}

?>

<!DOCTYPE html>

<html>
	<head>
		<title> Reset the password </title>

		
	</head>
	<body>
	<form action="" method="post">
	New Password: <input type="text" name="new">	
	<input type="submit" value="Reset" onClick="">
	</form>

	</body>

</html>


