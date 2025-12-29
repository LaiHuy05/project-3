 <?php  
     // kiểm tra dữ liệu trước khi vào trang
    if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
         header("Location: ./auth/dangNhap.php");
         exit;
      }
    if(isset($_POST["phuongThuc"]) && isset($_POST["donDatPhongId"]) && isset($_POST["tongTien"]) && isset($_POST["trangThai"])){
      $donDatPhongId = $_POST["donDatPhongId"];
      $tongTien = $_POST["tongTien"];
      $pt = $_POST["phuongThuc"];
      $tt = $_POST["trangThai"];
      $sqlTt = "insert into thanh_toan (don_dat_phong_id , tong_tien , phuong_thuc , trang_thai) values
       ('$donDatPhongId' , '$tongTien' , '$pt' , '$tt')";
      $resultTt = mysqli_query($conn , $sqlTt);
     } 
          
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
      body {
        margin-top: 100px;
      }
      .container{
        padding:30px 0 150px;
      }
      .gif img{
        border-radius:10px;
        width: 100%;
        height: 500px;
      }
      .out__main{
        margin-top:10px;
        display:flex;
        justify-content:center;
        gap: 20px;
      }
      .out{
         background-color:var(--primary-color);
         display:flex;
         align-items:center;
         width: 20%;
         padding:20px;
         border-radius:10px;
         
         color:white;
      }
      a.xem__phong{
        color:white;
        margin-right:10px;
      }
      h1.mess{
        position:relative;
        font-size:30px;
        font-weight:800;
        background:var(--primary-color);
        text-align:center;
        color:white;
        padding :50px;
        border-radius:5px;
        margin-bottom: 30px;
        overflow:hidden;
      }
      
  </style>
</head>
<body>
  <header>
    <?php
      if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
          include "./includes/headerIn.php";
      }          
      else{
          include "./includes/headerOut.php";
      }
   ?>
  </header>
  <div class="container">
    <div class="main__content">
      <h1 class="mess">Thanh toán thành công</h1>
      <?php 
        $sqlKs = "select * from don_dat_phong where id='$donDatPhongId'";
        $resultKs = mysqli_query($conn , $sqlKs);
        $rowKs = mysqli_fetch_assoc($resultKs);
      ?>
      <div class="out__main">
        <div class="out">
          <a class="xem__phong" href="index.php?chuyen_trang=datPhong">Xem phòng của bạn</a>
          <i class="fa-solid fa-arrow-right"></i>
        </div>
        <div class="out">
          <a class="xem__phong" href="index.php?chuyen_trang=khachSan&id=<?php echo $rowKs["khach_san_id"]; ?>">Xem các đánh giá</a>
          <i class="fa-solid fa-face-smile"></i>
        </div>
      </div>
    </div>
  </div>
  <?php include "./includes/footer.php";  ?>
</body>
</html>