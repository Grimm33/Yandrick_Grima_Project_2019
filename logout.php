<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    unset($_SESSION['username']);

    session_destroy();

    header("Location: index.php");
}


?>