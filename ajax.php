<?php

include('session.php');
include('SQLFunctions.php');

if (isset($_POST['content'])) {
	
  $textarea = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
  $content = $textarea;
  $content = $_POST['content'];

  $link = connectDB();
  $userID = $_SESSION['userID'];
  $sql = "UPDATE `users` SET `userDiary` = '".mysqli_real_escape_string($link, $content)."' WHERE `userID` = '".$userID."'";
  
  mysqli_query($link, $sql);
  mysqli_close($link);

} else {
  
  header('Location: login.php');
  
}

?>