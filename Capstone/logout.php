<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<?php  
session_start();

$wasloggedin = false;  

if(isset($_SESSION['username']))
{
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
    $wasloggedin = true;    
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log Out</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>

<body>

<div class="header">
  <p><img src="images/Pages_logo.png" alt="Pages Bookstore Logo"/></p>
</div>

<div class="topnav">  
  <a href = "index.html">Home</a>
  <a href = "login_form.html">Log In</a>
</div>

<div>
<?php
    if ($wasloggedin == true)
    {    
    echo "<p style=\"color: black;\" class=\"center\">You have successfully logged out.  Please choose an option on the left to continue.</p>";        
    }
    else
    echo "<p style=\"color: black;\" class=\"center\">You were not logged in, so we could not log you out.  Please choose an option on the left to continue.</p>"; 
      
?> 

</div>
    
    
    
    <footer>
    <p>
        Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
    </p>
    </footer>
    
    
  </body>
</html>

