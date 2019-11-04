<?php
   ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
	  error_reporting(E_ALL);
	  
	$password_1  = ['password_1 '];
	$password_2  = ['password_2 '];

if (isset($_POST['submit']))
	{
		if ($password_1 == $password_2)
		{
			if (passValid($password_1))
			{
				global $conn;
				try
				{
					$sql = "UPDATE `camagru`.`users` SET `pass`=:pass WHERE `verifyKey`=:vkey;";
					$stmt = $conn->prepare($sql);
					$pass = md5($password_1);
					$stmt->bindParam(":pass", $pass);
					$stmt->bindParam(":vkey", $vkey);
					$stmt->execute();
					$res = $stmt->rowCount();
					if ($res == 1)
					{
						$sql = "SELECT `email` FROM `camagru`.`users` WHERE `verifyKey`=:vkey;";
						$stmt2 = $conn->prepare($sql);
						$stmt2->bindParam(":vkey", $vkey);
						$stmt2->execute();
						$stmt2->SetFetchMode(PDO::FETCH_ASSOC);
						$res = $stmt2->fetch();
						notify_user($res['email'], 4);
						return "Password Reset";
					}
					else
						return "Undefined Error&verify=" . $vkey;
				}
				catch (PDOException $e)
				{
					return ($e->getMessage());	
				}
			}
			else
				return ("Password not valid&verify=" . $vkey);
		}else
			return ("Passwords dont match&verify=" . $vkey);
	}

	function passreset($email)
	{
		global $conn;
		try
		{
			$sql = "SELECT `vKey` FROM `registration`.`users` WHERE `email`=:email;";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			$stmt->SetFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetch();
			if ($user)
				send_pass_reset_verify($email, $username['vKey']);
			return ("Request sent");
		}
		catch (PDOException $e)
		{
			return ($e->getMessage());
		}
	}
?>