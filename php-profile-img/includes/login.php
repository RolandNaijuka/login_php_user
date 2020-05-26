<?php 
    session_start();
    include_once './dbh.inc.php';
    if (isset($_POST['submitLogin'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM users WHERE username='$username';";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                $_SESSION['id'] = $row['id'];
                header("Location: ../index.php?login=success");
                exit();
            }
            else{
                header("Location: ../login.php?login=error&username=$username");
                exit();
            }
        }else{
            header("Location: ../login.php?login=error&username=$username");
            exit();
        }
    }
?>