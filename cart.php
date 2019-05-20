<?php
session_start();
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
    <title>Cart</title>
</head>
<body>
    <?php
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
    ?>
    <div class="navbar-fixed">
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <a href="index.php" class="brand-logo">Home</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="profile.php">Profile</a></li>
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
    
        require('connect.php');
        $total = 0;

        if($conn){
            $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
            $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
            while ($row = $resUser->fetch_assoc()) {
                $userToShow = $row['id'];
            }

            $queryGetCart = "SELECT * FROM cart WHERE user_id = '$userToShow'";
            $resCart = mysqli_query($conn, $queryGetCart) or die ("no items in cart");

            while($row = mysqli_fetch_array($resCart)){
                $total += $row['price'];
                echo '
                
            <div class="card medium horizontal" id="cartCard">
                <div class="card-image">
                    <img src="" class="cardImage" id=' . $row['book_id'] .'>
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h3 id=' . $row['book_id'] . '></h3>
                        <h4>Price: €' . $row['price'] . '.00</h4>

                    </div>
                    <div class="card-action">
                        <form action="removeFromCart.php" method="post">
                            <input type="hidden" name="book_id[]" value=' . $row['book_id'] .'>
                            <button class="waves-effect btn" name="btnCart">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
                ';
            }


        }
    
    ?>
    <form action="checkoutItems.php" method="post">
        <h3>Total Cost: €<?php echo $total ?>.00</h3>
        <button class="waves-effect btn btn-large" name="btnCheckout">Checkout</button>
    </form>
    </div>

    <?php
        }else{
            header("Location:index.php");
        }
    ?>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./scripts/materialize-js/bin/materialize.min.js"></script>
    <script type="module" src="./scripts/index.js"></script>
</body>
</html>