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
    <title>Add Form</title>
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
    


<p class="center">Please complete this form to add a record.</p>
<p class="center">(Fields with a '*' are required.)  </p>
<form action="add_process.php" method="post"><pre>
*ISBN (13 digits)          <input type="text" name="isbn" maxlength="13" min="13" required>
*Author - Last Name        <input type="text" name="lastname" required>
*Author - First Name       <input type="text" name="firstname" required>
 Author - Middle Initial   <input type="text" name="middle_init" >
*Title                     <input type="text" name="title" required>
 Year of Publication       <input type="text" name="published_year" maxlength="4" min="4" >
*Publisher                 <input type="text" name="publisher_name" required> 
*Publisher City            <input type="text" name="publisher_city" required> 
 Publisher State           <input type="text" name="publisher_state"> 
*Publisher Country         <input type="text" name="publisher_country" required>
 Price                     <input type="text" name="price">  
      
                <input type="reset" value="Reset"></input>     <input type="submit" value="ADD RECORD">
  </pre></form>

    
<footer>
<p>
Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
    
  </body>
</html>
