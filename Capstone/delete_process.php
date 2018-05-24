<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>

<body>

<div class="header">
  <p><img src="images/Pages_logo.png" alt="Pages Bookstore Logo"/></p>
</div>

<div class="topnav">
  <a href = "logout.php">Log Out</a>
  <a href = "mainmenu.php">Main Menu</a>
</div>

<?php 
  require_once 'login.php'; 
  require_once 'sessioncontrol.php'; 
  require_once 'functions.php'; 
  
  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error); 
  
  if (isset($_POST['submit']) && isset($_POST['isbn']))
  {
    $isbn = mysql_entities_fix_string($conn, $_POST['isbn']);    
    
    $query  = "DELETE FROM book WHERE isbn='$isbn'";
    $result = $conn->query($query);
  	if (!$result) 
        {
            echo "DELETE failed: $query<br>" .$conn->error . "<br><br>";
        }
        else
        {
            echo "Your record was deleted successfully.";
        }
  }
  else echo "Submit and post not ok";
?>

<footer>
<p>
Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
</body>
</html>