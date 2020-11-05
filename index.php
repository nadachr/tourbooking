<?php 

session_start();
$tourName = '';
include 'condb.php';
//include 'check-login.php';

$sql = 'SELECT t.*,  p.*,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, "%d/%m/%Y") dstart, 
DATE_FORMAT(dateEnd, "%d/%m/%Y") dend, DATE_FORMAT(dateDue, "%d/%m/%Y") due,
numSeat - numBooking numFree
FROM `tbpacktour` t
INNER JOIN tbplanning p
ON p.ref_pktourid = t.pktourid
ORDER BY pktourid DESC LIMIT 1';

if($result = mysqli_query($con,$sql)){
  foreach($result as $row){
    $tourid = $row['pktourid'];
    $tourName = $row['pktourname'];
    $detail = $row['pkdetail'];
    $price = $row['price'];
    $dateStart = $row['dstart'];
    $dateEnd = $row['dend'];
    $dateDue = $row['due'];
    $numFree = $row['numFree'];
    $img = $row['pkpicture'];
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | หน้าแรก</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
          <a class="navbar-brand hide" href="#" style="font-size: 30px;" id="head-nav"><b>ระบบจองแพ็คเกจการท่องเที่ยว</b></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link link-scroll active" href="#hero">หน้าแรก <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="#book">การจอง</a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="payment.php">แจ้งชำระเงิน</a></li>
              <?php if($_SESSION['email'] != ''){ ?>
              <li class="nav-item"><a class="nav-link link-scroll btn btn-primary" style="color: #003B49;" href="logout.php">ออกจากระบบ</a></li>
              <?php }else{ ?>
              <li class="nav-item"><a class="nav-link link-scroll btn btn-primary" style="color: #003B49;" href="login.php">เข้าสู่ระบบ</a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- Hero Section-->
    <section class="hero bg-cover bg-center mt-5" id="hero" style="background: url(img/bg_.jpg)">
      <div class="container py-5 my-3 index-forward">
        <div class="row">
          <div class="col-md-8 text-white">
            <h1 class="text-uppercase text-xl mb-0">ระบบจองแพ็คเกจ<br><span class="text-primary">การท่องเที่ยว</span></h1>
            <h2 class="h4 text-primary font-weight-normal mb-0">Tourist Package Booking System</h2>
            <br>
            <a href="#sug" class="btn btn-lg btn-outline-primary link-scroll"><i class="fas fa-bookmark"></i> &nbsp;<b>แพ็คเกจที่น่าสนใจ</b></a>
          </div>
        </div>
      </div>
    </section>
    <!-- Menu Section-->
    <section class="bg-light" id="book" style="padding-top: 60px;">
      <div class="container">
        <header class="mb-4 pb-4">
          <h2 class="text-uppercase lined">การจองแพ็คเกจทัวร์</h2>
        </header>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item shadow-sm d-block reset-anchor link-scroll" href="#sug"><i class="fas fa-bookmark fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">แพ็คเกจที่น่าสนใจ</h4>
              <p class="text-small mb-0">แนะนำแพ็คเกจที่น่าสนใจขณะนี้</p>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item shadow-sm d-block reset-anchor" href="all-package.php"><i class="fas fa-map-marked-alt fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">แพ็คเกจทัวร์ทั้งหมด</h4>
              <p class="text-small mb-0">ดูแพ็กเกจการท่องเที่ยวทั้งหมด</p>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item shadow-sm d-block reset-anchor" href="cart-list.php"><i class="fas fa-cart-arrow-down fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">ตระกร้าการจอง</h4>
              <p class="text-small mb-0">ดูรายการจองแพ็คเกจการท่องเที่ยว</p>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a href="payment.php" class="px-4 py-5 text-center contact-item shadow-sm d-block reset-anchor"><i class="fas fa-hand-holding-usd fa-2x mb-4"></i>
              <h4 class="contact-item-title h5 text-uppercase">ชำระเงิน</h4>
              <p class="text-small mb-0">ยืนยันการชำระเงิน</p>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- Suggest Section-->
    <section class="bg-light" id="sug" style="padding-top: 30px;">
      <div class="container">
        <header class="mb-4 pb-4">
          <h2 class="text-uppercase lined">แพ็คเกจที่น่าสนใจ</h2>
        </header>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4" id="headling">
              <h3 class="card-header"><?= $tourName; ?></h3>
              <div class="card-body">
                <div class="card-img">
                  <img class="pack-img" src="img/tour/<?= $img ?>" alt="">
                </div>
                <div class="card-body">
                  <h4><i class="fas fa-route"></i>&nbsp; รายละเอียดการท่องเที่ยว </h4><hr>
                  <p class="sug"><?= $detail ?></p>
                  <a href="package.php?id=<?=$tourid?>" class="btn btn-info">รายละเอียดเพิ่มเติม</a>
                  <h5 class="sug-price">ราคา <u><?= $price ?></u> บาท/คน</h5>
                  <div class="row">
                    <table class="table table-bordered table-condensed" style="font-size: 20px;">
                      <thead align="center">
                        <tr>
                          <th>วันเดินทาง</th>
                          <th>วันปิดจอง</th>
                          <th>จำนวนที่ว่าง (คน)</th>
                        </tr>
                      </thead>
                      <tbody align="center">
                        <tr>
                          <td><?= $dateStart?> - <?= $dateEnd?></td>
                          <td><?= $dateDue ?></td>
                          <td><?= $numFree ?></td>
                          <?php if($_SESSION['email'] != ''){ ?>
                          <td><a href="booking.php?id=<?=$tourid?>" class="btn btn-success btn-lg" onclick='return confirm("ต้องการจองแพ็คเกจการท่องเที่ยวนี้หรือไม่?");'>จองทัวร์นี้</a></td>
                          <?php }else{ ?>
                          <td><a href="login.php" class="btn btn-success btn-lg" onclick='alert("กรุณาเข้าสู่ระบบก่อนทำรายการ");'>จองทัวร์นี้</a></td>
                          <?php } ?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="text-uppercase text-secondary" href="all-package.php"><b>ดูแพ็กเกจอื่น ๆ เพิ่มเติม</b></a>
      </div>
    </section>
    <!-- Footer-->
    <footer>
      <div class="container text-center" style="padding: 20px;">
        <h6 class="text-primary text-uppercase mb-0 letter-spacing-3" >สมาชิกในกลุ่ม</h6>
      </div>
      <div class="copyrights px-4">
        <div class="container py-4 border-top text-center">
          <p class="text-muted my-1">
            - นางสาว -<br>
            - นายจิรพงศ์ สงเนียม -<br>
            - นางสาวนะดา เฉมเร๊ะ -<br>
            - นายปฏิพล แปนแก้ว -
          </p>
        </div>
      </div>
    </footer>

    <script>
      document.getElementsByTagName('header').addEventListener('scroll', function(){
        document.getElementById('#head-nav').style.display = "block";
      });
    </script>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/front.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>