<?php
session_start();

if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="./style/Materialize/css/sass/materialize.css">
    <link rel="stylesheet" href="./style/main.css">
    <title><?php echo $_SESSION['username']?>'s Profile</title>
</head>
<body>

    <div class="navbar-fixed">
            <nav>
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="index.php" class="brand-logo">Home</a>
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#">Profile</a></li>
                        <?php
                            if(isset($_SESSION['added'])){
                            $numAdded = $_SESSION['added'];
                        ?>
                            <li><a href="cart.php">Shopping Cart<span class="badge"><?php echo $numAdded; ?></span></a></li>
                        <?php
                            }else{
                        ?>
                            <li><a href="cart.php">Shopping Cart</a></li>
                        <?php
                            }
                        ?>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>


    <div class="container">
    
    <?php
    
    $username = $_SESSION['username'];
    if(isset($_SESSION['isAdmin'])){
        if($_SESSION['isAdmin'] == 1){
            ?>
        <br>
        <form action="profile.php" method="post">
            <button class="waves-effect btn btn-large" name="btn_admin_view_users">View Users</button>
            
            <button class="waves-effect btn btn-large" name="btn_admin_view_books">View your books</button>
        </form>
            <?php
        }
    }else{
        ?>
        <br>
        <form action="editUser.php" method="post">
            <button class="waves-effect btn btn-large" name="btn_edit_user">Edit Information</button>
        </form>
<hr>
        <?php
        require('connect.php');
        if($conn){
            $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
            $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
            while ($row = $resUser->fetch_assoc()) {
                $userId = $row['id'];
            }

            $queryGetUserBooks = "SELECT * FROM userbooks WHERE user_id = '$userId'";
            $resBooks = mysqli_query($conn, $queryGetUserBooks) or die ("no items in profile");

            while($row = mysqli_fetch_array($resBooks)){
                echo '
                
                <div class="card medium horizontal" id="cartCard">
                    <div class="card-image">
                        <img src="" class="cardImage" id=' . $row['book_id'] .'>
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <h3 id=' . $row['book_id'] . '></h3>
                        </div>
                    </div>
                </div>
                ';
            }
        }
    }

    if(isset($_POST['btn_admin_view_users'])){
        require('connect.php');
        if($conn){
            $queryGetAllUsers = "SELECT * FROM users";

            $resGetUsers = mysqli_query($conn, $queryGetAllUsers);

            while($row = mysqli_fetch_array($resGetUsers)){
                if($row['isAdmin'] == 1){
                    
                    // $queryGetUserId = "SELECT id FROM users WHERE username='$row['username']'";
                    // $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
                    // while ($row = $resUser->fetch_assoc()) {
                    //     $userId = $row['id'];
                    // }
                    $userID = $row['id'];
                    $queryGetImage = "SELECT image FROM images WHERE user_id = '$userID'";
                    $resImage = mysqli_query($conn, $queryGetImage);
                    $rowImage = mysqli_fetch_array($resImage);
                    echo '
                    <div class="card medium horizontal" id="cardUsers">
                        <div class="card-image">
                            <img src="' . $rowImage['image'] . '" class="cardUserImage" id=' . $row['id'] .'>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h3>Username: ' . $row['username'] . '<h3>
                                <h3>Email: ' . $row['email'] . ' </h3>
                                <h4>Admin Priveleges on</h4>
                            </div>
                        </div>
                    </div>';

                }else{
                    $userID = $row['id'];
                    $queryGetImage = "SELECT image FROM images WHERE user_id = '$userID'";
                    $resImage = mysqli_query($conn, $queryGetImage);
                    $rowImage = mysqli_fetch_array($resImage);
                    echo '
                    <div class="card medium horizontal" id="cardUsers">
                        <div class="card-image">
                            <img src="' . $rowImage['image'] . '" class="cardUserImage" id=' . $row['id'] .'>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h3>Username: ' . $row['username'] . '<h3>
                                <h3>Email: ' . $row['email'] . ' </h3>
                                <h4>Admin Priveleges off</h4>
                            </div>
                        </div>
                    </div>';

                }
            }
        }

    }
    
    if(isset($_POST['btn_admin_view_books'])){
        require('connect.php');
        if($conn){
            $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
            $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
            while ($row = $resUser->fetch_assoc()) {
                $userId = $row['id'];
            }

            $queryGetUserBooks = "SELECT * FROM userbooks WHERE user_id = '$userId'";
            $resBooks = mysqli_query($conn, $queryGetUserBooks) or die ("no items in profile");

            while($row = mysqli_fetch_array($resBooks)){
                echo '
                
                <div class="card medium horizontal" id="cartCard">
                    <div class="card-image">
                        <img src="" class="cardImage" id=' . $row['book_id'] .'>
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <h3 id=' . $row['book_id'] . '></h3>
                        </div>
                    </div>
                </div>
                ';
            }
        }

    }
    ?>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./scripts/materialize-js/bin/materialize.min.js"></script>
    <script type="module" src="./scripts/index.js"></script>
</body>
</html>

<?php
}else{
    header("Location: index.php");
}
?>