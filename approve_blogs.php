<?php
$connect = mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
if (!$connect)
	 {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	 }
	
	$mysql = "select * from blogs";
	$query = mysqli_query($connect,$mysql);
	$row = mysqli_num_rows($query);	

?>


<?php


	$blog_id = $_POST["blog_id"];
 if (isset($_POST["no"]))
   {
	$query_update = "update blogs set post_status='Rejected' where post_id='$blog_id'";
	if (!mysqli_query($connect, $query_update))
	{
		echo ("Some thing wrong with the database");	
	}	
   }
else 
	{
$query_update = "update blogs set post_status='Approved' where post_id='$blog_id'";
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
		if ($row_query["post_status"] == "Pending") {
		echo ' <div class="w3-row w3-padding-64">';
		echo '<div class="w3-twothird w3-container">';
		echo '<h1 class="w3-text-teal">'.$row_query["post_title"].'</h1>';
		echo "<p>". $row_query["post_content"] ."</p>";
		echo '</div>';
		echo '<div class="w3-third w3-container">';
		echo '<p class="w3-border w3-padding-large w3-padding-32 w3-center"> picture</p>';
		echo '<p class="w3-border w3-padding-large w3-padding-64 w3-center">picture</p>';
		echo ' </div>';
		echo ' </div>';
		echo '<div>';	
		echo '<form action="" id="usrform" method="post"> ';
		echo '<input type="submit" value="Reject" name="no">';
		echo '<input type="submit" value="Approve" name ="yes">';
		echo '<input type="hidden"  name="blog_id" value="' . htmlspecialchars($row_query["post_id"]) . '">';
		echo '</form>';
		echo '</div>';	
		echo ' <hr>';
		}

		}


	}
	?>
    

</body>
</html>
