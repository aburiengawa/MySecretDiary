<?php

//include('session.php');
include('SQLFunctions.php');

if (!empty($_POST)) {
  
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  echo "<br>".$email;
  echo "<br>".$password;
  
  if (strlen($password) > 7 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //Test to see if password has at least 8 characters

    $link = connectDB();

    $sql = "SELECT `userEmail` FROM `users` WHERE `userEmail` = '".mysqli_real_escape_string($link, $email)."'";

    if ($result = mysqli_query($link, $sql)) {
      //If query is run, check if it matches a row in the DB
      if (mysqli_num_rows($result) > 0) {
        //If it matches a row in the DB, then user exists
        echo "<br>Email already exists";
        echo "<br><a href='index.php'>Home</a>";
        
      } else {
        //If user does not exist, then insert into DB
        $sql = "INSERT INTO `users` (`userEmail`) VALUES ('".mysqli_real_escape_string($link, $email)."')";

        if (mysqli_query($link, $sql)) {
          //If query inserts new data, insert email then prepare password
          $sql = "SELECT `userID` FROM `users` WHERE `userEmail` = '".mysqli_real_escape_string($link, $email)."' LIMIT 1";

          $result = mysqli_query($link, $sql);
          $row = mysqli_fetch_array($result);

          $password = md5(md5($row['userID']).$password);

          $sql = "UPDATE `users` SET `userPass` = '".mysqli_real_escape_string($link, $password)."' WHERE `userID` = ".$row['userID']." LIMIT 1";

          if(mysqli_query($link, $sql)) {
            //if password was updated, inform user
            echo "<br>User created";
            echo "<br><a href='index.php'>Home</a>";

          } else {
            //password update fail
            echo "<br>Error ".mysqli_error($link);
          }

        } else {
          //user email insert fail
          echo "<br>Error: ".mysqli_error($link);
        }
      }

    } else {
      //user exists query fails
      echo mysqli_error($link);
    }

    mysqli_free_result($result);
    mysqli_close($link);
  
  } else {
    //Redirect to login if password is less than 8 characters or email invalid
    header('Location: login.php');
  }

} else {
  //If POST is empty
  header('Location: login.php');
}

?>