<?php
	session_start();
	$name = $_SESSION["name"];
		
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
     header("Location: login.php");	
      exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Write your post</title>
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
      <h1 class="w3-text-teal">Hi <?php echo "$name"?>, Write some fantastic post  <h6> By <?php echo "$name" ?> <h6> </h1>
    <form action="write_post.php" method="post" >
		Enter your topic: <input type="text" name="topic" width="100%" height="15"> <br>
				<p> </p>
				<h1> </h1>
				
				<p class="check">
				Enter your content here:
				<br>
				<textarea rows="4" cols="50" placeholder="Type something in" name="content">
</textarea> <br>
	
		
				<input type="submit" name="submit">
		</form>




		
	
	  
    </div>



</body>
</html>
