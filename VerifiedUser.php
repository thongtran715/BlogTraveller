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
	session_start();
	$userEmail = "kim@student.cs.gsu.edu";
	$password = "123";
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
  <a class="w3-bar-item w3-button w3-hover-black" href="#">Reset Password </a>
  <a class="w3-bar-item w3-button w3-hover-black" href="Write_post.html">Write Post </a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

<?php
if ($rowcount_blogs > 0) {
	while($row_blogs = mysqli_fetch_assoc($result_blogs)) {
		if ($row_blogs["post_status"] == "Approved") {
		echo ' <div class="w3-row w3-padding-64">';
		echo '<div class="w3-twothird w3-container">';
		echo '<h1 class="w3-text-teal">'.$row_blogs["post_title"].'</h1>';
		echo "<p>". $row_blogs["post_content"] ."</p>";
		echo '</div>';
		echo '<div class="w3-third w3-container">';
		echo '<p class="w3-border w3-padding-large w3-padding-32 w3-center"> picture</p>';
		echo '<p class="w3-border w3-padding-large w3-padding-64 w3-center">picture</p>';
		echo ' </div>';
		echo ' </div>';
		
		echo '<div>';
		echo '<form action="/action_page.php" id="usrform">';
		echo 'Comment here : <input type="text" name="usrname">';
		echo '<input type="submit">';
		echo '</form>';
		echo '</div>';
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
