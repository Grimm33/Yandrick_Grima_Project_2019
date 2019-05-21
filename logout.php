<?php
session_start();

if(isset($_SESSION['username'])){
    require('connect.php');

    if($conn){
        $username = $_SESSION['username'];
        $userId;
    
        $queryGetUserId = "SELECT * FROM users WHERE username='$username'";
        $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
        while ($row = $resUser->fetch_assoc()) {
            $userId = $row['id'];
        }
        
        $loginString = "user logged out";
        $queryLogLogout = "INSERT INTO log (user_id, log_message, log_time) VALUES('$userId', '$loginString',  CURRENT_TIMESTAMP())";
        $resLog = mysqli_query($conn, $queryLogLogout) or die ("Error logging login");
    }

    unset($_SESSION['username']);
    unset($_SESSION['added']);

    session_destroy();

    header("Location: index.php");
}else{
    header("Location: index.php");
}
?>