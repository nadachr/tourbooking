<?php 

session_start();
if($_SESSION['admin']==false){
  header("Location: ../index.php");
  exit();
}
include '../condb.php';

$north = countSect($con, 001);
$northeast = countSect($con, 002);
$middle = countSect($con, 004);
$south = countSect($con, 006);

if(isset($_GET['sect'])){
  $sect = $_GET['sect'];
}else $sect = '';

if(isset($_POST['search'])){
  $sql = tourShow($sect, $_POST['kw']);
}else{
  $sql = tourShow($sect, '');
}
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);


function countSect($con, $sectid){
  $sql = "SELECT * FROM tbpacktour WHERE ref_sectionid = $sectid AND pkstatus = 1";
  $result = mysqli_query($con, $sql);
  $num = mysqli_num_rows($result);
  return $num;
}

function tourShow($sectid, $kw){
  if($sectid == '' && $kw == '' ){
    $sql = 'SELECT t.*,  p.*,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, "%d/%m/%Y") dstart,
    numSeat - numBooking numFree
    FROM `tbpacktour` t
    INNER JOIN tbplanning p
    ON p.ref_pktourid = t.pktourid
    WHERE pkstatus = 1
    ORDER BY pktourid DESC';
  }else if($sectid == '' && $kw != ''){
    $sql = "CALL searchPackage('$kw');";
  }else{
    $sql = "SELECT t.*,  p.*,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, '%d/%m/%Y') dstart,
    numSeat - numBooking numFree
    FROM `tbpacktour` t
    INNER JOIN tbplanning p
    ON p.ref_pktourid = t.pktourid
    WHERE ref_sectionid = $sectid AND pkstatus = 1
    ORDER BY pktourid DESC";
  }

  return $sql;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | แพ็คเกจทัวร์ทั้งหมด</title>
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
    <!-- Menu Section-->
    <section class="bg-light" id="rent" style="padding-top: 60px; padding-bottom: 50px;">
      <div class="container">
        <header class="mb-4 pb-4">
          <a href="ad-all-package.php" style="color:#2E3349;"><h2 class="text-uppercase lined"><i class="fas fa-map-marked-alt fa-2x mb-4"></i> แพ็คเกจทัวร์ทั้งหมด</h2></a>
        </header>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item admin shadow-sm d-block reset-anchor" href="ad-all-package.php?sect=004">
              <h4 class="contact-item-title text-uppercase">ภาคกลาง</h4>
              &nbsp;<span class="contact-item-title h2 text-success"><?= $middle?></span>
              <h4 class="contact-item-title page-header mb-0"><small>แพ็คเกจ</small></h4>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item admin shadow-sm d-block reset-anchor" href="ad-all-package.php?sect=006">
              <h4 class="contact-item-title text-uppercase">ภาคใต้</h4>
              &nbsp;<span class="contact-item-title h2 text-success"><?= $south?></span>
              <h4 class="contact-item-title page-header mb-0"><small>แพ็คเกจ</small></h4>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item admin shadow-sm d-block reset-anchor" href="ad-all-package.php?sect=001">
              <h4 class="contact-item-title text-uppercase">ภาคเหนือ</h4>
              &nbsp;<span class="contact-item-title h2 text-success"><?= $north?></span>
              <h4 class="contact-item-title page-header mb-0"><small>แพ็คเกจ</small></h4>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <a class="px-4 py-5 text-center contact-item admin shadow-sm d-block reset-anchor" href="ad-all-package.php?sect=002">
              <h4 class="contact-item-title text-uppercase">ภาคอีสาน</h4>
              &nbsp;<span class="contact-item-title h2 text-success"><?= $northeast?></span>
              <h4 class="contact-item-title page-header mb-0"><small>แพ็คเกจ</small></h4>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-1"></div>
          <div class="col-md-7 mt-5">
            <form action="" method="POST">
              <div class="input-group mb-2 mr-sm-2">
                <input class="form-control" id="search" name="kw" placeholder="ชื่อแพ็คเกจ หรือจังหวัดที่ต้องการ" type="text">
                <div class="input-group-append">
                  <input type="submit" class="btn btn-primary" name="search" value="ค้นหาแพ็คเกจ">
                </div>
              </div>
            </form>
          </div>
          <div class="col-3 mt-5">
            <a href="ad-add-package.php" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มแพ็คเกจการท่องเที่ยว</a>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-light" style="padding-top: 0px;">
      <div class="container">
        <h5>ผลการค้นหาแพ็คเกจการท่องเที่ยว : <span class="text-success">"ทั้งหมด"</span> พบจำนวน <?= $num;?> รายการ</h5>
        <table class="table table-hover table-bordered">
          <thead align="center">
            <tr>
              <th width="25%">รูปประกอบ</th>
              <th width="30%">ชื่อแพ็คเกจ</th>
              <th>วันเดินทาง</th>
              <th>ราคา (บาท/คน)</th>
              <th>ที่ว่าง (คน)</th>
              <th>การจอง</th>
              <th>ลบแพ็คเกจ</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row){ ?>
            <tr align="center">
              <td><a href="ad-package.php?id=<?= $row['pktourid'];?>"><img class="pack-list" src="../img/tour/<?= $row['pkpicture']?>" alt=""></a></td>
              <td align="left">
                <a href="ad-package.php?id=<?= $row['pktourid'];?>" class="text-dark">
                  <h5><?= $row['pktourname'];?></h5>
                  <p><?= $row['pkdetail']?></p>
                </a>
              </td>
              <td><?= $row['dstart']?></td>
              <td><?= $row['price']?></td>
              <td><?= $row['numFree']?></td>
              <td>
                <?php if($row['numBooking'] == 0) {?>
                  <a href="ad-booking.php?id=<?= $row['pktourid']?>" class="btn btn-info disabled"><i class="fas fa-cart-arrow-down"></i></a>&nbsp;
                <?php }else{ ?>
                  <a href="ad-booking.php?id=<?= $row['pktourid']?>" class="btn btn-info"><i class="fas fa-cart-arrow-down"></i></a>&nbsp;
                <?php } ?>
              </td>
              <td>
                <a href="delete.php?id=<?= $row['pktourid']?>" class="btn btn-danger" onclick="return confirm('ต้องการลบแพ็คเกจนี้ทิ้งหรือไม่')"><i class="fas fa-trash-alt"></i></a>&nbsp;
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
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