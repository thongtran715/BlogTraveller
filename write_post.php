

<?php
// This will write the post to the mysql db
$connect=mysqli_connect("localhost","rahmed13","rahmed13","rahmed13");
// Check connection
if (!$connect)
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  session_start();
		
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
     header("Location: login.php");	
      exit();
}
  $post_title = $_POST["topic"];
  $post_content = $_POST["content"];
  $post_status = "Pending";
  $post_author = $_SESSION["name"];
  $post_date = date("Y/m/d"); 
  $uid = $_SESSION["user_id"];
	
?>
<!DOCTYPE html>

<html>
	<head>
		<title> Submit blogs </title>	

	</head>
	<body>
		<?php
			$last_insert_id = "";	
			if ($post_title != "" and $post_content != "")
			{
			
			$sql = "insert into blogs (uid,post_status,post_title,post_content,post_author,post_date) values ('$uid', '$post_status', '$post_title','$post_content','$post_author','$post_date')";
			if (!mysqli_query($connect, $sql))
			{
				echo ("Some thing wrong with the database");	
			}	
			else 
				{
				$last_insert_id = mysqli_insert_id($connect);
				if ($_SESSION["admin"] == 0)	{
			
				echo ("Your blog has been sent and being reviewed by our admin. Stay tuned"); echo ("<br>");
				echo ('<a href="VerifiedUser.php"> Click here to go back to main </a>');	
				}
				else {
				
				echo ("Your blog has been sent and being reviewed by another admin. Stay tuned"); echo ("<br>");
				echo ('<a href="admin.php"> Click here to go back to main </a>');	
				}
				
				}
			}
	
		?>
	</body>


</html>





