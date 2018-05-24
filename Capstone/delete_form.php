<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<?php 
  require_once 'login.php'; 
  require_once 'sessioncontrol.php'; 
  require_once 'functions.php';
  
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Form</title>
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
  $query  = "SELECT * FROM book";
  $result = $connection->query($query);
  if (!$result) die ("Database access failed: " . $connection->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
 
    //This subquery gets the author information   
    $subquery = "SELECT * FROM author WHERE author_id = '$row[2]'";
    $subresult = $connection->query($subquery);
    if (!$subresult) die ("Database access failed: " . $conn->error);
    $subrow = $subresult->fetch_array(MYSQLI_NUM);  
    
    //This subquery gets the publisher information   
    $subquery2 = "SELECT * FROM publisher WHERE publisher_id = '$row[3]'";
    $subresult2 = $connection->query($subquery2);
    if (!$subresult2) die ("Database access failed: " . $conn->error);
    $subrow2 = $subresult2->fetch_array(MYSQLI_NUM);      

echo <<<_END
  <pre>
  
  
     ISBN       $row[0]
     Title      $row[1]
     Author     $subrow[1], $subrow[2] $subrow[3]
     Publisher  $subrow2[1] 
     Year       $row[4]
     Price      $row[5]      
  </pre>
    
  <form action="delete_process.php" method="post">
  <input type="hidden" name="isbn" value="$row[0]"> 
  <input type="submit" name="submit" value="DELETE RECORD">
  </form> 
  
_END;
  }
  
  $result->close();
  
?>
    
            
<footer>
<p>
Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
  </body>
</html>
