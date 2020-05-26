<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Signin</title>

    <?php 
        session_start();
        include './includes/bootstrap.inc.php'; 
    ?>
    <link href="./css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="container">
        <form class="form-signin" method="POST" action="./includes/login.php">
            <img class="mb-4" src="./images/icon.jpg" alt="">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <?php
                if (isset($_GET['login'])) {
                    $loginCheck = $_GET['login'];
                    if($loginCheck == "error"){
                        echo '<div id="alert" class="alert text-center alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        Check username or password!</div>';
                    }
                }
                if(isset($_GET['username'])){
                    $username_login = $_GET['username'];
                    echo '
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" class="form-control" name="username" value="'.$username_login.'" placeholder="Username" required
                        autofocus>
                ';
                }
                else{
                    echo '
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Username" required
                        autofocus>
                ';
                }
            ?>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitLogin">Sign in</button>
            <p class="mt-5 mb-3 text-muted">Roland &copy; 2020</p>
        </form>
  </div>
</body>

</html>