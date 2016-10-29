<?php

include('session.php');

//End SESSION
session_unset();
session_destroy();

//End COOKIE
$expiry_date = time() - 60;
setcookie("cookieMonster", "", $expiry_date);

echo "<h1>You are logged out</h1>";
echo "<br>";
echo "<a href='index.php'>Home</a>";

?>