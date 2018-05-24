<!--I certify that this submission is my own original work.  Kathleen Paulson-->

<?php
//all php functions are located in functions.php
require_once 'functions.php';

//log in as root to create database
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
} 
else
{
        echo "Connected successfully"; 
} 

echo "<br><br>";
  
  // Create database bookdepot
  $sql = "CREATE DATABASE bookstore";
  if ($conn->query($sql) === TRUE) 
  {
	 echo "Database created successfully";
  } 
  else 
  {
	die( "Error creating database: " . $conn->error);
  }
  
  echo "<br><br>";
  
  //Grant database access to 'jim'
  
  $query = "GRANT ALL PRIVILEGES ON bookstore.* TO 'jim'@'localhost' 
  IDENTIFIED BY 'mypasswd'";
  
  if ($conn->query($query) === TRUE) 
  {
	 echo "Grant all privileges to jim on bookstore database was successful.";
  } 
  else 
  {
	die ("Error granting privileges to 'jim': " . $conn->error);
  }
  
  echo "<br><br>";

  
  //Use bookdepot database
  $query = "USE bookstore";
  
  if ($conn->query($query) === TRUE) 
  {
	 echo "USE bookstore query was successful.";
  } 
  else 
  {
	die ("USE bookstore query was not successful: " . $conn->error);
  }
  
  echo "<br><br>";
  
  //********************************************************
  //************************CREATE TABLES*******************
  //********************************************************

    //Create publisher table
    $query = "CREATE TABLE publisher (
    publisher_id MEDIUMINT NOT NULL AUTO_INCREMENT,     
    publisher_name VARCHAR(50) NOT NULL,
    publisher_city VARCHAR(50) NOT NULL,
    publisher_state CHAR(2),
    publisher_country VARCHAR(50) NOT NULL,
    INDEX(publisher_name(25)), 
    INDEX(publisher_city(10)),
    INDEX(publisher_country(10)),       
    PRIMARY KEY (publisher_id)
    )";  
  
  if ($conn->query($query) === TRUE) 
  {
        echo "CREATE TABLE publisher was successful.";
  } 
  else 
  {
        die ("CREATE TABLE publisher was not successful: " . $conn->error);
  }
  
  echo "<br><br>";
  
  //Create author table
  $query = "CREATE TABLE author (
    author_id MEDIUMINT NOT NULL AUTO_INCREMENT,     
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    middle_init CHAR(1),
    publisher_id MEDIUMINT NOT NULL,
    INDEX(lastname(10)), 
    INDEX(firstname(10)),   
    PRIMARY KEY (author_id)
  )";  
  
  if ($conn->query($query) === TRUE) 
  {
	echo "CREATE TABLE author was successful.";
  } 
  else 
  {
	die ("CREATE TABLE author was not successful: " . $conn->error);
  }
  
  echo "<br><br>"; 
  
  //Create book table
  $query = "CREATE TABLE book (
    isbn CHAR(13) NOT NULL,    
    title VARCHAR(128) NOT NULL,
    author_id MEDIUMINT NOT NULL,
    publisher_id MEDIUMINT NOT NULL,
    published_year YEAR,
    price DECIMAL (6,2),
    INDEX(title(20)),
    PRIMARY KEY (isbn)
  )";  
  
  if ($conn->query($query) === TRUE) 
  {
	echo "CREATE TABLE book was successful.";
  } 
  else 
  {
	die ("CREATE TABLE book was not successful: " . $conn->error);
  }
  
  echo "<br><br>";
  
  //Create user table
  $query = "CREATE TABLE user (
    username VARCHAR(20) NOT NULL,
    email    VARCHAR(40) NOT NULL,
    salt1    CHAR(10) NOT NULL,
    salt2    CHAR(10) NOT NULL,
    password CHAR(64) NOT NULL,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    street_address VARCHAR (50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    state CHAR(2) NOT NULL,
    zip CHAR(5) NOT NULL,
    INDEX(email(10)),
    INDEX(username(10)),
    INDEX(firstname(6)),
    INDEX(lastname(10)),
    INDEX(street_address(25)), 
    INDEX(city(15)),
    PRIMARY KEY (username)
  )";
  
  if ($conn->query($query) === TRUE) 
  {
	echo "CREATE TABLE user was successful.";
  } 
  else 
  {
	die ("CREATE TABLE user was not successful: " . $conn->error);
  }
  
  echo "<br><br>";
  
  //********************************************************
  //******************INSERT DATA INTO TABLES***************
  //******************************************************** 
  
  
  //Insert data into user table
  $username = "JoeBookworm";
  $password = "Mypasswd1";
  $email = "jbookworm@gmail.com";    
  $firstname = "Joe";
  $lastname = "Jonas";
  $street_address = "1330 12th Street";
  $city = "West Babylon";
  $state = "NY";
  $zip = "11704"; 
  add_user($conn, $username, $password, $email, $firstname, $lastname, $street_address, $city, $state, $zip);
  echo "<br><br>";
  
  //Insert data into user table
  $username = "JaneReady";
  $password = "Mypasswd1";
  $email = "jready@gmail.com"; 
  $firstname = "Jane";
  $lastname = "Ready";
  $street_address = "111 State Street";
  $city = "Holbrook";
  $state = "NY";
  $zip = "11729";  
  add_user($conn, $username, $password, $email, $firstname, $lastname, $street_address, $city, $state, $zip);
  echo "<br><br>";
  
  //Insert data into user table
  $username = "Angelica123";
  $password = "Mypasswd1";
  $email = "angelica@gmail.com"; 
  $firstname = "Angelica";
  $lastname = "Paulson";
  $street_address = "27 Barraud Drive";
  $city = "Setauket";
  $state = "NY";
  $zip = "11778"; 
  add_user($conn, $username, $password, $email, $firstname, $lastname, $street_address, $city, $state, $zip);
  echo "<br><br>";
  
  //Insert data into user table
  $username = "KathyP123";
  $password = "Mypasswd1";
  $email = "KathyP@gmail.com"; 
  $firstname = "Kathy";
  $lastname = "Paulson";
  $street_address = "24 Kensington Way";
  $city = "Port Jefferson Station";
  $state = "NY";
  $zip = "11776"; 
  add_user($conn, $username, $password, $email, $firstname, $lastname, $street_address, $city, $state, $zip);
  echo "<br><br>";
  
  //Insert data into publisher table
  $publisher_name = "Wiley";
  $publisher_city = "Hoboken";
  $publisher_state = "NJ";
  $publisher_country = "US";
  add_publisher($conn, $publisher_name, $publisher_city, 
  $publisher_state, $publisher_country);
  
  echo "<br><br>";
  
  //Insert data into publisher table
  $publisher_name = "Ballantine Books";
  $publisher_city = "New York";
  $publisher_state = "NY";
  $publisher_country = "US";
  add_publisher($conn, $publisher_name, $publisher_city, 
  $publisher_state, $publisher_country); 
  
  echo "<br><br>";
  
  //Insert data into publisher table
  $publisher_name = "Simon & Schuster Books for Young Readers";
  $publisher_city = "New York";
  $publisher_state = "NY";
  $publisher_country = "US";
  add_publisher($conn, $publisher_name, $publisher_city, 
  $publisher_state, $publisher_country); 
  
  echo "<br><br>";
  
  //Insert data into publisher table
  $publisher_name = "Little, Brown and Company";
  $publisher_city = "New York";
  $publisher_state = "NY";
  $publisher_country = "US";
  add_publisher($conn, $publisher_name, $publisher_city, 
  $publisher_state, $publisher_country); 
  
  echo "<br><br>";
  
  //******************************
  //Insert data into author table
  //*****************************
  $query = "SELECT publisher_id from publisher WHERE (publisher_name = 'Wiley') 
  AND (publisher_state = 'NJ')";
      
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $lastname = "Valade";
  $firstname = "Janet";
  $middle_init = "";
  $publisher_id = $thispublisher_id;
  
  add_author($conn, $lastname, $firstname, $middle_init, $publisher_id);
  
  echo "<br><br>";
  
  //*********************************************************************
  //*********************************************************************
  
  //Insert data into author table
  $query = "SELECT publisher_id from publisher WHERE (publisher_name = 'Ballantine Books') 
  AND (publisher_state = 'NY')";
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $lastname = "Picoult";
  $firstname = "Jodi";
  $middle_init = "";
  $publisher_id = $thispublisher_id; 
  
  add_author($conn, $lastname, $firstname, $middle_init, $publisher_id);
  
  echo "<br><br>"; 
  
  //*********************************************************************
  //*********************************************************************  
  
  
  
  //Insert data into author table
  $query = "SELECT publisher_id from publisher WHERE (publisher_name = 'Little, Brown and Company') 
  AND (publisher_state = 'NY')";
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $lastname = "Abbott";
  $firstname = "Megan";
  $middle_init = "E";
  $publisher_id = $thispublisher_id; 
  
  add_author($conn, $lastname, $firstname, $middle_init, $publisher_id);
  
  echo "<br><br>"; 
  
  //*********************************************************************
  //*********************************************************************
  
  //Insert data into author table
  $query = "SELECT publisher_id from publisher WHERE (publisher_name = 'Simon & Schuster Books for Young Readers') 
  AND (publisher_state = 'NY')";
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $lastname = "Buckley-Archer";
  $firstname = "Linda";
  $middle_init = "";
  $publisher_id = $thispublisher_id; 
  
  add_author($conn, $lastname, $firstname, $middle_init, $publisher_id);
  
  echo "<br><br>";  
  
  
  
  //************************************************
  //Insert data into book table   
  //************************************************
  
  //Get the author_id for the author to be inserted for this book
  $query = "SELECT author_id from author WHERE (lastname = 'Valade') 
  AND (firstname = 'Janet') AND (middle_init = ' ')";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Author_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thisauthor_id = $obj->author_id;
  } 
  else 
  {
	die ("Author_id search was not successful: " . $conn->error);
  }
  
  
  $query = "SELECT publisher_id from publisher WHERE publisher_name = 'Wiley' AND publisher_state = 'NJ'";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $isbn     = '9780470527580';  
  $title    = 'PHP & MySQL for dummies';
  $author_id   = $thisauthor_id;
  $publisher_id = $thispublisher_id;
  $published_year     =  2010;
  $price     = 67.95; 
  add_book($conn, $isbn, $title, $author_id, $publisher_id, 
    $published_year, $price);  
    
  echo "<br><br>";  
    
  //************************************************
  //Insert data into book table   
  //************************************************  
 //Get the author_id for the author to be inserted for this book
  $query = "SELECT author_id from author WHERE (lastname = 'Picoult') 
  AND (firstname = 'Jodi') AND (middle_init = ' ')";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Author_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thisauthor_id = $obj->author_id;
  } 
  else 
  {
	die ("Author_id search was not successful: " . $conn->error);
  }
  
  
  $query = "SELECT publisher_id from publisher WHERE (publisher_name = 'Ballantine Books') 
  AND (publisher_state = 'NY')";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
    
    
  //Insert data into book table 
  $isbn     = '9780345544926';
  $title    = 'Leaving time : a novel';
  $author_id   = $thisauthor_id;  
  $publisher_id = $thispublisher_id;
  $published_year     =  2015;
  $price     = 24.95;  
  add_book($conn, $isbn, $title, $author_id, $publisher_id, 
    $published_year, $price);
    
  echo "<br><br>";  
  
  
  //************************************************
  //Insert data into book table   
  //************************************************
  
  //Get the author_id for the author to be inserted for this book
  $query = "SELECT author_id from author WHERE (lastname = 'Buckley-Archer') 
  AND (firstname = 'Linda') AND (middle_init = ' ')";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Author_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thisauthor_id = $obj->author_id;
  } 
  else 
  {
	die ("Author_id search was not successful: " . $conn->error);
  }
  
  
  $query = "SELECT publisher_id from publisher WHERE publisher_name = 'Simon & Schuster Books for Young Readers' AND publisher_state = 'NY'";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $isbn     = '9781416915256';  
  $title    = 'Gideon the cutpurse : being the first part of the Gideon trilogy';
  $author_id   = $thisauthor_id;
  $publisher_id = $thispublisher_id;
  $published_year     =  2006;
  $price     = 34.99; 
  add_book($conn, $isbn, $title, $author_id, $publisher_id, 
    $published_year, $price);  
    
  echo "<br><br>";  
    
    
  //************************************************
  //Insert data into book table   
  //************************************************
  
  //Get the author_id for the author to be inserted for this book
  $query = "SELECT author_id from author WHERE (lastname = 'Abbott') 
  AND (firstname = 'Megan') AND (middle_init = 'E')";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Author_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thisauthor_id = $obj->author_id;
  } 
  else 
  {
	die ("Author_id search was not successful: " . $conn->error);
  }
  
  
  $query = "SELECT publisher_id from publisher WHERE publisher_name = 'Little, Brown and Company' AND publisher_state = 'NY'";
  
  if ($result = $conn->query($query)) 
  {
	 echo "Publisher_id search was successful.";
         $obj=mysqli_fetch_object($result);
         $thispublisher_id = $obj->publisher_id;
  } 
  else 
  {
	die ("Publisher_id search was not successful: " . $conn->error);
  }
  
  $isbn     = '9780316231077';  
  $title    = 'You will know me';
  $author_id   = $thisauthor_id;
  $publisher_id = $thispublisher_id;
  $published_year     =  2016;
  $price     = 22.99; 
  add_book($conn, $isbn, $title, $author_id, $publisher_id, 
    $published_year, $price);  
    
  echo "<br><br>";  
      
?>
  
  





