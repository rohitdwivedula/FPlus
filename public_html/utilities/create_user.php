<?php
	function generateSalt($n){
		$values="abcdefghijklmnopqrstuvwxyz0123456789";
		$salt = "";
		$max = strlen($values)-1;
		for($i = 0;$i < $n; $i++){
			$salt .= $values[rand(0, $max)];
		}
		return $salt;
	}
	function createUser($username, $fname, $lname, $email, $pwd, $phone, $dob, $sex){
		$created_on = date("Y-m-d");
        require_once("db_connection.php");
        $query = "SELECT * FROM users WHERE username = '$username';";
		if($result = getResult($query)){
			if(mysqli_num_rows($result) != 0){
				return "ALREADY_EXISTS";
			}
			else{
				$salt = generateSalt(128);
				$hashed_pwd = hash('sha512', $pwd + $salt);
				$query = "INSERT INTO users VALUES('$username','$fname', '$lname', '$email', '$hashed_pwd', '$salt', '$phone', DATE '$dob', DATE '$created_on', '$sex');";
                if($qResult = getResult($query)){
					return True;
				}
				else{
                    return "ERROR";
				}
			}
		}
		else{
			return "ERROR";
		}
	}
?>