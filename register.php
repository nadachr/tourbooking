<?php
    require_once "./database.php";

    class createUser extends Database {
        
        public function __construct() {
            session_start();
            $for_validation = array();
            $data_nopass    = array();
            
            if(isset($_POST['regis'])) {
                // $conn = Database::getConnection();
                $conn = $this->getConnection();
                
                // รับค่าInput จากFrontend
                $email      = mysqli_real_escape_string($conn, $_POST['inputEmail']);
                $password1  = mysqli_real_escape_string($conn, $_POST['inputPassword1']);
                $password2  = mysqli_real_escape_string($conn, $_POST['inputPassword2']);
                $fname      = mysqli_real_escape_string($conn, $_POST['inputFname']);
                $lname      = mysqli_real_escape_string($conn, $_POST['inputLname']);
                $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
                $birthdate  = mysqli_real_escape_string($conn, $_POST['birthdate']);
                $id_number  = mysqli_real_escape_string($conn, $_POST['inputID']);
                $address    = mysqli_real_escape_string($conn, $_POST['inputAdress']);
                
                // Data for validation
                array_push($for_validation, $password1);
                array_push($for_validation, $password2);
                array_push($for_validation, $email);

                // Data for push
                array_push($data_nopass, $email);
                array_push($data_nopass, $fname);
                array_push($data_nopass, $lname);
                array_push($data_nopass, $gender);
                array_push($data_nopass, $birthdate);
                array_push($data_nopass, $id_number);
                array_push($data_nopass, $address);
            }
            else {
                $this->redirect();  // กลับไปหน้าLogin หากไม่ได้เข้ามาโดยการSubmit
            }
            // เรียกใช้ Method Validation เพื่อทำการตรวจสอบข้อมูล
            $this->validate($for_validation, $conn, $data_nopass);
        }
        
        public function validate($valid, $conn, $data_nopass) {
            $error              = array();
            $password1          = $valid[0];
            $password2          = $valid[1];
            $email_valid        = $valid[2];
            
            // ตรวจสอบรหัสผ่านว่าตรงกันหรือไม่ในขั้นตอนการสมัครสมาชิก
            if($password1 != $password2) {
                array_push($error, "รหัสผ่านไม่ตรงกัน");
                $_SESSION['pwd_not_match'] = "รหัสผ่านไม่ตรงกัน กรุณาทำรายการใหม่";
                $this->redirect();
            }
            else {
                // ตรวจสอบว่ามี Emailนี้ในฐานข้อมูลแล้วหรือไม่
                $email_check_query  = "SELECT * FROM `tbmember` WHERE `email` = '$email_valid'";
                $result             = $conn->query($email_check_query);
                $fetch              = $result->fetch_assoc();
                // echo($fetch['email']);

                if($fetch) {
                    if($fetch['email'] === $email_valid) {
                        array_push($error, "อีเมลล์นี้ถูกใช้งานแล้ว");
                        $_SESSION['email_already'] = "Email นี้ถูกใช้งานแล้ว";
                        $this->redirect();
                    }
                }
            }
            // ทำตามเงื่อนไขหลังจากตรวจสอบแล้วว่าไม่พบ error
            if(count($error) == 0) {
                #$password = md5($password1);                        // เข้ารหัส password เป็นรูปแบบ MD5
                $this->push_data($password1, $conn, $data_nopass);   //เรียกใช้ Method เพิ่มข้อมูลไปยังฐานข้อมูล
            }
        }
        
        public function push_data($password, $conn, $data_nopass) {
            $email          = $data_nopass[0];
            $fname          = $data_nopass[1];
            $lname          = $data_nopass[2];
            $gender         = $data_nopass[3];
            $birthdate      = $data_nopass[4];
            $id_number      = $data_nopass[5];
            $address        = $data_nopass[6];

            $insert         = "INSERT INTO `tbmember`(`email`, `password`, `fname`, `lname`, `gender`, `birthdate`, `memidno`, `address`) ";
            $insert        .= "VALUES ('$email', '$password', '$fname', '$lname', '$gender', '$birthdate', '$id_number', '$address')";
            
            // เพิ่มข้อมูลไปยังฐานข้อมูล แล้วกลับไปยังหน้าLogin
            if($conn->query($insert) === TRUE) {
                $_SESSION['success'] = "<strong>สมัครสมาชิกสำเร็จ</strong> เข้าสู่ระบบเพื่อทำการจองแพ็คเกจทัวร์";
                $this->redirect();
            }
            else {
                echo "Error: " .$insert ."<br />" .$conn->error;
            }

            $conn->close();
        }
        
        public function redirect() {
           header('location: ../login.php');    //กลับไปยังหน้าLogin
        }
        
    }

    $newUser = new createUser();
?>