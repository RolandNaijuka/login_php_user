<?php 
    session_start();
    include_once './includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include './includes/bootstrap.inc.php';
    ?>
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php 
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $queryImage = "SELECT * FROM profileimg WHERE userid='$id';";
                    $resultImg = mysqli_query($conn, $queryImage);
                    while($rowImg = mysqli_fetch_assoc($resultImg)){
                        echo '<div class="card" style="width: 18rem;">';
                            if($rowImg['status'] == 0){
                                $src = "./uploads/profile".$id.".*";
                                $src = glob($src)['0'];
                                echo "<img  class='card-img-top' src='".$src."?".mt_rand()."'>";
                            }else{
                                echo "<img src='uploads/profiledefault.jpg'>";
                            }
                            echo "<div class='card-body'>
                            <h5 class='card-title'>".$row['username']."</h5>
                            <h5 class'card-text'>".$row['first']." ".$row['last']."</h5>
                            </div>";
                        echo "</div>";
                    }
                }
            }
            else{
                echo "<p>There are no users yet</p>";
            }

            if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $queryUsername = "SELECT * FROM users WHERE id='$id'";
                    $result = mysqli_query($conn, $queryUsername);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                        $username = $row['username'];
                        echo "<p>You are logged in as ".$username."</p>";
                    }
                    else{
                        //default user
                        echo "<p>You are logged in as Roland</p>";
                    }
                //upload or change image    
                echo '<form action="./uploads/upload.php" method="POST" enctype="multipart/form-data">
                    <div class="custom-file col-md-4">
                        <input class="custom-file-input" type="file" id="profilePic" name="file">
                        <label class="custom-file-label" for="profilePic">Choose file...</label>
                    </div>
                        <button class="btn btn-info mt-1 col-md-1" type="submit" name="submit">UPLOAD</button>
                </form>';
                //delete image
                echo '<form class="mt-3" method="POST" action="./includes/deleteProfileImg.php">
                    <h5 class="mb-0">Delete profile image</h5>
                    <button class="btn btn-danger mt-1" type="submit" name="submit">DELETE</button>
                </form>';
                //log out
                echo '<h2 class="mb-0 mt-3">Logout as user!</h2>
                <form action="./includes/logout.php" method="POST">
                    <button class="btn btn-primary mt-1" type="submit" name="submitLogout">Logout</button>
                </form>';
            }
            else {
                echo "You are not logged in!";
                //log in
                echo '<h2>Login as user!</h2>
                <form action="./login.php" >
                    <button class="btn btn-primary mt-3" type="submit" name="submitLogin">Login</button>
                </form>';
                include './signup.php';
            }
        ?>
        
        <script type="text/javascript">
            $("#alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert").slideUp(500);
            });

        </script>
        
    </div>
</body>
</html>