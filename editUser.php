<?php

session_start();

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $userId = "";
    $userImage = "";
    $row = "";
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
        <title>Edit Information</title>
    </head>
    <body>
        <div class="container">
            <h1>Edit User Information</h1>
            <?php
            
            require('connect.php');

            if($conn){
                $queryGetUser = "SELECT * FROM users WHERE username='$username'";
                $resUser = mysqli_query($conn, $queryGetUser) or die("Error looking in DB");
                $row = mysqli_fetch_array($resUser);

                $userId = $row['id'];
                
                $queryGetImage = "SELECT image FROM images WHERE user_id='$userId'";
                $resImage = mysqli_query($conn, $queryGetImage) or die("failed to get image");
                $tempRow = mysqli_fetch_array($resImage);
                $userImage = $tempRow['image'];
            }

            if(isset($_POST['btn_input_data'])){
                $newName = $_POST['first_name'];
                $newSurname = $_POST['last_name'];
                $newEmail = $_POST['email'];
                $newUsername = $_POST['username'];
                $newPassword = hash('sha256', $_POST['password']);

                if($row['name'] != $newName){
                    $updateName = "UPDATE users SET name='$newName' WHERE id='$userId'";
                    mysqli_query($conn, $updateName) or die("error changing name");
                }

                if($row['surname'] != $newSurname){
                    $updateSurname = "UPDATE users SET surname='$newSurname' WHERE id='$userId'";
                    mysqli_query($conn, $updateSurname) or die("error changing surname");
                }

                if($row['email'] != $newEmail){
                    $updateEmail = "UPDATE users SET email='$newEmail' WHERE id='$userId'";
                    mysqli_query($conn, $updateEmail) or die("error changing email");
                }

                if($row['username'] != $newUsername){
                    $updateUsername = "UPDATE users SET username='$newUsername' WHERE id='$userId'";
                    mysqli_query($conn, $updateUsername) or die("error changing username");
                    $_SESSION['username'] = $newUsername;
                }

                if($row['password'] != $newPassword){
                    $updatePassword = "UPDATE users SET password='$newPassword' WHERE id='$userId'";
                    mysqli_query($conn, $updatePassword) or die("error changing password");
                }

                
            }

            if(isset($_POST['btn_back'])){
                header("Location: profile.php");
            }

            ?>

            <form action="editUser.php" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <input  id="first_name" type="text" name="first_name" value="<?php echo $row['name']; ?>">
                    <label for="first_name"><?php echo $row['name']; ?></label>
                </div>
                <div class="input-field">
                    <input  id="last_name" type="text" name="last_name" value="<?php echo $row['surname']; ?>">
                    <label for="last_name"><?php echo $row['surname']; ?></label>
                </div>
                <div class="input-field">
                    <input  id="email" type="text" name="email" value="<?php echo $row['email']; ?>">
                    <label for="email"><?php echo $row['email']; ?></label>
                </div>
                <div class="input-field">
                    <input  id="username" type="text" name="username" value="<?php echo $row['username']; ?>">
                    <label for="username"><?php echo $row['username']; ?></label>
                </div>
                <div class="input-field">
                    <input  id="password" type="password" name="password" value="<?php echo $row['password']; ?>">
                    <label for="password">new password</label>
                </div>
                <div class="input-field">
                    <div class="row">
                        <div class="col s12 m6">
                            <h4>User Picture:</h4>
                            <img src="<?php if($userImage == ""){echo "./images/image-not-available.jpg";}else{echo $userImage;}; ?>" alt="userImage">
                        </div>
                        <div class="col s12 m6">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" name="image" id="image">
                                </div>
                                <div class="file-path wrapper">
                                    <input type="text" class="file-path">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="waves-effect btn" name="btn_input_data">Submit</button>
                <button class="waves-effect btn" name="btn_back">Back</button>
            </form>
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