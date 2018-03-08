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
	// Fetching the data from the user table
	session_cache_limiter('private, must-revalidate');
	session_cache_expire(60);
	session_start();
	$userEmail = "kim@student.cs.gsu.edu";
	$password = "cac";
	$sql_user = "select * from user where userEmail='$userEmail' and password='$password'";
	$result_user = mysqli_query($connect,$sql_user);
	$rowcount_user = mysqli_num_rows($result_user);
	$row_user = mysqli_fetch_assoc($result_user);
	$userid = $row_user["user_id"];
	$_SESSION["name"] = $row_user["firstName"]. " ". $row_user["lastName"];
	$_SESSION["user_id"] = $userid;
	// Fetching data from blogs table based on the uid 
	$sql_blogs_not_from_current_user = "select * from blogs where blogs.uid != '$userid'";
	$result_blogs = mysqli_query ($connect, $sql_blogs_not_from_current_user);
	$rowcount_blogs = mysqli_num_rows($result_blogs);
?>


<?php
	// Trigger the comments function 
	$comment = $_POST["comment"];
	$blog_id = $_POST["blog_id"];
	$date = date("Y/m/d");
	
	if ($comment != "")
	{
		$insert_comment = "insert into comments (post_id,uid,comment_text,comment_date) values('$blog_id','$userid','$comment','$date')";
		if (!mysqli_query($connect,$insert_comment))
		{
			echo ("Something wrong");
		}
	}
?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
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
  <a class="w3-bar-item w3-button w3-hover-black" href="#">Home</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="reset_password.php">Reset Password </a>
  <a class="w3-bar-item w3-button w3-hover-black" href="layout_write.php">Write Post </a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

<?php
if ($rowcount_blogs > 0) {
	while($row_blogs = mysqli_fetch_assoc($result_blogs)) {

	if ($row_blogs["post_status"] == "Approved") {
		// Now fetching all the data for comments
	$post_comment_id = $row_blogs["post_id"];
	$sql_comment = "select * from comments where post_id='$post_comment_id'";	
	$sql_comment_query = mysqli_query($connect,$sql_comment);
	$rowcountcomments = mysqli_num_rows($sql_comment_query);

		
		// once we have the blogs. We need to reverse engineering to find the user that posts that post
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
		echo '<div>';
		echo '<form action="" id="usrform" method="post"> ';
		echo 'Comment here : <input type="text" name="comment">';
		echo '<input type="hidden"  name="blog_id" value="' . htmlspecialchars($row_blogs["post_id"]) . '">';
		echo '<input type="submit" value="Comment">';
		echo '</form>';

		if ($rowcountcomments > 0) {

			echo '<ul>';
			while ($row_comments = mysqli_fetch_assoc($sql_comment_query)){
				$user_comment = $row_comments["uid"];	
				$fetch_user = "select * from user where user_id= '$user_comment'";
				$result_fetch_user = mysqli_query($connect,$fetch_user);
				$row_fetch_user = mysqli_fetch_assoc($result_fetch_user);	
				$username = $row_fetch_user["firstName"]. " ". $row_fetch_user["lastName"];
				echo ("<li>". $username. ": " . $row_comments["comment_text"] . "</li>");		
			}
			echo '</ul>';
			echo '</div>';
		}	
	}
	} 
}
	?>

  



  <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
     <?php
      $name =  $row_user["firstName"]. " " . $row_user["lastName"];
      echo "<h4>".$name . "'s Blog". "</h4>";
     ?>
    </div>

    
  </footer>

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
