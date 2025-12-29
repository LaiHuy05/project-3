<?php 
  include "./includes/connect.php";
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- reset css -->
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <!-- nhúng font chữ -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sora:wght@100..800&display=swap"
      rel="stylesheet"
    />
    <!-- font awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <!-- style css -->
    <link rel="stylesheet" href="./assets/css/style.css" />

    <title>UTT Booking</title>
</head>
<body>
  <main>
   <?php
      if(isset($_GET["chuyen_trang"])){
       switch($_GET["chuyen_trang"]){
          case "trangChu":
              include "trangChu.php";
              break;
          case "diemDen":
              include  "./khachSan/diemDen.php";
              break;
          case "datPhong":  
              include "./datphong/datPhong.php";
              break;
          case "khachSan":               
              include "./khachSan/chiTietKhachSan.php";
              break;
          case "themDon":
              include "./taoDon/themDon.php";
              break;
          case "thanhToan":
              include "./taoDon/thanhToan.php";
              break; 
          case "danhSachKhachSan":
              include "./khachSan/danhSachKhachSan.php";
              break; 
          case "timKhachSan":
              include "./khachSan/timKhachSan.php";
              break;
          case "timKhachSan2":
              include "./khachSan/timKhachSan2.php";
              break;
          case "nguoiDung":
              include "nguoiDung.php";
              break;
          case "huyDatPhong":
              include "./datphong/huyDatPhong.php";
              break;
          case "chiTietDatPhong":
              include "./datphong/chiTietDatPhong.php";
              break;
        } 
     }else{
       include "trangChu.php";
     }
  ?>
  </main>
  <script src="./assets/js/main.js"></script>
</body>
</html>