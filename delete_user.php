<?php
$connect = mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
if (!$connect)
	 {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	 }
	
	$mysql = "select * from user";
	$query = mysqli_query($connect,$mysql);
	$row = mysqli_num_rows($query);	

?>


<?php


	$user_id = $_POST["user_id"];
	echo ($user_id);
 if (isset($_POST["no"]))
   {




	$query_update = "delete from blogs where uid='$user_id'";
	if (!mysqli_query($connect, $query_update))
	{
		echo ("Some thing wrong with the database");	
	}	
	
	$query_update = "delete from comments where uid='$user_id'";
	if (!mysqli_query($connect, $query_update))
	{
		echo ("Some thing wrong with the database");	
	}		

	$query_update = "delete from user where user_id='$user_id';";
	if (!mysqli_query($connect, $query_update))
	{
		echo ("Some thing wrong with the database");	
	}
   }

?>
<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
p{
 width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
}
</style>


</head>
<body>

</div>
<div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h6 style="text-align: center;"> Admin User name </h6>
	 


	<?php

	if ($row > 0)
	{

		while ($row_query = mysqli_fetch_assoc($query))
		{
		echo ' <div class="w3-row w3-padding-64">';
		echo '<div class="w3-twothird w3-container">';
		echo '<h1 class="w3-text-teal">'.$row_query["firstName"]. ' '. $row_query["lastName"].'</h1>';
		echo "<p>". $row_query["userEmail"] ."</p>";
		echo '</div>';
		echo '<div class="w3-third w3-container">';
		echo '<p class="w3-border w3-padding-large w3-padding-32 w3-center"> picture</p>';
		echo '<p class="w3-border w3-padding-large w3-padding-64 w3-center">picture</p>';
		echo ' </div>';
		echo ' </div>';
		echo '<div>';	
		echo '<form action="" id="usrform" method="post"> ';
		echo '<input type="submit" value="Delete this user" name="no">';
		echo '<input type="hidden"  name="user_id" value="' . htmlspecialchars($row_query["user_id"]) . '">';
		echo '</form>';
		echo '</div>';	
		echo ' <hr>';
		}
	}
	?>
    

</body>
</html>
