<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<?php 
  require_once 'login.php'; 
  require_once 'sessioncontrol.php'; 
  
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);    
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Form</title>
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

<h1 class="center">Search Records Form</h1>

<div style="text-align: center">
<form method="post" action="search_process.php"> 
<p>Please select the field to search:</p>

<select name="searchfield" size="4" required>
<option value="isbn">ISBN</option>
<option value="title">Title</option>
<option value="author">Author (Last Name)</option>
<option value="publisher_name">Publisher</option>
</select>
<p>Please enter your search text:</p>

<input type="text" name="searchvalue" required>

<input type="submit" value="Submit">
</pre></form>

<footer>
<p>
    Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
  </body>
</html>
