<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Main Menu</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="style.css" rel="stylesheet" type="text/css"> 

</head>
<body>

<div class="header">
  <p><img src="images/Pages_logo.png" alt="Pages Bookstore Logo"/></p>
</div>

<div class="topnav">
  <a href = "index.html">Home</a>
  <a href = "logout.php">Log Out</a>
  
</div>        
    <div class="center">
    <h2 class="dark_grey">Main Menu</h2>
    </div>
<?php       
if(!(isset($_SESSION['username'])))     
{
    echo "<p class=\"center\">This page is restricted to logged in members.  </p>";
    echo "<p class=\"center\">Please return to the home page to sign up or log in to access this page. </p>";
    
}

else 
//Member only area 
{  
?>       
    <p class="center">Please choose a task:</p>
    
    <p class="center"><a href = "list_form.php">Listing Records</a></p>
    
    <p class="center"><a href = "search_form.php">Searching Records</a></p>
    
    <p class="center"><a href = "add_form.php">Adding A Record</a></p>
    
    <p class="center"><a href = "delete_form.php">Deleting A Record</a></p>
    
    <p class="center"><a href = "logout.php">Log Out</a></p>
    
<?php    
}   
?> 
   <footer>
    <p>
        Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
    </p>
</footer>
    
  </body>
</html>



