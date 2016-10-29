<?php

session_start();

if (!isset($_SESSION['userID']) && !isset($_COOKIE['cookieMonster'])) {
  //No session, no cookie = NO HONEY!
  header("Location: login.php");
  exit;
  
} else {
  
  if ($_SESSION['timeout'] + 10 * 60 < time()) {
    //Logout if session expired
    header("Location: logout.php");
    
  } else {
    //Reset time if session still unexpired
    $_SESSION['timeout'] = time();
    
  }
  
}