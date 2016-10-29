<?php

include('session.php');
include('SQLFunctions.php');

$link = connectDB();

//Get userID, select corresponding diary content in SQL
$userID = $_SESSION['userID'];
$sql = "SELECT `userDiary` FROM `users` WHERE `userID` = '".$userID."'";

if ($result = mysqli_query($link, $sql)) {
  //Put content of diary into $row to echo in textarea
  $row = mysqli_fetch_array($result);
} else {
  echo "<br>SQL Error: ".mysqli_error($link);
}
mysqli_free_result($result);
mysqli_close($link);

?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>	
  </head>
  <body>
    <h1>My Secret Diary</h1>
    <textarea name="textarea" id="" cols="30" rows="10"><?php echo $row[0]; ?></textarea>
    <a href="logout.php">Logout?</a>

  <!--    jQuery        -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="main.js"></script>
  </body>
</html>