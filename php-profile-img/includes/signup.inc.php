<?php

//check if the submit button is set or not null
if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';


    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwdHash = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    //use password_verify to verify if the passwords are the same
    // password_verify( $_POST['pwd'], $pwdHash);
    $pwd = mysqli_real_escape_string($conn, $pwdHash);
    
    //check if inut characters are valid
    if (empty($first) || empty($last) || empty($uid) || empty($pwd)) {
        header("Location: ../index.php?signup=empty");
        exit();
    } else {
        //check if the names are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            if(!preg_match("/^[a-zA-Z]*$/", $first) && !preg_match("/^[a-zA-Z]*$/", $last))
                header("Location: ../index.php?signup=char&uid=$uid");
            elseif(!preg_match("/^[a-zA-Z]*$/", $first))
                header("Location: ../index.php?signup=char&last=$last&uid=$uid");
            elseif(!preg_match("/^[a-zA-Z]*$/", $last))
                header("Location: ../index.php?signup=char&first=$first&uid=$uid");
            exit();
        } else {
            //TODO check if the username is already in the database
            $query_username = "SELECT * FROM users WHERE username='$uid';";
            $results_username_search = mysqli_query($conn, $query_username);
            
            if(mysqli_num_rows($results_username_search) == 0){
                $query = "INSERT INTO users(first,last,username,password)
                    VALUES (?,?,?,?);";
                //initialize a preaped statement
                $statement = mysqli_stmt_init($conn);
                //prepare the prepared statement
                if (!mysqli_stmt_prepare($statement, $query)) {
                    echo "Error while adding the user";
                    exit();
                } else {
                    mysqli_stmt_bind_param($statement, "ssss", $first, $last, $uid, $pwd);
                    mysqli_stmt_execute($statement);

                    //enter details in the profileimg table
                    $querySearchforUser = "SELECT * FROM users WHERE username='$uid' AND first='$first'";
                    $result = mysqli_query($conn, $querySearchforUser);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $userid = $row['id'];
                            $status = mysqli_real_escape_string($conn, 1);
                            $queryProfileImg = "INSERT INTO profileimg (userid, status) 
                                VALUES('$userid','$status');";
                            mysqli_query($conn, $queryProfileImg);
                            break;
                        }
                    }else{
                        echo "You have an error!";
                    }
                    
                    header("Location: ../index.php?signup=success");
                }
            }
            else{
                header("Location: ../index.php?signup=usernameTaken&first=$first&last=$last");
                exit();
            }
            
        }
    }
} else {
    header("Location: ../index.php?signup=error");
    exit();
}
