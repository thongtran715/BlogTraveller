<?php 
#hello World
$connect=mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
// Check connection
if (!$connect)
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else 
	{
	}
	
	session_start();	
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
     header("Location: login.php");	
      exit();
}
	
	$sql_blogs_not_from_current_user = "select * from blogs";
	$result_blogs = mysqli_query ($connect, $sql_blogs_not_from_current_user);
	$rowcount_blogs = mysqli_num_rows($result_blogs);
	
?>

<?php


	$blog_id = $_POST["post_id"];
 if (isset($_POST["no"]))
   {
	
	$query_update = "delete from comments where post_id='$blog_id'";
	if (!mysqli_query($connect, $query_update))
	{
		echo ("Some thing wrong with the database");	
	}		
	$query_update = "delete from blogs where post_id='$blog_id'";
	if (!mysqli_query($connect, $query_update))
	{
		echo ("Some thing wrong with the database");	
	}	
	
   }

?>


<!DOCTYPE html>
<html>
<title>Delete Post</title>
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
  <a class="w3-bar-item w3-button w3-hover-black" href="">My Post</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="admin.php">Home</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="reset_password.php">Reset Password </a>
  <a class="w3-bar-item w3-button w3-hover-black" href="approve_blogs.php">Approve post</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="delete_post.php">Delete post </a>
    <a class="w3-bar-item w3-button w3-hover-black" href="delete_user.php">Delete user </a>


</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

<?php
if ($rowcount_blogs > 0) {
	while($row_blogs = mysqli_fetch_assoc($result_blogs)) {

	if ($row_blogs["post_status"] == "Approved") {
		$user_post_that_blog = $row_blogs["uid"];
		$blog_id = $row_blogs["post_id"];
		$fetch_user = "select * from user where user_id= '$user_post_that_blog'";
		$result_fetch_user = mysqli_query($connect,$fetch_user);
		$row_fetch_user = mysqli_fetch_assoc($result_fetch_user);	
		$username = $row_fetch_user["firstName"]. " ". $row_fetch_user["lastName"];
		$date = $row_blogs["post_date"];
		echo ' <div class="w3-row w3-padding-64">';
		echo '<div class="w3-twothird w3-container">';
		$title = $row_blogs["post_title"];
		echo "<a   class='w3-text-teal' href=detail_post.php?bid=",$blog_id,">$title</a>";
		echo "<h6> By ". $username ." </h6>";
		echo "<h6> Posted on ". $date. " </h6>";
		echo "<p>". $row_blogs["post_content"] ."</p>";
		echo '</div>';
		echo '<div class="w3-third w3-container">';
		echo ' </div>';
		echo ' </div>';
		echo '<form action="" id="usrform" method="post"> ';
		echo '<input type="submit" value="Delete this post" name="no">';
		echo '<input type="hidden"  name="post_id" value="' . htmlspecialchars($blog_id) . '">';
		echo '</form>';
		}
	} 
}
else {
	echo ("There is no post to delete from the system");

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


