<?php
    require("connect.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
    //is the form been submitted
if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = md5($_POST['password_1']);
    $password_2 = md5($_POST['password_2']);
    $sql = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->execute();

    if (strlen($username) < 5)
    {
        $error = "<p>Your username must be at least 5 characters</p>";
    }

    if (count($stmt->fetchAll()) > 0){
        $_SESSION['error'] = "$username is already taken";
        // echo "sql/database error";
    }
    else if ($password_1 != $password_2)
        {
          echo "password doesn't match";
        }
    else if (empty($username) || empty($email) || empty($password_1) || empty($password_2))
    {
        echo "missing information";
    }
    
    else
    {
        //Generate Vkey
        $vkey = md5(time().$username);
        $sql = "INSERT INTO users (username, email, pass, vkey) VALUES (?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password_1);
        $stmt->bindParam(4, $vkey);
        if($stmt->execute())
        {
            $_POST['password_1'];
        }
        else
        {
            echo "sql/database error";
        }
        $stmt = null;
        $conn = null;
    }
    // the message
 $msg = "Thank you for registering.\nWe have sent a verification email to the address provided<br><br>
        <a href=http://localhost:8080/Camagru/verifyemail.php?vkey=".$vkey.">confirm</a>";
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
// send email
mail($email,"verify",$msg);
}
?>  