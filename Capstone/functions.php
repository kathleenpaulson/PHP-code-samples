<!--I certify that this submission is my own original work.  Kathleen Paulson-->
<?php  
  //********************************************************
  //          **FUNCTIONS TO ADD DATA in setupDB**
  //********************************************************
    function add_book($conn, $isbn, $title, $author_id, $publisher_id, 
    $published_year, $price)  
    {
    $query  = "INSERT INTO book VALUES('$isbn', '$title', '$author_id', 
        '$publisher_id', '$published_year', '$price')";
        
    if ($conn->query($query) === TRUE) 
      {
             echo "Add book $title was successful.";
      } 
    else 
      {
            die ("Add book $title was not successful: " . $conn->error);
      }    
  }  
  
  function add_user($conn, $username, $password, $email, $firstname, $lastname, $street_address, $city, $state, $zip)
  {
    $salt1 = bin2hex(openssl_random_pseudo_bytes(5));
    $salt2 = bin2hex(openssl_random_pseudo_bytes(5));  
    $token = hash('sha256', "$salt1$password$salt2");   
      
      
    $query = "INSERT INTO user (username, email, salt1, salt2, password, firstname, lastname, street_address, city, state, zip)
    VALUES ('$username', '$email', '$salt1', '$salt2', '$token', '$firstname', '$lastname', '$street_address', '$city', '$state', '$zip')";
            
    if ($conn->query($query) === TRUE) 
      {
            echo "";
      } 
    else 
      {
            return ("Add user $username was not successful: ");
      }   
  } 
  
  function add_author($conn, $lastname, $firstname, $middle_init, 
    $publisher_id)
  {
    $query  = "INSERT INTO author VALUES(DEFAULT, '$lastname', '$firstname', 
    '$middle_init', '$publisher_id')";
        
    if ($conn->query($query) === TRUE) 
      {
            echo "Add author $lastname, $firstname was successful.";
      } 
    else 
      {
            die ("Add author $lastname, $firstname was not successful: " . $conn->error);
      }   
  } 
  
  function add_publisher($conn, $publisher_name, $publisher_city, 
    $publisher_state, $publisher_country)
  {
    $query  = "INSERT INTO publisher VALUES(DEFAULT, '$publisher_name', 
        '$publisher_city', '$publisher_state', '$publisher_country')";
        
    if ($conn->query($query) === TRUE) 
      {
            echo "Add publisher $publisher_name was successful.";
      } 
    else 
      {
            die ("Add publisher $publisher_name was not successful: " . $conn->error);
      }   
  } 
 
  //********************************************************
  //          **FUNCTIONS TO SANITIZE STRINGS**
  //********************************************************                           
    function mysql_entities_fix_string($connection, $string)
    {
        return htmlentities(mysql_fix_string($connection, $string));
    }
    
    function mysql_fix_string($connection, $string)
    {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $connection->real_escape_string($string);
    }	
  //********************************************************
  //          **FUNCTIONS TO VALIDATE INPUT DATA**
  //********************************************************   
  function validate_username($conn, $user_name)
  {
    if ($user_name == "") 
    {
        return "No Username was entered<br>";
    }
    else 
    {
        if (strlen($user_name) < 6)
        {
            return "Usernames must be at least 6 characters<br>";
        }
        else if (preg_match("/[^a-zA-Z0-9_-]/", $user_name))
        {
            return "Only letters, numbers, - and _ in usernames<br>";
        }
        else 
        {
            $query = "SELECT * from user WHERE username='$user_name'";
            $result = $conn->query($query);
        
            if (!$result) return "Database access failed: $conn->error<br>";
        
            $rows = $result->num_rows;    
            if ($rows == 0)
            {
                return "";
            }
            else 
            {
                return "This username is taken.  Please choose a different user name<br>";
            }
        }
    }
    	
  }
  
  function validate_email($field)
  {
    if ($field == "") return "No Email was entered<br>";
      else if (!((strpos($field, ".") > 0) &&
                 (strpos($field, "@") > 0)) ||
                  preg_match("/[^a-zA-Z0-9.@_-]/", $field))
        return "The Email address is invalid<br>";
    return "";
    }
  
  function validate_password($field)
  {
    if ($field == "") 
    {
        return "No Password was entered<br>";
    }
    else 
    {
        if (strlen($field) < 8)
        {
            return "Passwords must be at least 8 characters<br>";
        }
        else if (!preg_match("/[a-z]/", $field) ||
             !preg_match("/[A-Z]/", $field) ||
             !preg_match("/[0-9]/", $field))
             {
                 return "Passwords require at least one each of a-z, A-Z and 0-9<br>";
             }
    }
    return "";
  }
  
  function validate_confirmpwd($pwd, $conf_pwd)
  {
    if ($conf_pwd == "") return "No confirm password was entered<br>";
    else if ($pwd !== $conf_pwd)
      return "Password and confirm password do not match.<br>";
    return "";
  }  
  
  function validate_firstname($firstname)
  {
    if ($firstname == "") return "No firstname was entered<br>";
    return "";
  }  
  
  function validate_lastname($lastname)
  {
    if ($lastname == "") return "No lastname was entered<br>";
    return "";
  } 
  
  function validate_streetaddress($street_address)
  {
    if ($street_address == "") return "No street address was entered<br>";
    return "";
  } 
  
  function validate_city($city)
  {
    if ($city == "") return "No city was entered<br>";
    return "";
  } 
  
  function validate_state($state)
  {
    if ($state == "") 
    {
        return "No state was entered<br>";
    }
    else 
    {
        if 
             (!(preg_match("/[A-Z]/", $state)))              
             {
                 return "State must be a 2 letter abbreviation using only capital letters<br>";
             }
    }
    return "";
  }
  
  function validate_zip($zip)
  {
    if ($zip == "") 
    {
        return "No zip was entered<br>";
    }
    else 
    {
        if 
             (!(preg_match("/[0-9]/", $zip)))              
             {
                 return "Zip must be numeric<br>";
             }
    }
    return "";
  } 
  
  function validate_isbn($isbn)
  {
    if ($isbn == "") 
    {
        return "No ISBN was entered<br>";
    }
    else 
    {
        if 
             (!(preg_match("/[0-9]/", $isbn)))              
             {
                 return "ISBN must be 13 digits and numeric<br>";
             }
    }
    return "";
  } 
  
  
    
?>