<?php

require("../Config/database.php");

if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password_1'];
    $password_1 = md5($_POST['password_1']);
    $password_2 = md5($_POST['password_2']);
    $sql = "SELECT * FROM registration.users WHERE username = ? OR email = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->execute();
    
    if (strlen($password) <= 7) {
        echo  "Your Password Must Contain At Least 8 Characters!";
    }
    if (count($stmt->fetchAll()) > 0){
        $_SESSION['error'] = "$username is already taken";
     
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Not a valid mail";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        echo "invalid email & username";
    }
    elseif ($password_1 != $password_2)
    {
        echo "password doesn't match";
    }
    
    elseif(!preg_match("/[a-z]/",$password)) {
        echo "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
    elseif(!preg_match("/[A-Z]/",$password)) {
        echo "Your Password Must Contain At Least 1 Capital Letter!";
    }
    else
    {
        
       
        //Generate Vkey
        $vkey = md5(time().$username);
        $password = md5($password_1);
        $sql = "INSERT INTO  users (username, email, pass, vkey) VALUES (?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password_1);
        $stmt->bindParam(4, $vkey);
        if($stmt->execute()){
            $_POST['password_1'];
        }
        else
        {
            echo "sql/database error";
        }
        $stmt = null;
        $conn = null;
        
        $msg = "Thank you for registering.\nWe have sent a verification email to the address provided<br><br>
               <a href='http://localhost:8080/Camagru/Controllers/verifyemail.php?vkey=$vkey'>confirm</a>";
       // use wordwrap() if lines are longer than 70 characters
       $msg = wordwrap($msg,70);
       // send email
       mail($email,"verify",$msg);
    }
 // header("Location:../Views/verifyemail.php");
    // the message
}

?>  