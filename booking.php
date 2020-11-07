<?php 

if(isset($_GET['id'])){
    $tourid = $_GET['id'];
}else{
    Header("Location: index.php");
}

include 'auth.php';

include('condb.php');

$sql = "SELECT t.*,  p.*,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, '%d/%m/%Y') dstart, 
DATE_FORMAT(dateEnd, '%d/%m/%Y') dend, DATE_FORMAT(dateDue, '%d/%m/%Y') due,
numSeat - numBooking numFree
FROM `tbpacktour` t
INNER JOIN tbplanning p
ON p.ref_pktourid = t.pktourid
WHERE pktourid = $tourid
ORDER BY pktourid DESC LIMIT 1";

if($result = mysqli_query($con,$sql)){
  foreach($result as $row){
    $tourid = $row['pktourid'];
    $tourName = $row['pktourname'];
    $detail = $row['pkdetail'];
    $unitPrice = $row['unitprice'];
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
  <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | ตระกร้าจองแพ็คเกจ</title>
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
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <!-- navbar-->
  <header class="header">
    <nav class="navbar navbar-expand-lg fixed-top" style="position: relative;">
      <div class="container">
        <a class="navbar-brand" href="index.php" style="font-size: 30px;" id=""><b>ระบบจองแพ็คเกจการท่องเที่ยว</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link link-scroll" href="index.php">หน้าแรก <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link link-scroll" href="index.php#book">การจอง</a></li>
            <li class="nav-item"><a class="nav-link link-scroll" href="payment.php">แจ้งชำระเงิน</a></li>
            <li class="nav-item">
              <div class="dropdown show">
                <button class="nav-link link-scroll btn btn-primary dropdown-toggle" style="color: #003B49;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $_SESSION['email'];?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Menu Section-->
  <section class="bg-light" id="rent" style="padding-top: 60px; padding-bottom: 0px;">
    <div class="container">
      <header class="mb-4 pb-4">
        <h2 class="text-uppercase lined"><i class="fas fa-cart-plus fa-2x mb-4"></i> การจองแพ็คเกจ</h2>
      </header>
  </section>
  <!-- Suggest Section-->
  <section class="bg-light" id="sug" style="padding-top: 30px;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4" id="headling">
              <h3 class="card-header">รายละเอียดการจองแพ็คเกจทัวร์</h3>
              <div class="card-body">
                <div class="card-body">
                  <form action="book.php" method="post">
                  <fieldset>
                    <input type="text" value="<?= $tourid?>" name="tourid" hidden>
                    <input type="text" value="<?= $_SESSION['email'];?>" name="email" hidden>
                    <div class="form-group">
                      <label for="" class="h4">หมายเลขแพ็คเกจ : <span class="h3 pl-3" style="color: #003B49;"><?= $tourid?></span></label>
                    </div>
                    <div class="form-group">
                      <label for="" class="h4">ชื่อแพ็คเกจ : <a href="package.php?id=<?=$tourid?>" class="h3 pl-3" style="color: #003B49;"><?= $tourName?></a></label>
                    </div>
                    <div class="form-group">
                      <label for="" class="h4">ราคา (บาท/คน) : <span class="h3 pl-3" style="color: #003B49;" id="price"><?= $price?></span></label>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label h5">จำนวนผู้เดินทาง (ผู้ใหญ่)</label>
                      <div class="col-sm-8">
                        <input class="form-control" name="adult" id="adult" type="number" min="0" value="0" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label h5">จำนวนผู้เดินทาง (เด็ก)</label>
                      <div class="col-sm-8">
                        <input class="form-control" name="child" id="child" type="number" min="0" value="0" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label h5">จำนวนผู้เดินทางทั้งหมด</label>
                      <div class="col-sm-8">
                        <input class="form-control" name="total" id="total" type="number" min="0" value="0" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label h5">จำนวนเงินที่ต้องชำระ</label>
                      <div class="col-sm-8">
                        <input class="form-control" id="priceTotal" name="priceTotal" type="text" placeholder="บาท" readonly>
                      </div>
                    </div>
                    <div class="col" align="center">
                      <button class="btn btn-primary btn-lg" type="submit" name="submit" onclick="return confirm('ยืนยันการจองแพ็คเกจการท่องเที่ยวนี้')"><b>ยืนยันการจองแพ็คเกจ</b></button>
                    </div>
                  </fieldset>
                  </form>
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/front.js"></script>
  <script>
      var price = <?php echo $unitPrice;?> ;
      var priceTotal = document.getElementById("priceTotal");
      var adult = document.getElementById("adult");
      var child = document.getElementById("child");
      var total = document.getElementById("total");

      adult.addEventListener('change', ()=>{
        total.value = parseInt(adult.value) + parseInt(child.value);
        priceTotal.value = parseInt(price) * total.value;
      } )       
      child.addEventListener('change', ()=>{
        total.value = parseInt(adult.value) + parseInt(child.value);
        priceTotal.value = parseInt(price) * total.value;  
      })               

  </script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

</html>