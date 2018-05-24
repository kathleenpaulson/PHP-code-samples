<!--I certify that this submission is my own original work.  Kathleen Paulson-->

<?php 
  require_once 'login.php';
  require_once 'functions.php';
  
  $connection = new mysqli($hn, $un, $pw, $db);
  if ($connection->connect_error) die($connection->connect_error); 

  $username = $email = $password = $confirmpwd = "";
  
  if (isset($_POST['username']))  
    $username = mysql_entities_fix_string($connection, $_POST['username']);
  if (isset($_POST['email']))
    $email = mysql_entities_fix_string($connection, $_POST['email']);
  if (isset($_POST['password']))
    $password = mysql_entities_fix_string($connection, $_POST['password']);
  if (isset($_POST['confirmpwd']))
    $confirmpwd = mysql_entities_fix_string($connection, $_POST['confirmpwd']);
  if (isset($_POST['firstname']))
    $firstname = mysql_entities_fix_string($connection, $_POST['firstname']);
  if (isset($_POST['lastname']))
    $lastname = mysql_entities_fix_string($connection, $_POST['lastname']);
  if (isset($_POST['street_address']))
    $street_address = mysql_entities_fix_string($connection, $_POST['street_address']);
  if (isset($_POST['city']))
    $city = mysql_entities_fix_string($connection, $_POST['city']);
  if (isset($_POST['state']))
    $state = mysql_entities_fix_string($connection, $_POST['state']);  
  if (isset($_POST['zip']))
    $zip = mysql_entities_fix_string($connection, $_POST['zip']);

  $fail  = validate_username($connection, $username);
  $fail .= validate_password($password);
  $fail .= validate_email($email);
  $fail .= validate_confirmpwd($password, $confirmpwd);
  $fail .= validate_firstname($firstname);
  $fail .= validate_lastname($lastname);
  $fail .= validate_streetaddress($street_address);
  $fail .= validate_city($city);
  $fail .= validate_state($state);
  $fail .= validate_zip($zip);
  
  echo "<!DOCTYPE html>\n<html lang=\"en\"><html><head><title>Sign Up Process</title>"; 
  echo "<meta charset=\"utf-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
  echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\">"; 
 
echo <<<_END
    
</head>

<body>

<div class="header">
  <p><img src="images/Pages_logo.png" alt="Pages Bookstore Logo"/></p>
</div>

<div class="topnav">
  <a href = "index.html">Home</a>  
  <a href = "login_form.html">Log In</a>
  <a href = "signup_form.html">Sign Up</a>
</div>
      

_END;

  if ($fail == "")
  {
  	$fail_useradd = add_user($connection, $username, $password, $email, $firstname, $lastname, $street_address, $city, $state, $zip);
  	if ($fail_useradd == "") 
  	{
echo <<<_END
	    <div>
	        <p><img class = "displayed" src="images/Professor.gif"></p>
            </div>
	                        
            <div>
	        <h1 class="center">Congratulations, <?php>$firstname $lastname<?>!</h1>
	        <h2 class="center">You have successfully registered.</h2>
	        <h3 class="center">You may now click on the left to log in.</h3>
                <br>
                
            </div>
            
                    
_END;

    		exit;
  	}        
        
}
        
  else 
  {   
      echo "<div class=\"center\">";   
      echo"<tr>";
      echo"<td colspan=\"2\" >Sorry, the following errors were found in your form";
      echo"<p><font color=red size=1><i>$fail</i></font></p></td></tr>";      
      
      echo "<p class=\"center\">Your registration was unsuccessful.  Please return to the sign up page to try again. </p>";
      echo "</div>";     
  }

echo <<<_END

<footer>
<p>
Pages Bookstore &bull; 22 East Main Street &bull; Port Jefferson, NY 11777
</p>
</footer>
</footer>   
_END;
  

echo "</body>";
echo "</html>"; 

?>