<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta http-equiv="Cache-control" content="no-cache">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="./style/Materialize/css/sass/materialize.css">
    <link rel="stylesheet" href="./style/main.css">
    <title>Book Store</title>
</head>
<body>
    
    <?php
    if(isset($_POST['sub_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) || !empty($password)){
            $password = hash('sha256', $password);
            require('connect.php');

            if($conn){
                $queryLogin = "SELECT * from users where username='$username' and password='$password'";

                $res = mysqli_query($conn, $queryLogin) or die("Error looking in DB");

                if(mysqli_num_rows($res) == 1){
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;

                    $queryGetUserId = "SELECT id FROM users WHERE username='$username'";
                    $resUser = mysqli_query($conn, $queryGetUserId) or die("Error looking in DB");
                    while ($row = $resUser->fetch_assoc()) {
                        $userId = $row['id'];
                    }

                    $queryGetItemsInCart = "SELECT * FROM cart WHERE user_id = '$userId'";
                    $resCartItems = mysqli_query($conn, $queryGetItemsInCart) or die ("Error");
                    $rows = mysqli_num_rows($resCartItems);
                    $_SESSION['added'] = $rows;

                }else{
                    echo"incorrect username and password!";
                }
            }

        }else{
            echo"Username and password required";
        }
    }

    if(isset($_POST['sub_register'])){
        $name = $_POST['fName'];
        $surname = $_POST['lName'];
        $email  =$_POST['email'];
        $usernameReg = $_POST['usernameReg'];
        $passwordReg = $_POST['passwordReg'];

        if(!empty($name) || !empty($surname) || !empty($email) || !empty($usernameReg) || !empty($passwordReg)){
            $passwordReg = hash('sha256', $passwordReg);

            require('connect.php');
            if($conn){
                $queryReg = "INSERT INTO users (name, surname, email, username, password) VALUES('$name', '$surname', '$email', '$usernameReg', '$passwordReg')";

                mysqli_query($conn, $queryReg);

                if(mysqli_errno($conn) == 1062){
                    // echo"Username already taken";
                    //here if possible make modul pop up again
                }else if(mysqli_error($conn)){
                    echo mysqli_error($conn);
                }else if (mysqli_affected_rows($conn) == 1) {
                    $_SESSION['username'] = $username;
                }else {
                    echo "User not inserted!<br>";
                }
            }
        }
    }
    
    if(isset($_SESSION['username'])){
        $numAdded = $_SESSION['added'];
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
    ?>

    <div class="navbar-fixed">
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo">Home</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a class="modal-trigger" href="#modalLogin">Login/ Register</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <?php
    }
    ?>

    <ul class="sidenav" id="mobile-demo">
    </ul>
    
    <div class="container"">
        <h1>Book Finder</h1>
        <form action="#">
            <input type="text" id="search" placeholder="Title or Author">
            <button id="button" type="button">Click Me</button>
        </form>
        <div id="results">

        </div>

    </div>


    <div class="modal" id="modalLogin">
        <div class="modal-content">
            <ul class="collapsible">
                <li class="active">
                    <div class="collapsible-header">Login</div>
                    <div class="collapsible-body">

                        <form action="index.php" method="POST">
                            <div class="input-field">
                                <input type="text" name="username" id="Username" autofocus><br>
                                <label for="Username">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" id="Password"><br>
                                <label for="Password">Password</label>
                            </div>
                            <button class="btn waves-effect" type="submit" name="sub_login">Login</button>
                        </form>

                    </div>
                </li>
                <li>
                    <div class="collapsible-header">Register</div>
                    <div class="collapsible-body">

                        <form action="index.php" method="POST">
                            <div class="input-field">
                                <input type="text" name="fName" id="name">
                                <label for="name">Name</label>
                            </div>
                            <div class="input-field">
                                <input type="text" name="lName" id="surname">
                                <label for="surname">Surname</label>
                            </div>
                            <div class="input-field">
                                <input type="email" name="email" id="email">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="text" name="usernameReg" id="usernameReg">
                                <label for="usernameReg">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="passwordReg" id="passwordReg">
                                <label for="passwordReg">Password</label>
                            </div>
                            <button class="btn waves-effect" type="submit" name="sub_register">Register</button>
                        </form>
                        
                    </div>
                </li>
            </ul>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./scripts/materialize-js/bin/materialize.min.js"></script>
    <script type="module" src="./scripts/index.js"></script>
</body>
</html>