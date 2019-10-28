<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (empty($_SESSION['id'])){
       header('Location: register.php');
    }
    echo "yes i am index";

?>