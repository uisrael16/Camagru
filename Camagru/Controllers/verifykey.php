<?php

session_start();
require '../Config/database.php';

 if (isset($_GET['vkey'])) {
       //Process Verification
       $vkey = $_GET['vkey'];
       
    $sql = "SELECT id FROM users WHERE vkey = ?" ;
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $vkey);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "you may now change your password ";
    echo '</br><a href="../Views/changepassword.php">Click here</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;your user_id is: ';
    if ($result)
    {
        $_SESSION['userid'] = $result['id'];  die($_SESSION['userid']);
        header("Location:../Views/changepassword.php");
  
    }
 }
 ?>