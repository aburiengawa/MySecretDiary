<?php

include('config.php');

function connectDB(){
  $link = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
  if ($link->connect_error){
    die("Connection error! ".$link->connect_error);
  }
  return $link;
}

?>