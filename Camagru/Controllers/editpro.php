<?php
session_start();

require '../Config/database.php';




if (isset($_POST['submit']))
  {
        $username = $_POST['username'];
        $password = md5($_POST['passwd']);
        $email = $_POST['email'];
        $uname = $_SESSION['username'];
        $sql = "UPDATE users SET username = :uname, pass = :pass, email = :email WHERE username = :username";
        $stmt= $conn->prepare($sql);
            $stmt->bindParam(':uname', $username);
            $stmt->bindParam(':pass', $password);
             $stmt->bindParam(':email', $email);
             $stmt->bindparam(':username', $uname);
            $stmt->execute();
            echo "<br> "; 
     $msg = "your account has been updated";
       $msg = wordwrap($msg,70);
       mail($email,"Account Updated",$msg);
    }


  

?>