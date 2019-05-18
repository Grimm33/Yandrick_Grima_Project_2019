<?php
session_start();
if(isset($_SESSION['username'])){
    if(isset($_POST['subCart'])){
        $bookId = $_POST['bookId'];
        $username = $_SESSION['username'];

        require('connect.php');

        if($conn){
            $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
            $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
            while ($row = $resUser->fetch_assoc()) {
                $userToAdd = $row['id']."<br>";
            }
            
            if(mysqli_num_rows($resUser) == 1){
                $queryAddToCart = "INSERT INTO cart(book_id, user_id) VALUES('$bookId', '$userToAdd')";
                mysqli_query($conn, $queryAddToCart) or die("Error putting into DB");

                if(mysqli_affected_rows($conn) == 1){
                    if(isset($_SESSION['added'])){
                        $numAdded = $_SESSION['added'];
                        $_SESSION['added'] = $numAdded+1;
                        header("Location: index.php?added=".$_SESSION['added']);
                    }else{
                        $_SESSION['added'] = 1;
                        header("Location: index.php ");
                    }
                }
            }

        }
    }
}else{
    header("Location: index.php?error=True");
}


?>