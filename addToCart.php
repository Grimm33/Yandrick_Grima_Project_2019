<?php
session_start();
if(isset($_SESSION['username'])){
    if(isset($_POST['subCart'])){
        $bookId = $_POST['bookId'];
        $price = $_POST['bookPrice'];
        $username = $_SESSION['username'];

        require('connect.php');

        if($conn){
            $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
            $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
            while ($row = $resUser->fetch_assoc()) {
                $userToAdd = $row['id'];
            }
            
            if(mysqli_num_rows($resUser) == 1){
                $queryAddToCart = "INSERT INTO cart(book_id, user_id, price) VALUES('$bookId', '$userToAdd', $price)";
                mysqli_query($conn, $queryAddToCart) or die("Error putting into DB");

                if(mysqli_affected_rows($conn) == 1){

                    $queryFindItemsCart = "SELECT * FROM cart WHERE user_id = '$userToAdd'";
                    $resFind = mysqli_query($conn, $queryFindItemsCart) or die ("Error");
                    $rows = mysqli_num_rows($resFind);

                    $_SESSION['added'] = $rows;
                    header("Location: index.php?added=$rows");
                }else{
                    header("Location: index.php?error=affected_rows");
                }
            }else{
                header("Location: index.php?error=mysqli_affected_rows");
            }

        }else{
            header("Location: index.php?error=if_conn");
        }
    }else{
        header("Location: index.php?error=isset_subCart");
    }
}else{
    header("Location: index.php?error=isset_username");
}




?>