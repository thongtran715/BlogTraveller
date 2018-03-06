

<?php
// This will write the post to the mysql db
$connect=mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
// Check connection
if (!$connect)
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  session_start();
  $post_title = $_POST["topic"];
  $post_content = $_POST["content"];
  $post_status = "Pending";
  $post_author = $_SESSION["name"];
  $post_date = date("Y/m/d"); 
  $uid = $_SESSION["user_id"];
  echo ("$post_author");
  echo ("$uid");
?>

