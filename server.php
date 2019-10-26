<?php
$servername = "localhost";
$dbusername = "root";
$password = "123456789";
 if (isset($_POST['register'])) {
try {
    $conn = new PDO("mysql:host=$servername;dbname=registration", $dbusername, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
}
  //   if (isset($_POST['register'])) {
        $username = ($_POST['username']);
        $email = ($_POST['email']);
        $password_1 = ($_POST['password_1']);
        $password_2 = ($_POST['password_1']);
         
        echo "gdhgshd";
    
        $sql = "INSERT INTO users($username, $email, $password_1, $password_2) VALUES(?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $arr = array($username, $email, $password_1, $password_2);
        if($stmt->execute($arr) === TRUE){
            echo "data in";
        }else{
            echo "data not in";
        }
     }

?>