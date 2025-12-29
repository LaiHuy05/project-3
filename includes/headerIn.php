<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
       <div class="navigation">
        <div class="main__content">
          <div class="navigation__main">
            <a href="index.php?chuyen_trang=trangChu"><img src="./assets/img/image.png" alt="" /></a>
             <div class="nav__link">
              <div class="nav__link__a">
                <a class="<?php if(isset($_GET["chuyen_trang"])){if($_GET["chuyen_trang"] == "trangChu"){echo "link__active";}}?>" href="index.php?chuyen_trang=trangChu">Trang Chủ</a>
                <a class="<?php if(isset($_GET["chuyen_trang"])){if($_GET["chuyen_trang"] == "diemDen" ){echo "link__active";}}?>" href="index.php?chuyen_trang=diemDen">Điểm Đến</a>
                <a class="<?php if(isset($_GET["chuyen_trang"])){if($_GET["chuyen_trang"] == "datPhong"){echo "link__active";}}?>" href="index.php?chuyen_trang=datPhong">Đặt Phòng Của Tôi</a>
              </div>
            </div>
            <div class="nav__link__button">
                <button class="sign__up">
                  <a href="./auth/dangNhap.php" style="color: white"
                    >Đăng Nhập</a>
                </button>
                <button class="register">
                  <a href="./auth/dangKy.php">Đăng Ký</a>
                </button>
              </div>
          </div>
        </div>
      </div>
</body>
</html>