<?php 

    session_start();
    include_once './dbh.inc.php';

    $sessionId = $_SESSION['id'];

    $fileName = "../uploads/profile".$sessionId.".*";
    $fileInfo = glob($fileName)[0];

    print_r($fileInfo);

    if(!unlink($fileInfo)){
        echo "File was not deleted!";
    }
    else{
        echo "File was deleted!";
        $queryChangeStatus = "UPDATE profileimg SET status=1 WHERE userid='$sessionId';";
        mysqli_query($conn, $queryChangeStatus);
    }
    header("Location: ../index.php?delete=success");


?>