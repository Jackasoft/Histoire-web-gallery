<?php

if (isset($_POST['submit-upload'])) {

    $newFilename = $_POST['filename'];
    if(empty($_POST['filename'])){
        $newFilename = 'gallery';
    }else{
        $newFilename = strtolower(str_replace(" ",'-', $newFilename));
    }

    $imgTitle = $_POST['imgtitle'];
    $imgDesc = $_POST['imgdesc'];

    $file = $_FILES['file'];

    // print_r($file);

    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $fileExt = explode('.',$fileName);
    //print_r($fileExt);

    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf','jfif','mp4','mp3');
    if(!empty($fileName)){
    if (in_array($fileActualExt,$allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000000) {
                $fileNameNew = $newFilename.".".uniqid('',true).".". $fileActualExt ;
                $fileDestination = "../uploads/".$fileNameNew;

                // print_r($fileDestination);
                // print_r($fileTmpName);

                include_once 'dbh.inc.php';

                if (empty($imgTitle) || empty($imgDesc)) {
                    header("Location: ../index.php?upload=emptytitledescription");
                    exit();
                }else{
                    $sql = "SELECT * FROM gallery";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
                        header("Location: ../index.php?error=sql_error");
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImgOrder = $rowCount + 1;

                        $sql = "INSERT INTO gallery(titleGallery,descGallery,imgFullNameGallery	,orderGallery) VALUES(?,?,?,?);";
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            header("Location: ../index.php?error=sql_error");
                        }else{
                            mysqli_stmt_bind_param($stmt,"ssss",$imgTitle,$imgDesc,$fileNameNew,$setImgOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTmpName,$fileDestination);
                            header("Location: ../index.php?upload=success");
                        }

                    }

                }
            }else{
                header("Location: ../index.php?error=filesize");
           }
        }else{
            header("Location: ../index.php?error=fileerror");
        }

    }else{
        header("Location: ../index.php?error=filetype");
    }
}else{
    header("Location: ../index.php?error=empty");
}
}
