<?php 
  include 'auth.php';

  if(isset($_GET['id'])){
    $bookid = $_GET['id'];
  }else{
    $bookid = null;
  }
?>

<!DOCTYPE html>
<php>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | แจ้งชำระเงิน</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <script src="jquery-2.1.3.min.js"></script>
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
    <link href="dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="dist/js/bootstrap-datepicker-custom.js"></script>
    <script src="dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top" style="position: absolute;">
        <div class="container"><a class="navbar-brand" href="#" style="font-size: 30px;"><b>ระบบจองแพ็คเกจการท่องเที่ยว</b></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link link-scroll" href="index.php">หน้าแรก <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="index.php#book">การจอง</a></li>
              <li class="nav-item"><a class="nav-link link-scroll active" href="payment.php">แจ้งชำระเงิน</a></li>
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
    <!-- Hero Section-->
    <section class="hero bg-cover bg-center mt-5 " id="hero" style="background: url(img/bg_.jpg);">
      <div class="container py-5 my-3 index-forward">
        <div class="row">
          <div class="col-lg-6 text-white">
            <h1 class="text-uppercase text-xl mt-5 mb-0">แจ้งชำระเงิน<span class="text-primary" style="font-size: 60px;">จองแพ็คเกจทัวร์</span></h1>
            <h2 class="h4 text-primary font-weight-normal mb-0">Payment Notification</h2>
            <br>
            <a href="cart-list.php" class="btn btn-lg btn-outline-primary link-scroll"><i class="fas fa-cart-arrow-down"></i> <b>ตระกร้าจองแพ็คเกจ</b></a>
          </div>
          <div class="col-lg-6">
            <div class="card" id="forms">
              <div class="card-header" align="center"><legend>หลักฐานการชำระเงิน</legend></div>
              <div class="card-body">
                <form method="POST" action="pay.php" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                      <?php if($bookid != NULL){ ?>
                      <label for="exampleInputEmail">หมายเลขการจอง : <span class="h4 pl-3" style="color: #fbd214;">#<?=$bookid?></span></label>
                      <input class="form-control" id="bookid" name="bookid" type="text" value="<?= $bookid?>" hidden>
                      <?php }else{ ?>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">หมายเลขการจอง :</label>
                        <div class="col-sm-8">
                          <input class="form-control" id="bookid" name="bookid" type="text" placeholder="####" required>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">วันที่ชำระเงิน</label>
                      <div class="col-sm-3">
                        <input id="datepicker" name="date" width="233" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">เวลาที่ชำระเงิน</label>
                      <div class="col-sm-8">
                        <input class="form-control" id="time" name="time" type="time" placeholder="hh:mm" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">ธนาคารที่ชำระเงิน</label>
                      <div class="col-sm-8">
                        <select class="custom-select" name="bank">
                          <option selected>เลือกธนาคารที่ชำระเงิน</option>
                          <option value="1">กรุงไทย</option>
                          <option value="2">กรุงศรี</option>
                          <option value="3">กสิกร</option>
                          <option value="4">ออมสิน</option>
                          <option value="5">อื่นๆ</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">จำนวนเงินที่ชำระ</label>
                      <div class="col-sm-8">
                        <input class="form-control" id="amount" name="amount" type="text" placeholder="บาท" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">หลักฐานการชำระเงิน</label>
                      <div class="col-sm-8">
                        <div class="custom-file">
                          <!-- <input type="file" class="form-control-file" name="file" id="customFile"> -->
                          <input type="file" class="custom-file-input" name="customFile" id="customFile">
                          <label class="custom-file-label" for="customFile" name="customFile" id="file"></label>
                        </div>
                      </div>
                    </div>
                    <div class="col" align="center">
                      <button class="btn btn-primary btn-lg" type="submit" name="paid" onclick="return confirm('ยืนยันการแจ้งชำระเงิน')"><b>ยืนยัน</b></button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
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
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
      $('#datepicker').datepicker({
          uiLibrary: 'bootstrap4'
      });
    </script>
    <script>
      var filename = document.getElementById('file');
      var upload = document.getElementById('customFile');
      
      upload.addEventListener("change", ()=>{
        var name = upload.value.substring(12, upload.value.length);
        console.log(name);
        filename.innerHTML = name;
      })
    </script>
  </body>
</html>