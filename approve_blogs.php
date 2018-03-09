<?php
$connect = mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
if (!$connect)
	 {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	 }
	session_start();	
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
     header("Location: login.php");	
      exit();
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
<title>User Home Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}
</style>
<body>

<!-- Navbar -->


<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
 <h4 class="w3-bar-item"><b>Menu</b></h4>
<a class="w3-bar-item w3-button w3-hover-black" href="my_post.php">My Post</a>
<a class="w3-bar-item w3-button w3-hover-black" href="admin.php">Home</a>
<a class="w3-bar-item w3-button w3-hover-black" href="reset_password.php">Reset Password </a>
<a class="w3-bar-item w3-button w3-hover-black" href="approve_blogs.php">Approve post</a>
<a class="w3-bar-item w3-button w3-hover-black" href="delete_post.php">Delete post </a>
  <a class="w3-bar-item w3-button w3-hover-black" href="delete_user.php">Delete user </a>
  <a class="w3-bar-item w3-button w3-hover-black" href="sign_out.php">Sign Out </a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">
 
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
  
<!-- END MAIN -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
   
