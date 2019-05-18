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
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    ?>
    

    <div class="navbar-fixed">
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo">Logo</a>
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