<?php 
    require 'server.php';
    require 'connect.php';
   if (isset($_GET['vkey'])) {
       //Process Verification
       $vkey = $_GET['vkey'];
       
    $sql = "SELECT verified , vkey FROM users WHERE verified = 0 AND vkey = ? LIMIT 1" ;
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $vkey);
    $stmt->execute();
       
    if (count($stmt->fetchAll()) == 1)
    {
        // Validate the email

        $sql = "UPDATE users SET verified = 1 WHERE vkey = ? LIMIT 1";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $vkey);
        
        if ($stmt->execute()){
            echo "Your account has been verified. you may now login.";
        }else{
            echo "Your account has not login";
        }

    }else{
        echo "This account is invalid or already verified";
    }
   }
   else{
       die("Something went wrong");
   }
?>
<html>
    <head>
        <title>Camagru | Verify</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <center>

        </center>
       
        
    </body>
</html>