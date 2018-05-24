<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Process</title>
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
  
  if (isset($_POST['isbn'])   &&   
      isset($_POST['lastname'])    &&
      isset($_POST['firstname']) &&
      isset($_POST['middle_init'])   &&
      isset($_POST['title'])     &&
      isset($_POST['published_year']) &&
      isset($_POST['publisher_name']) &&
      isset($_POST['publisher_city']) &&
      isset($_POST['publisher_state']) &&
      isset($_POST['publisher_country']) &&
      isset($_POST['price']))
      
  {
    $isbn = mysql_entities_fix_string($conn, $_POST['isbn']);  
    $lastname = mysql_entities_fix_string($conn, $_POST['lastname']);
    $firstname = mysql_entities_fix_string($conn, $_POST['firstname']);
    $middle_init = mysql_entities_fix_string($conn, $_POST['middle_init']);
    $title = mysql_entities_fix_string($conn, $_POST['title']);
    $published_year = mysql_entities_fix_string($conn, $_POST['published_year']);
    $publisher_name = mysql_entities_fix_string($conn, $_POST['publisher_name']);    
    $publisher_city = mysql_entities_fix_string($conn, $_POST['publisher_city']);
    $publisher_state = mysql_entities_fix_string($conn, $_POST['publisher_state']);
    $publisher_country= mysql_entities_fix_string($conn, $_POST['publisher_country']);
    $price= mysql_entities_fix_string($conn, $_POST['price']);
    
    $query  = "SELECT * from publisher where (publisher_name = '$publisher_name' 
    and publisher_state = '$publisher_state')"; 
      
    $result = $conn->query($query);
      if (!$result) die ("Database access failed query1: " . $conn->error);
      $rows = $result->num_rows;
      
      if (!$rows) 
      {
        
        $stmt = $conn->prepare("INSERT INTO publisher (publisher_name, publisher_city, publisher_state, publisher_country) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $publisher_name, $publisher_city, $publisher_state, $publisher_country);


          $stmt->execute();
          
          
          printf("%d Publisher row inserted.\n", $stmt->affected_rows);
          echo "<br>";
          $publisher_id = $conn->insert_id;
          $stmt->close();
      }
      else if ($rows == 1)
      {
          $result->data_seek(0);  
          $row = $result->fetch_array(MYSQLI_ASSOC);        
          $publisher_id = $row['publisher_id'];
      }    
      else die ("Duplicate publisher ids exist in the table.");
      
    $query  = "SELECT author_id from author where (lastname = '$lastname' and firstname = '$firstname' and middle_init = '$middle_init')"; 
      
    $result = $conn->query($query);
      if (!$result) die ("Database access failed: " . $conn->error);
      $rows = $result->num_rows;
      
      if (!$rows) 
      {
        $stmt = $conn->prepare('INSERT INTO author (lastname, firstname, middle_init, publisher_id) VALUES(?,?,?,?)');
        $stmt->bind_param('sssi', $lastname, $firstname, $middle_init, $publisher_id);
      
        $stmt->execute();
        printf("%d Author row inserted.\n", $stmt->affected_rows);
        echo "<br>";
        $author_id = $conn->insert_id;
        $stmt->close();
      }
      else if ($rows == 1)
      {
          $result->data_seek(0); 
          $row = $result->fetch_array(MYSQLI_ASSOC); 
          $author_id = $row['author_id'];
          
      }    
      else die ("Duplicate author ids exist in the table.");
      
      
      $query  = "SELECT * FROM book where isbn = $isbn"; 
      
      $result = $conn->query($query);
      if (!$result) die ("Database access failed: " . $conn->error);
      $rows = $result->num_rows;
      
      if (!$rows) 
      {
        $stmt = $conn->prepare('INSERT INTO book (isbn, title, author_id, publisher_id, published_year, price) VALUES(?,?,?,?,?,?)');
        $stmt->bind_param('ssiiid', $isbn, $title, $author_id, $publisher_id, $published_year, $price);      
        $stmt->execute();
        printf("%d Book row inserted.\n", $stmt->affected_rows);  
        echo "<br>";    
        $stmt->close();
      }
      else die ("This book already exists in the database.");
 
  } 
    
  $conn->close();

?>

<footer>
<p>
Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
</body>
</html>