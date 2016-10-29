<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
  <body>
    
      <h3>Sign up</h3>
      
      <form action="AddUser.php" method="post">
         <p>Email: 
          <input type="email" name="email" required>
           Password: 
          <input type="password" name="password" pattern=".{8,}" title="8 or more characters" required>
          <input type="submit" value="Sign up">
        </p>   
      </form>
      
      <h3>Log in</h3>
      
      <form action="SignIn.php" method="post">
        <p> Email: 
          <input type="email" name="email" required>
           Password: 
          <input type="password" name="password" required>
          <small>&nbsp;Keep me signed in!</small>
          <input type="checkbox" name="cookie" value="1">
          <input type="submit" value="Log in">
        </p>
      </form>
      
      <p><a href=""><small>Forgot your password?</small></a></p>
      <p><a href=""><small>Hate your life?</small></a></p>
    
  </body>
</html>