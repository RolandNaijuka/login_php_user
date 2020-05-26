
<h2>SignUp</h2>
<form method="POST" action="./includes/signup.inc.php" class="form-group col-md-6">
    <?php 
        if (isset($_GET['first'])) {
            $first = $_GET['first'];
            echo '<label>First Name</label>
            <input type="text" class="form-control" name="first" placeholder="Firstname" value="'.$first.'">';
        }
        else {
            echo '<label>First Name</label>
            <input type="text" class="form-control" name="first" placeholder="Firstname">';
        }
        if (isset($_GET['last'])) {
            $last = $_GET['last'];
            echo '<label>Last Name</label>
            <input type="text" class="form-control" name="last" placeholder="Lastname" value="'.$last.'">';
        }
        else {
            echo '<label>Last Name</label>
            <input type="text" class="form-control" name="last" placeholder="Lastname">';
        }
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
            echo '<label>Username</label>
            <input type="text" class="form-control" name="uid" placeholder="Username" value="'.$uid.'">';
        }
        else {
            echo '<label>Username</label>
            <input type="text" class="form-control" name="uid" placeholder="Username">';
        }
    
    ?>
    <label>Password</label>
    <input type="password" class="form-control" name="pwd">
    <button type="submit" name="submit" class="btn btn-primary mt-3">Sign up</button>
</form>

<?php
    if (isset($_GET['signup'])) {
        $signUpCheck = $_GET['signup'];
        if ($signUpCheck == "empty") {
            echo '<div id="alert" class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                You did not fill in all fields!</div>';
            exit();
        } elseif ($signUpCheck == "char") {
            echo '<div id="alert" class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            Names cannot contain numbers</div>';
            exit();
        } elseif ($signUpCheck == "success") {
            echo '<div id="alert" class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            Sign up completed!</div>';
            exit();
        } elseif ($signUpCheck == "usernameTaken") {
            echo '<div id="alert" class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            Username taken</div>';
            exit();
        }
    }
    elseif(isset($_GET['upload'])){
        $uploadCheck = $_GET['upload'];
        if($uploadCheck == "success"){
            
        }
    }

?>
    