<?php

include '../auth.php';
include '../condb.php';
if($_SESSION['admin']==false){
  header("Location: ../index.php");
  exit();
}
if(isset($_GET['id'])){
  $id = $_GET['id'];
}else header("Location: ad-all-package.php");

$email = $_SESSION['email'];

$query1 = "SELECT *, FORMAT(amount, 2) amount FROM tbbookingdetail
   LEFT JOIN tbpacktour
   on tbbookingdetail.ref_planno = tbpacktour.pktourid
   LEFT JOIN tbplanning
   on tbplanning.planno = tbpacktour.pktourid
   RIGHT JOIN tbpayment
   on tbbookingdetail.bkid = tbpayment.bkid
   LEFT JOIN tbmember
   on tbmember.email = tbbookingdetail.email
   WHERE tbpayment.bkid = $id";
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
  $result1 = mysqli_query($con, $query1);

  foreach($result1 as $rec){
    $img = $rec['payimg'];
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | ตระกร้าจองแพ็คเกจ</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
  <!-- Google fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,800&amp;display=swap">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="../css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="../img/icon.png">
  <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet"> 
</head>

<body>
  <!-- navbar-->
  <header class="header">
    <nav class="navbar navbar-expand-lg fixed-top" style="position: relative;">
      <div class="container">
        <a class="navbar-brand" href="ad-all-package.php" style="font-size: 30px; color:#fbd214;" id=""><b>การจัดการระบบจองแพ็คเกจการท่องเที่ยว</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link link-scroll" href="ad-all-package.php">หน้าแรก <span class="sr-only">(current)</span></a></li>
            <?php if($_SESSION['email'] != ''){ ?>
                <li class="nav-item">
                  <div class="dropdown show">
                    <button class="nav-link link-scroll btn btn-secondary dropdown-toggle" style="color: #fbd214;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      administrator
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                    </div>
                  </div>
                </li>
              <?php }else{ ?>
              <li class="nav-item"><a class="nav-link link-scroll btn btn-primary" style="color: #003B49;" href="login.php">เข้าสู่ระบบ</a></li>
              <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Menu Section-->
  <section class="bg-light" id="rent" style="padding-top: 60px; padding-bottom: 0px;">
    <div class="container">
      <header class="mb-4 pb-4">
        <h2 class="text-uppercase lined"><i class="fas fa-hand-holding-usd fa-2x mb-4"></i> รายการชำระเงิน</h2>
      </header>
  </section>
  <section class="bg-light" style="padding-top: 0px;">
    <div class="container">
      <h4 align="center"><u>การชำระเงิน</u> หมายเลขการจอง : <?= $id?></h4><br>
      <table class="table table-hover table-bordered">
        <thead align="center">
          <tr>
            <th>#</th>
            <th>วัน-เวลาที่ชำระเงิน</th>
            <th>ธนาคาร</th>
            <th>จำนวนเงิน</th>
            <th>ผู้ชำระ</th>
            <th>ตรวจสอบ</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($result1 as $row) {  ?>
            <tr align="center">
              <td>
                <h5><?php echo $row['payid'] ?></h5>
              </td>
              <td>
                <h5><?php echo $row['paydate'].' '.$row['paytime'] ?></h5>
              </td>
              <td>
                <h5><?php echo $row['bankname'] ?></h5>
              </td>
              <td>
                <h5><?php echo $row['amount'] ?></h5>
              </td>
              <td>
                <h5><?=$row['fname']?> <?=$row['lname']?></h5>
              </td>
              <td>
                <h5>
                  <a href="check-pay.php?id=<?php echo $row['bkid']; ?>" class="btn btn-success" ><i class="fas fa-check-square"></i></a>
                </h5>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <img class="pack-img" style="width: 50%; height:50%" src="../img/paid/<?=$img?>" alt="">
      
    </div>
  </section>
  <!-- Footer-->
  <footer>
    <div class="container text-center" style="padding: 20px;">
      <h6 class="text-primary text-uppercase mb-0 letter-spacing-3">สมาชิกในกลุ่ม</h6>
    </div>
    <div class="copyrights px-4">
      <div class="container py-4 border-top text-center">
        <p class="text-muted my-1">
          - นางสาศศิธร รักวิจิตร 159404140040 -<br>
          - นายจิรพงศ์ สงเนียม 161404140014 -<br>
          - นางสาวนะดา เฉมเร๊ะ 161404140022 -<br>
          - นายปฏิพล แปนแก้ว 161404140025 -
        </p>
      </div>
    </div>
  </footer>
  <!-- JavaScript files-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/front.js"></script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

</html>