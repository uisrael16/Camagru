<?php
  
if(isset($_POST['forgotPassword'])){
    include_once('../Config/database.php');
    $mail = $_POST['email'];

    try{
        $stmt = $conn->prepare("SELECT vkey FROM `registration`.`users` WHERE email = ?");
        $stmt->execute([$mail]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //echo $result;
        if($result){
            $vkey = $result['vkey'];
            $msg = "click the link verifiy your account : http://localhost:8080/Camagru/Controllers/verifykey.php?vkey=$vkey";
        
            $headers = array('From: noreply');
    
            mail($mail, "Verificatin email", $msg, implode("\r\n", $headers));
            echo "Check your email and change password <br>";
        }else{         
            echo "incorrect email or email does not exists";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>