<?php

session_start();

if (!isset($_SESSION['userID']) && !isset($_COOKIE['cookieMonster'])) {
  
  header("Location: login.php");
  exit;
  
} else {
  
  if ($_SESSION['timeout'] + 10 * 60 < time()) {
    
    header("Location: logout.php");
    
  } else {
    
    $_SESSION['timeout'] = time();
    
  }
  
}