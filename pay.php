<?php 

include 'condb.php';

if(isset($_POST['paid'])){ 
    $bookid = $_POST['bookid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $bank = $_POST['bank'];
    $amount = $_POST['amount'];

    $file = $_FILES['customFile'];
    $fileName = $_FILES['customFile']['name'];
    $fileTmpName = $_FILES['customFile']['tmp_name'];
    $fileSize = $_FILES['customFile']['size'];
    $fileError = $_FILES['customFile']['error'];
    $fileType = $_FILES['customFile']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 5000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;

                $fileDestination = 'img/paid/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                $sql = "INSERT INTO tbpayment VALUE(NULL, $bookid, '$date', '$time', '$bank', '$amount', '$fileNameNew', b'1');";
                $sql2 = "UPDATE `tbbookingdetail` SET `isPaidTotal` = '3' WHERE bkid = $bookid;";
                $insert = mysqli_query($con, $sql);
                $insert2 = mysqli_query($con, $sql2);

                if($insert){
                    header("Location: cart-list.php");
                }else{
                    echo "INSERT INTO tbpayment VALUE(NULL, $bookid, '$date', '$time', '$bank', '$amount', '$fileNameNew', b'1');";
                }

                if(move_uploaded_file($_FILES['customFile']['tmp_name'], $target)){
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "There was a problem uploading image";
                }
        
            }else{
                echo "ไฟล์มีขนาดใหญ่เกินไป";
            }
        }else{
            echo "การอัพโหลดไฟล์มีปัญหา...";
        }
    }else{
        echo "อัพโหลดไฟล์ชนิดนี้ไม่ได้";
    }

}
?>