<?php

include('SQLFunctions.php');
session_start();

if (empty($_POST) && empty($_SESSION) && empty($_COOKIE)) {
  
  header('Location: login.php');
  exit;
  
}

if(isset($_SESSION['userID']) || isset($_COOKIE['cookieMonster'])) {
  
  header('Location: index.php');
  exit;
  
}

if (!empty($_POST)) {
  
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  
  $link = connectDB();
  
  $sql = "SELECT `userID` FROM `users` WHERE `userEmail` = '".mysqli_real_escape_string($link, $email)."' LIMIT 1";
  
  if ($result = mysqli_query($link, $sql)) {
    //Check if it matches a row in the DB
    if (mysqli_num_rows($result) > 0) {
      //If it matches a row, extract password
      $row = mysqli_fetch_array($result);
      $password = md5(md5($row['userID']).$password);
      
      //Query for password matches
      $sql = "SELECT `userID` `userEmail` FROM `users` WHERE `userEmail` = '".mysqli_real_escape_string($link, $email)."' AND `userPass` =  '".mysqli_real_escape_string($link, $password)."' LIMIT 1";
      
      if ($result = mysqli_query($link, $sql)) {
        //Check if password matches
        if(mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_array($result);
  
        //Assign SESSION variables
        $_SESSION['userID'] = $row[0];
        $_SESSION['timeout'] = time();
        
        //Assign COOKIE variables if checkbox input is true
        if (isset($_POST['cookie'])) {  
          $number_of_days = 3;
          $expiry_date = time() + 60 * 60 * 24 * $number_of_days;
          setcookie("cookieMonster", $row[0], $expiry_date);
        }
          
        header('Location: index.php');
        
        } else {
        //Password match fail
          echo "<br>Sorry, wrong email or password";
        }
        
      } else {
        //Query for password match fails
        echo mysqli_error($link);
      }
      
    } else {

      echo "<br>Sorry, wrong email or password";
    }
    
  } else {
    //Query for checking for user existence fails, show errow
    echo mysqli_error($link);
  }
  
  mysqli_free_result($result);
  mysqli_close($link);

} else {
  //If POST is empty
  header('Location: login.php');
}

?>
