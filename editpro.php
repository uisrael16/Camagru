<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'connect.php';

$username = $_POST['username'];
$password = md5($_POST['passwd']);
$email = $_POST['email'];

//   if (isset($_POST['submit']))
//   {
//      $sql = "SELECT * FROM users WHERE username = :uname AND pass = :pass AND email = :email";
//      $stmt= $conn->prepare($sql);
//             $stmt->bindParam(':uname', $username);
//             $stmt->bindParam(':pass', $password);
//              $stmt->bindParam(':email', $email);
//             $stmt->execute();
//             echo "<br> "; 
     
//   }

if (isset($_POST['submit']))
  {
        $uname = $_SESSION['username'];
        $sql = "UPDATE users SET username = :uname, pass = :pass, email = :email WHERE username = :username";
        $stmt= $conn->prepare($sql);
            $stmt->bindParam(':uname', $username);
            $stmt->bindParam(':pass', $password);
             $stmt->bindParam(':email', $email);
             $stmt->bindparam(':username', $uname);
            $stmt->execute();
            echo "<br> "; 
     
  }

?>