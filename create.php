<?php
//process.php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {//Check it is coming from a form
    
		//mysql credentials
    $mysql_host = "localhost";
    $mysql_username = "chan123";
    $mysql_password = "Spaceship12";
    $mysql_database = "AnimalDatabase";
	
	//delcare PHP variables
	
	$Dog = $_POST["Dog"];
	$Breed = $_POST["Breed"];
	$Origin = $_POST["Origin"];
	
	//Open a new connection to the MySQL server
	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}   
	
		$statement = $mysqli->prepare("INSERT INTO DogTable(Dog, Breed, Origin) VALUES(?, ?, ?)"); //prepare sql insert query
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('sss', $Dog, $Breed, $Origin); //bind value
		if($statement->execute())
			{
				//print output text
				echo nl2br("Hello "." ". $Dog . "! We are so glad you have taken ". $Breed.  "\r\nIn your ". $Origin ."th year.", false);
			}
			else{
					print $mysqli->error; //show mysql error if any 
				}

         }
else{
    echo ("error");
    }         
?>