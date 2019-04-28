<?php
echo 'hello';
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
    <title>Book Store</title>
</head>
<body>
    <div class="navbar-fixed">
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo">Logo</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="#">Sass</a></li>
                        <li><a href="#">Components</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#">Sass</a></li>
        <li><a href="#">Components</a></li>
        <li><a href="#">Javascript</a></li>
        <li><a href="#">Mobile</a></li>
      </ul>
    </ul>
      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./scripts/materialize-js/bin/materialize.min.js"></script>
    <script src="./scripts/index.js"></script>
</body>
</html>