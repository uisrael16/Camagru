<?php
   
    session_start();

    if(isset($_POST['reset'])){
            require_once('../Config/database.php');

            $password = md5($_POST['password_1']);
            $password2 = md5($_POST['password_2']);
            $id = $_SESSION['userid'];
            if ($password == $password2){
                $sql = "UPDATE users SET pass = ? WHERE id= ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $password);
                $stmt->bindParam(1, $id);
                $result = $stmt->execute([$password,$id]);
                header("Location: ../Views/login.php");
            }
            else  
            {
                echo "Password doen't Match";   
            }
       
}

?>