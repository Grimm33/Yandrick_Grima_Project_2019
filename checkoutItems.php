<?php
session_start();

if(isset($_POST['btnCheckout'])){
    require('connect.php');

    if($conn){
        $username = $_SESSION['username'];
        $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
        $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
        while ($row = $resUser->fetch_assoc()) {
            $userId = $row['id'];
        }

        $querySendData = "INSERT INTO userbooks (user_id, book_id, price) SELECT user_id, book_id, price FROM cart WHERE user_id ='$userId'" ;
        $resSend = mysqli_query($conn, $querySendData) or die ("ERROR with send");

        if(mysqli_affected_rows($conn) > 0){
            $queryDeleteFromCart = "DELETE FROM cart WHERE user_id = '$userId'";
            $resDelete = mysqli_query($conn, $queryDeleteFromCart) or die("Error with delete");
    
            if(mysqli_affected_rows($conn) > 0){
                $_SESSION['added'] = 0;
            }
        }

    }
}

header("Location: index.php");
?>