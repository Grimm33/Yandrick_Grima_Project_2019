<?php
session_start();

if(isset($_POST['btnCart'])){
    require('connect.php');

    if($conn){
        $username = $_SESSION['username'];
        $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
        $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
        while ($row = $resUser->fetch_assoc()) {
            $userID = $row['id'];
        }
        $book_id = $_POST['book_id'][0];

        $queryRemove = "DELETE FROM cart WHERE book_id = '$book_id' AND user_id = '$userID'";

        $resDel = mysqli_query($conn, $queryRemove) or die ("Error finding item");

        if(mysqli_affected_rows($conn) > 0){
            $_SESSION['added'] = $_SESSION['added'] - 1;
            header("Location: cart.php");
        }else{
            header("Location: cart.php?error");
        }
    }
}else{
    header("Location: cart.php");
}
?>