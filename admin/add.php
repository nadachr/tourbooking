<?php 

    include "../condb.php";

    if(isset($_POST['add'])){
        $name = $_POST['name'];
        $detail = $_POST['detail'];
        $activity = $_POST['activity'];
        $section = $_POST['section'];
        $price = $_POST['price'];
        $seat = $_POST['seat'];
        $include = $_POST['include'];
        $notinc = $_POST['notinc'];
        $start = $_POST['dateStart'];
        $end = $_POST['dateEnd'];
        $due = $_POST['dateDue'];

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

                    $fileDestination = '../img/tour/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $sql = "INSERT INTO `tbpacktour` (`pktourid`, `pktourname`, `pkdetail`, `unitprice`, `activity`, `ref_sectionid`, `pkinclude`, `pknotinculde`, `remark`, `pkpicture`, `pkstatus`) VALUES (NULL, '$name', '$detail', '$price', '$activity', '$section', '$include', '$notinc', NULL, '$fileNameNew', b'1');";
                    $insert = mysqli_query($con, $sql);

                    if($insert){
                        $sql2 = "SELECT pktourid FROM tbpacktour WHERE pktourname = '$name' LIMIT 1";
                        $insert2 = mysqli_query($con, $sql2);
    
                        if($insert2){
                            foreach($insert2 as $row){
                                $tourid = $row['pktourid'];
                            };

                            $sql3 = "INSERT INTO `tbplanning` (`planno`, `ref_pktourid`, `dateStart`, `dateEnd`, `numSeat`, `numBooking`, `dateDue`, `status`) VALUES (NULL, '$tourid', '$start', '$end', '$seat', '0', '$due', '1');";
                            $insert3 = mysqli_query($con, $sql2);
                            
                            header("Location: ad-package.php?id=$tourid");
                        }else{
                            echo "SELECT tktourid FROM tbpacktour WHERE pktourname = '$name' LIMIT 1";
                        }
                    }

                    // if(move_uploaded_file($_FILES['customFile']['tmp_name'], $target)){
                    //     $msg = "Image uploaded successfully";
                    // }else{
                    //     $msg = "There was a problem uploading image";
                    // }
            
                }else{
                    echo "ไฟล์มีขนาดใหญ่เกินไป";
                }
            }else{
                echo "การอัพโหลดไฟล์มีปัญหา...";
            }
        }else{
            echo "อัพโหลดไฟล์ชนิดนี้ไม่ได้";
        }
        echo $name.$detail.$price.$seat.$include.$notinc.$start.$end.$due;
    }

    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $detail = $_POST['detail'];
        $activity = $_POST['activity'];
        $section = $_POST['section'];
        $price = $_POST['price'];
        $seat = $_POST['seat'];
        $include = $_POST['include'];
        $notinc = $_POST['notinc'];
        $start = $_POST['dateStart'];
        $end = $_POST['dateEnd'];
        $due = $_POST['dateDue'];

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

                    $fileDestination = '../img/tour/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $sql = "UPDATE tbpacktour SET pktourname = '$name', pkdetail = '$detail', unitprice = '$price', activity = '$activity', ref_section = $section, pkinclude = '$include', pknotinclude = '$notinc', pkpicture = '$fileNameNew' WHERE pktourid = $id";
                    $sql2 = "UPDATE tbplanning SET dateStart = '$start', dateEnd = '$end', numSeat = '$seat', dateDue = '$due' WHERE ref_pktourid = $id";
                    $update = mysqli_query($con, $sql);
                    $update2 = mysqli_query($con, $sql2);

                    if($update2){
                        header("Location: ad-package.php?id=$id");
                    }else{
                        echo "UPDATE tbpacktour SET pktourname = '$name', pkdetail = '$detail', unitprice = '$price', activity = '$activity', ref_section = $section, pkinclude = '$include', pknotinclude = '$notinc', pkpicture = '$fileNameNew' WHERE pktourid = $id"."UPDATE tbplanning SET dateStart = '$start', dateEnd = '$end', numSeat = '$seat', dateDue = '$due' WHERE ref_pktourid = '$id'";
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
        //echo $name.$fileName.$detail.$price.$seat.$include.$notinc.$start.$end.$due;
    }

?>