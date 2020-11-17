<?php 

session_start();
  include '../condb.php';

  if(isset($_GET['id'])){
    $tourid = $_GET['id'];
  }

  $sql = "SELECT t.*,  p.*,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, '%d/%m/%Y') dstart, 
  DATE_FORMAT(dateEnd, '%d/%m/%Y') dend, DATE_FORMAT(dateDue, '%d/%m/%Y') due,
  numSeat - numBooking numFree
  FROM `tbpacktour` t
  INNER JOIN tbplanning p
  ON p.ref_pktourid = t.pktourid
  WHERE pktourid = $tourid";

if($result = mysqli_query($con,$sql)){
  foreach($result as $row){
    $tourName = $row['pktourname'];
    $detail = $row['pkdetail'];
    $act = $row['activity'];
    $price = $row['price'];
    $include = $row['pkinclude'];
    $notinc = $row['pknotinculde'];
    $dateStart = $row['dstart'];
    $dateEnd = $row['dend'];
    $dateDue = $row['due'];
    $numBook = $row['numBooking'];
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
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="../https://fonts.googleapis.com/css?family=Work+Sans:300,400,800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
              <li class="nav-item"><a class="nav-link link-scroll active" href="ad-all-package.php">จัดการแพ็คเกจ <span class="sr-only">(current)</span></a></li>
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
    <!-- Suggest Section-->
    <section class="bg-light" id="sug" style="padding-top: 30px;">
      <div class="container">
        <header class="mb-4 pb-4">
          <h2 class="text-uppercase lined">รายละเอียดแพ็คเกจทัวร์</h2>
        </header>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4" id="headling">
              <h3 class="card-header"><?= $tourName?></h3>
              <div class="card-body">
                <div class="card-img">
                  <img class="pack-img" src="../img/tour/<?= $img?>" alt="">
                </div>
                <div class="card-body">
                  <h4><i class="fas fa-route"></i>&nbsp; รายละเอียดการท่องเที่ยว </h4><hr>
                  <p class="sug"><?= $detail?></p>
                  <h5>กิจกรรมตลอดแพ็คเกจ</h5>
                  <p class="font-20"><?= $act?></p>
                  <h5>อัตราค่าบริการ</h5> 
                  <li class="font-24">ราคาท่านละ <b><?= $price?></b> บาท</li>
                  <br>
                  <h5>อัตราค่าบริการนี้รวม</h5> 
                  <li class="font-24"><?= $include?></li>
                  <br>
                  <h5>อัตราค่าบริการนี้ไม่รวม</h5> 
                  <li class="font-24"><?= $notinc?></li>
                  <br>
                  <div class="row">
                    <table class="table table-bordered table-condensed" style="font-size: 20px;">
                      <thead align="center">
                        <tr>
                          <th>วันเดินทาง</th>
                          <th>วันปิดจอง</th>
                          <th>จำนวนที่ว่าง (คน)</th>
                          <th>จำนวนการจอง (คน)</th>
                        </tr>
                      </thead>
                      <tbody align="center">
                        <tr>
                          <td><?= $dateStart?> - <?= $dateEnd?></td>
                          <td><?= $dateDue?></td>
                          <td><?= $numFree?></td>
                          <td><?= $numBook?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12" align="center">
                    <a href="ad-add-package.php?id=<?= $tourid?>" class="btn btn-warning font-weight-bold"><i class="fas fa-edit"></i> แก้ไขรายละเอียดของแพ็คเกจ</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="text-uppercase text-secondary" href="ad-all-package.php"><b>ดูแพ็กเกจอื่น ๆ เพิ่มเติม</b></a>
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

    <script>
      document.getElementsByTagName('header').addEventListener('scroll', function(){
        document.getElementById('#head-nav').style.display = "block";
      });
    </script>
    <!-- JavaScript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/front.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>