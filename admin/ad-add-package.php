<?php 

  session_start();
  include '../condb.php';

  if(isset($_GET['id'])){
    $tourid = $_GET['id'];
    
    $sql = "SELECT t.*,  p.*, s.sectionName,  FORMAT(unitprice, 2) price, DATE_FORMAT(dateStart, '%d/%m/%Y') dstart, 
    DATE_FORMAT(dateEnd, '%d/%m/%Y') dend, DATE_FORMAT(dateDue, '%d/%m/%Y') due,
    numSeat - numBooking numFree
    FROM `tbpacktour` t
    INNER JOIN tbplanning p
    ON p.ref_pktourid = t.pktourid
    INNER JOIN tbsection s
    ON s.sectionid = t.ref_sectionid
    WHERE pktourid = $tourid";


    if($result = mysqli_query($con,$sql)){
        foreach($result as $row){
            $tourName = $row['pktourname'];
            $detail = $row['pkdetail'];
            $act = $row['activity'];
            $sectionid = $row['ref_sectionid'];
            $section = $row['sectionName'];
            $price = $row['price'];
            $include = $row['pkinclude'];
            $notinc = $row['pknotinculde'];
            $dateStart = $row['dstart'];
            $dateEnd = $row['dend'];
            $dateDue = $row['due'];
            $numSeat = $row['numSeat'];
            $img = $row['pkpicture'];
        }
    }
  }else $tourid = null;


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจองแพ็คเกจการท่องเที่ยวออนไลน์ | เพิ่มแพ็คเกจ</title>
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
          <h2 class="text-uppercase lined"><i class="fas fa-plus fa-1x mb-4"></i> เพิ่มแพ็คเกจการท่องเที่ยว</h2>
        </header>
        <?php if($tourid == null){?>
        <form action="add.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4" id="headling">
                <h3 class="card-header">
                  <div class="form-group row">
                    <label for="" class="ml-3 col-form-label">ชื่อแพ็คเกจ : </label>
                    <div class="col-sm-10 pt-2">
                      <input type="text" class="form-control" name="name" placeholder="ชื่อแพ็คเกจการท่องเที่ยว">
                    </div>
                  </div>
                </h3>
                <div class="card-body">
                  <div class="card-img">
                    <div class="form-group">
                      <label class="col-sm-12 col-form-label h5" align="center"><i class="fas fa-image fa-2x"></i> เพิ่มรูปประกอบ</label>
                      <div class="col-sm-10" style="margin-left: auto; margin-right: auto;">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="customFile" id="customFile1">
                          <label class="custom-file-label" for="customFile" name="customFile" id="file1">คลิกเพื่อเพิ่มรูปประกอบ</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <h4><i class="fas fa-route"></i>&nbsp; รายละเอียดการท่องเที่ยว </h4><hr>
                    <div class="col-form-label form-group">
                      <textarea class="form-control" name="detail" id="" cols="30" rows="10" placeholder="เพิ่มรายละเอียดการแพ็คเกจ"></textarea>
                    </div>
                    <h5>กิจกรรมตลอดแพ็คเกจ</h5>
                    <div class="form-group">
                      <textarea class="form-control" name="activity" id="" cols="30" rows="10" placeholder="เพิ่มรายละเอียดกิจกรรมตลอดแพ็คเกจ"></textarea>
                    </div>
                    <br>
                    <div class="form-group row">
                      <div class="col-3 mt-1" align="right">
                        <label class="h5">ภูมิภาค</label> 
                      </div>
                      <div class="col-sm-9">
                        <select id="inputState" name="section" class="form-control">
                          <option selected>เลือกภูมิภาคของการท่องเที่ยว</option>
                          <option value="001">ภาคเหนือ</option>
                          <option value="006">ภาคใต้</option>
                          <option value="004">ภาคกลาง</option>
                          <option value="002">ภาคอีสาน</option>
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="form-row">
                      <div class="form-group col-md-6 row">
                        <div class="col-6 mt-1" align="right">
                          <label class="h5" for="">อัตราค่าบริการ</label>
                        </div>
                        <div class="col-sm-6">
                          <input type="number" class="form-control" name="price" placeholder="บาท/ท่าน">
                        </div>
                      </div>
                      <div class="form-group col-md-6 row">
                        <div class="col-6 mt-1" align="right">
                          <label class="h5" for="">จำนวนผู้เข้าร่วม</label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="seat" placeholder="ท่าน">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <div class="col-3 mt-1" align="right">
                        <label class="h5">อัตราค่าบริการนี้รวม</label> 
                      </div>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="include" id="" cols="30" rows="6" placeholder="เพิ่มรายละเอียดการบริการที่รวมกับราคาแพ็คเกจ"></textarea>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <div class="col-3 mt-1" align="right">
                        <label class="h5">อัตราค่าบริการนี้ไม่รวม</label> 
                      </div>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="notinc" id="" cols="30" rows="6" placeholder="เพิ่มรายละเอียดการบริการที่ไม่รวมกับราคาแพ็คเกจ"></textarea>
                      </div>
                    </div>
                    <br>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <label class="h5" for="">วันเดินทาง</label>
                        <div class="row">
                          <div class="col-sm-5">
                            <input id="datepicker" placeholder="วันเดินทางไป" name="dateStart" width="100%" />
                          </div>
                          ถึง
                          <div class="col-sm-5">
                            <input id="datepicker2" placeholder="วันเดินทางกลับ" name="dateEnd" width="100%" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label class="h5" for="">วันปิดจอง</label>
                        <div class="col-sm-12">
                          <input id="datepicker3" placeholder="วันที่ปิดจองแพ็คเกจ" name="dateDue" width="100%" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12" align="center">
                      <input type="submit" name="add" class="btn btn-success btn-lg font-weight-bold" value="ยืนยันการเพิ่มแพ็คเกจ">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php }else{ ?>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-12">
                <div class="card mb-4" id="headling">
                  <h3 class="card-header">
                    <div class="form-group row">
                      <label for="" class="ml-3 col-form-label">ชื่อแพ็คเกจ : </label>
                      <div class="col-sm-10 pt-2">
                        <input type="text" name="id" value="<?=$tourid?>" hidden>
                        <input type="text" class="form-control" name="name" value="<?= $tourName?>" placeholder="ชื่อแพ็คเกจการท่องเที่ยว">
                      </div>
                    </div>
                  </h3>
                  <div class="card-body">
                    <div class="card-img">
                      <div class="form-group">
                        <label class="col-sm-12 col-form-label h5" align="center"><i class="fas fa-image fa-2x"></i> แก้ไขรูปประกอบ</label>
                        <div class="col-sm-10" style="margin-left: auto; margin-right: auto;">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="customFile" id="customFile" value="<?= $img?>">
                            <label class="custom-file-label" for="customFile" name="customFile" id="file"><?= $img?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <h4><i class="fas fa-route"></i>&nbsp; รายละเอียดการท่องเที่ยว </h4><hr>
                      <div class="col-form-label form-group">
                        <textarea class="form-control" name="detail" id="" cols="30" rows="10"><?= $detail?></textarea>
                      </div>
                      <h5>กิจกรรมตลอดแพ็คเกจ</h5>
                      <div class="form-group">
                        <textarea class="form-control" name="activity" id="" cols="30" rows="10"><?= $act?></textarea>
                      </div>
                      <br>
                      <div class="form-group row">
                        <div class="col-3 mt-1" align="right">
                          <label class="h5">ภูมิภาค</label> 
                        </div>
                        <div class="col-sm-9">
                          <select id="inputState" name="section" class="form-control">
                            <option value="<?= $sectionid?>" selected><?= $section?></option>
                            <option value="001">ภาคเหนือ</option>
                            <option value="006">ภาคใต้</option>
                            <option value="004">ภาคกลาง</option>
                            <option value="002">ภาคอีสาน</option>
                          </select>
                        </div>
                      </div>
                      <br>
                      <div class="form-row">
                        <div class="form-group col-md-6 row">
                          <div class="col-6 mt-1" align="right">
                            <label class="h5" for="">อัตราค่าบริการ</label>
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" name="price" value="<?= $price?>" placeholder="บาท/ท่าน">
                          </div>
                        </div>
                        <div class="form-group col-md-6 row">
                          <div class="col-6 mt-1" align="right">
                            <label class="h5" for="">จำนวนผู้เข้าร่วม</label>
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" name="seat" value="<?= $numSeat?>" placeholder="ท่าน">
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="form-group row">
                        <div class="col-3 mt-1" align="right">
                          <label class="h5">อัตราค่าบริการนี้รวม</label> 
                        </div>
                        <div class="col-sm-9">
                          <textarea class="form-control" name="include" id="" cols="30" rows="6"><?=$include?></textarea>
                        </div>
                      </div>
                      <br>
                      <div class="form-group row">
                        <div class="col-3 mt-1" align="right">
                          <label class="h5">อัตราค่าบริการนี้ไม่รวม</label> 
                        </div>
                        <div class="col-sm-9">
                          <textarea class="form-control" name="notinc" id="" cols="30" rows="6"><?= $notinc?></textarea>
                        </div>
                      </div>
                      <br>
                      <div class="form-row">
                        <div class="form-group col-md-8">
                          <label class="h5" for="">วันเดินทาง</label>
                          <div class="row">
                            <div class="col-sm-5">
                              <input type="text" id="datepicker" placeholder="วันเดินทางไป" data-date-format='yyyy-mm-dd' value="<?=$dateStart?>" name="dateStart" width="100%" />
                            </div>
                            ถึง
                            <div class="col-sm-5">
                              <input type="text" id="datepicker2" placeholder="วันเดินทางกลับ" data-date-format='yyyy-mm-dd' value="<?=$dateEnd?>" name="dateEnd" width="100%" />
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="h5" for="">วันปิดจอง</label>
                          <div class="col-sm-12">
                            <input id="datepicker3" placeholder="วันที่ปิดจองแพ็คเกจ" value="<?= $dateDue?>" name="dateDue" width="100%" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12" align="center">
                        <input type="submit" name="edit" class="btn btn-warning btn-lg font-weight-bold" value="ยืนยันการแก้ไขแพ็คเกจ">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </form>
        <?php } ?>
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script>
      $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
      });
      $('#datepicker2').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
      });
      $('#datepicker3').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
      });
      $('#datepicker4').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
      });
      $('#datepicker5').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
      });
      $('#datepicker6').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4'
      });
    </script>
    <script>
      var filename1 = document.getElementById('file1');
      var upload1 = document.getElementById('customFile1');

      upload1.addEventListener("change", ()=>{
        var name1 = upload1.value.substring(12, upload1.value.length);
        console.log(name1);
        filename1.innerHTML = name1;
      });
    </script>
    <script>
      var filename = document.getElementById('file');
      var upload = document.getElementById('customFile');
            
      upload.addEventListener("change", ()=>{
        var name = upload.value.substring(12, upload.value.length);
        console.log(name);
        filename.innerHTML = name;
      });
    </script>
  </body>
</html>