<HTML>
    <HEAD> <link rel='stylesheet' href='styles.css'></HEAD><BODY>";
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")	//Check it is coming from a form
    {
    $mysql_host = "localhost";
    $mysql_username = "chan123";
    $mysql_password = "Spaceship12";
    $mysql_database = "AnimalDatabase";
    
	    //delcare PHP variables
	    $Dog = $_POST["Dog"];
	    $Breed = $_POST["Breed"];			//The values in the $_POST must match the names given from the HTML document
	    $Origin = $_POST["Origin"];
	    
        $mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
        if ($mysqli->connect_error) 
            {
		        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	        }   
        if ($_POST['Breed']!= "")
            {
                
	
		$statement = $mysqli->prepare("UPDATE DogTable SET Dog= ?, Breed=?, Origin=?"); //prepare sql insert query - thank you(https://stackoverflow.com/questions/6514649/php-mysql-bind-param-how-to-prepare-statement-for-update-query)
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('sss', $Dog, $Breed, $Origin); //bind value
		if($statement->execute())
			{
				//print output text
				echo nl2br("You have updated "." ". $Dog . "'s information to" . $Breed." ". $Origin ."Origin.", false);
			}
			else{
					print $mysqli->error; //show mysql error if any 
				}
                
            }
    }
echo"<br><form action= 'back.php' method = 'get'>";
echo "<input name = 'action'   type = 'submit' value = 'Go Back'></form></body>";
?>
