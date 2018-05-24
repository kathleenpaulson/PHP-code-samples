<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Process</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="bookstyles.css">
    
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
  
  if (isset($_POST['searchfield']))  
    $searchfield = $_POST['searchfield'];
    
  if (isset($_POST['searchvalue'])) 
  $searchvalue = mysql_entities_fix_string($conn, $_POST['searchvalue']); 
  
      
  
  
  if ($searchfield == "isbn")
  {
      echo "<div class=\"center2\">";
      echo "<p style=\"color: grey;\" class=\"center\">Search Results for ISBN: $searchvalue</p>";
      echo "<br>";    
      echo "</div>";   
      
      $query  = "SELECT isbn, title, firstname, lastname, publisher_name, 
      published_year, price FROM book
      NATURAL JOIN publisher NATURAL JOIN author where book.isbn = $searchvalue";
  }
  else if ($searchfield == "title")
  {
      echo "<div class=\"center2\">";
      echo "<p style=\"color: grey;\" class=\"center\">Search Results for Title: $searchvalue</p>";
      echo "<br>";    
      echo "</div>";
      
      $query  = "SELECT isbn, title, firstname, lastname, publisher_name, 
      published_year, price FROM book
      NATURAL JOIN publisher NATURAL JOIN author where book.title LIKE '%$searchvalue%'";
  }
  else if ($searchfield == "author") 
  {
      echo "<div class=\"center2\">";
      echo "<p style=\"color: grey;\" class=\"center\">Search Results for Author: $searchvalue</p>";
      echo "<br>";    
      echo "</div>";
      
      $query  = "SELECT isbn, title, firstname, lastname, publisher_name, 
      published_year, price FROM book NATURAL JOIN author NATURAL JOIN publisher where author.lastname LIKE '%$searchvalue%'";
  }   
  else 
  {
      echo "<div class=\"center2\">";
      echo "<p style=\"color: grey;\" class=\"center\">Search Results for Publisher: $searchvalue</p>";
      echo "<br>";    
      echo "</div>";
      
      $query  = "SELECT isbn, title, firstname, lastname, publisher_name, 
      published_year, price FROM book
      NATURAL JOIN publisher NATURAL JOIN author where publisher.publisher_name LIKE '%$searchvalue%'";
  }
  
      $result = $conn->query($query);
      if (!$result) die ("Database access failed: " . $conn->error);
      $rows = $result->num_rows;
      
      if (!$rows) 
      {
        echo "There are no results matching your criteria.";  
        exit;
      }
      else
      {
        echo "<table id=\"books\"> <tr> <th>ISBN</th> <th>Title</th> <th>Author</th> <th>Publisher</th> <th>Published Year</th> <th>Price (in USD$)</th> </tr>";  
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
                   
            echo "<tr>"; 	        
            echo "<td>$row[isbn]</td>";
            echo "<td>$row[title]</td>";
            echo "<td>$row[firstname] $row[lastname]</td>";
            echo "<td>$row[publisher_name]</td>";
            echo "<td>$row[published_year]</td>";
            echo "<td>$row[price]</td>";       
            
            echo "<tr>"; 
            
        }      
        echo "</table>";
      }
  
   
?>
   
<br>
<footer>
<p>
    Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
</body>
</html>
