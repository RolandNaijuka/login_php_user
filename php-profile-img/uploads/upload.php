<?php 
    session_start();
    include_once '../includes/dbh.inc.php';

    $id = $_SESSION['id'];

    if(isset($_POST['submit'])){
        $file = $_FILES['file'];
        
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedFileTypes = array('jpg','jpeg','png');

        if (in_array($fileActualExt, $allowedFileTypes)) {
            if($fileError === 0){
                if ($fileSize < 1000000) {
                    $newFileName = "profile".$id.".".$fileActualExt;
                    $fileDestination = './'.$newFileName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $queryUpdateProfileStatus = "UPDATE profileimg SET status=0 WHERE userid='$id';";
                    mysqli_query($conn, $queryUpdateProfileStatus);
                    header("Location: ../index.php?upload=success");
                } else {
                    echo '<div style="color: red;">Your file is too big!</div>';
                }
                
            }else{
                header("Location: ../index.php?upload=error");
                echo '<div style="color: red;">Error uploading the file!</div>';
            }
        }
        else {
            echo '<div style="color: red;">You cannot upload files of this type!</div>';
        }
    }
?>