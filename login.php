<!DOCTYPE html>
<php>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | เข้าสู่ระบบ</title>
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
        <div class="container"><a class="navbar-brand" href="#" id="head-nav" style="font-size: 30px;"><b>ระบบจองหอพัก</b></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link link-scroll" href="index.php">หน้าแรก <span class="sr-only">(current)</span></a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="index.php#book">การจอง</a></li>
              <li class="nav-item"><a class="nav-link link-scroll" href="payment.php">แจ้งชำระเงิน</a></li>
              <li class="nav-item"><a class="nav-link link-scroll btn btn-primary" style="color: #003B49;" href="login.php">เข้าสู่ระบบ</a></li>
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
            <h1 class="text-uppercase text-xl mb-0">เข้าสู่ระบบ<span class="text-primary" style="font-size: 60px;">จองแพ็คเกจทัวร์</span></h1>
            <h2 class="h4 text-primary font-weight-normal mb-0">Tourist Package Booking System Login</h2>
            <br>
            <a href="#regis" class="btn btn-lg btn-outline-primary link-scroll"><i class="fas fa-user"></i> <b>สมัครสมาชิก</b></a>
          </div>
          <div class="col-lg-6">
            <div class="card" id="forms">
              <div class="card-header" align="center"><legend>เข้าสู่ระบบ</legend></div>
              <div class="card-body">
                <form action="check-login.php" method="POST">
                  <fieldset>
                    <div class="form-group">
                      <label for="exampleInputEmail">Email</label>
                      <input class="form-control" id="exampleInputEmail" type="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword">Password</label>
                      <input class="form-control" id="exampleInputPassword" type="password" name="pass" placeholder="Password" required>
                    </div>
                    <div class="col" align="center">
                      <button class="btn btn-primary btn-lg" type="submit" name="login"><b>LOGIN</b></button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Menu Section-->
    <section class="bg-light" id="regis" style="padding-top: 60px;">
      <div class="container">
        <header class="mb-4 pb-4">
          <h2 class="text-uppercase lined"><i class="fas fa-user"></i> สมัครสมาชิก</h2>
        </header>
        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <form action="" method="">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail3">อีเมล</label>
                <div class="col-sm-9">
                  <input class="form-control" id="inputEmail3" type="email" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputPassword3">รหัสผ่าน</label>
                <div class="col-sm-9">
                  <input class="form-control" id="inputPassword3" type="password" placeholder="Password">
                  <small><code>*รหัสผ่านจะต้องประกอบไปด้วยตัวอักษรภาษาอังกฤษ และตัวเลขอย่างน้อย 8 อักขระ</code></small>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputPassword3">รหัสผ่านอีกครั้ง</label>
                <div class="col-sm-9">
                  <input class="form-control" id="inputPassword3" type="password" placeholder="Password">
                </div>
              </div>
              <br><hr>
              <h5 class="lined">ข้อมูลส่วนตัว</h5>
              <br><br>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail3">ชื่อ-สกุล</label>
                <div class="col-sm-4">
                  <input class="form-control" id="inputEmail3" type="text" placeholder="First Name">
                </div>
                <div class="col-sm-4">
                  <input class="form-control" id="inputEmail3" type="text" placeholder="Last Name">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail3">เพศ</label>
                <div class="col-sm-2">
                  <div class="dropdown">
                    <select class="form-control" name="" id="">
                      <option value="">เพศ</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">วันเกิด</label>
                <div class="col-sm-3">
                  <input id="datepicker" width="220" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail3">เลขประจำตัวประชาชน</label>
                <div class="col-sm-9">
                  <input class="form-control" id="inputEmail3" type="tel" placeholder="13 หลัก">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="inputEmail3">ที่อยู่</label>
                <div class="col-sm-9">
                  <input class="form-control" id="inputEmail3" type="text" placeholder="บ้านเลขที่ หมู่ที่ ตรอก/ซอย ถนน ตำบล อำเภอ จังหวัด">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12 pt-3" align="center">
                  <button class="btn btn-success btn-lg" type="submit"><b>ยืนยันการสมัคร</b></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
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
  </body>
</html>