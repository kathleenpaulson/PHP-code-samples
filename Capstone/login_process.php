<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style2.css">
    
</head>

<body>

<div class="header">
  <p><img src="images/Pages_logo.png" alt="Pages Bookstore Logo"/></p>
</div>

<div class="topnav">
  <a href = "login_form.html">Log In</a>
  <a href = "logout.php">Log Out</a>
  <a href = "mainmenu.php">Main Menu</a>
</div>
<?php 
  require_once 'login.php';  
  require_once 'functions.php';  
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);

  if (isset($_POST['username']) &&
      isset($_POST['password']))
  {
    $un_temp = mysql_entities_fix_string($connection, $_POST['username']);
    $pw_temp = mysql_entities_fix_string($connection, $_POST['password']);

    $query = "SELECT * FROM user WHERE username='$un_temp'";
    $result = $connection->query($query);

    if (!$result) die($connection->error);
	elseif ($result->num_rows)
	{
		$row = $result->fetch_array(MYSQLI_NUM);

		$result->close();
                
                $salt1 = $row[2];
                $salt2 = $row[3]; 
                $token = hash('sha256', "$salt1$pw_temp$salt2");          
		
		if ($token == $row[4])
		{
			session_start();
			$_SESSION['username'] = $un_temp;
			$_SESSION['password'] = $pw_temp;    
                        $_SESSION['firstname'] = $row[5];
                        $_SESSION['lastname'] = $row[6];
                                      
			
			echo "<p class = \"center\">Welcome, $row[5] $row[6]!</p>";
			echo "<p class = \"center\">You may now access the functions by clicking the Main Menu tab on the left.</a></p>";
		}
		else 
                {
                    echo "<p class = \"center\">Invalid username/password combination</p>";
                    echo "<p style=\"color: grey;\" class=\"center\">Please click the Log In tab to try again.</p>";
                }
                
	}
	else 
        {
        echo"<p class = \"center\">Invalid username and/or password</p>";
        echo "<p style=\"color: grey;\" class=\"center\">Please click the Log In tab to try again.</p>";
        }
  }
  else 
  {
  echo "<p class = \"center\">Connection issue.  r</p>";
  echo "<p style=\"color: grey;\" class=\"center\">Please click the Log In tab to try again.</p>";
  }
  
?>
    
   <footer>
    <p>
        Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
    </p>
</footer>
    
</body>
</html>
