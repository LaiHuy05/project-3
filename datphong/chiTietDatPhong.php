<?php 
  // Kiểm tra đăng nhập
  if(!isset($_SESSION["hoTen"], $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
    header("Location: ./auth/dangNhap.php");
    exit;
  }
  
  if(!isset($_GET["id"])){
    header("Location: index.php?chuyen_trang=datPhong");
    exit;
  }
  
  $donId = $_GET["id"];
  $nguoiDungId = $_SESSION["idNguoiDung"];
  
  // Lấy thông tin đơn đặt phòng
  $sqlDon = "SELECT ddp.*, ks.ten_khach_san, ks.so_dien_thoai, ks.email, dd.ten_dia_diem, tt.tong_tien, tt.phuong_thuc, tt.trang_thai as trang_thai_tt
             FROM don_dat_phong ddp
             LEFT JOIN khach_san ks ON ddp.khach_san_id = ks.id
             LEFT JOIN dia_diem dd ON ks.dia_diem_id = dd.id
             LEFT JOIN thanh_toan tt ON ddp.id = tt.don_dat_phong_id
             WHERE ddp.id = '$donId' AND ddp.nguoi_dung_id = '$nguoiDungId'";
  $resultDon = mysqli_query($conn, $sqlDon);
  
  if(!$resultDon || mysqli_num_rows($resultDon) == 0){
    echo "<script>alert('Không tìm thấy đơn đặt phòng!'); window.location.href='index.php?chuyen_trang=datPhong';</script>";
    exit;
  }
  
  $don = mysqli_fetch_assoc($resultDon);
  
  // Lấy ảnh khách sạn
  $ksId = $don["khach_san_id"];
  $sqlAnh = "SELECT path FROM anh_khach_san WHERE khach_san_id = '$ksId' LIMIT 1";
  $resultAnh = mysqli_query($conn, $sqlAnh);
  $imgPath = "./assets/img/logo.png";
  if($resultAnh && mysqli_num_rows($resultAnh) > 0){
    $rowAnh = mysqli_fetch_assoc($resultAnh);
    $imgPath = substr($rowAnh["path"], 1);
  }
  
  // Lấy chi tiết phòng đã đặt
  $sqlPhong = "SELECT ctdp.*, p.so_phong, p.loai_phong 
               FROM chi_tiet_dat_phong ctdp
               LEFT JOIN phong p ON ctdp.phong_id = p.id
               WHERE ctdp.don_dat_phong_id = '$donId'";
  $resultPhong = mysqli_query($conn, $sqlPhong);
  
  // Format ngày
  $ngayNhan = date("d/m/Y", strtotime($don["ngay_nhan"]));
  $ngayTra = date("d/m/Y", strtotime($don["ngay_tra"]));
  
  // Tính số đêm
  $date1 = new DateTime($don["ngay_nhan"]);
  $date2 = new DateTime($don["ngay_tra"]);
  $soDem = $date1->diff($date2)->days;
  
  // Trạng thái đơn
  $trangThai = $don["trang_thai"];
  $trangThaiClass = "trangthaiCho";
  $trangThaiText = "Chờ xác nhận";
  if($trangThai == "xac nhan"){
    $trangThaiClass = "trangthaiXacNhan";
    $trangThaiText = "Đã xác nhận";
  } else if($trangThai == "huy"){
    $trangThaiClass = "trangthaiHuy";
    $trangThaiText = "Đã hủy";
  }
  
  // Trạng thái thanh toán
  $trangThaiTT = $don["trang_thai_tt"];
  $trangThaiTTText = "Chờ thanh toán";
  if($trangThaiTT == "da thanh toan"){
    $trangThaiTTText = "Đã thanh toán";
  } else if($trangThaiTT == "hoan tien"){
    $trangThaiTTText = "Hoàn tiền";
  }
  
  // Phương thức thanh toán
  $phuongThuc = $don["phuong_thuc"];
  $phuongThucText = "Chưa chọn";
  if($phuongThuc == "the") $phuongThucText = "Thẻ tín dụng";
  else if($phuongThuc == "chuyen khoan") $phuongThucText = "Chuyển khoản";
  else if($phuongThuc == "tien mat") $phuongThucText = "Tiền mặt";
  else if($phuongThuc == "vi dien tu") $phuongThucText = "Ví điện tử";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .chitiet {
      padding: 180px 0 80px 0;
    }
    
    .tieude {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 30px;
    }
    
    .tieude a {
      color: #07a5fe;
      font-size: 16px;
    }
    
    .tieude h1 {
      font-size: 28px;
      color: #2c3e50;
    }
    
    .noidung {
      display: flex;
      gap: 30px;
    }
    
    .cottrai {
      flex: 2;
    }
    
    .cotphai {
      flex: 1;
    }
    
    .hopct {
      background: white;
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }
    
    .hopct h3 {
      font-size: 18px;
      color: #2c3e50;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }
    
    .khachsan {
      display: flex;
      gap: 20px;
    }
    
    .khachsan img {
      width: 150px;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
    }
    
    .thongtinks h4 {
      font-size: 20px;
      color: #2c3e50;
      margin-bottom: 8px;
    }
    
    .thongtinks p {
      color: #7a7a7a;
      font-size: 14px;
      margin-bottom: 5px;
    }
    
    .hangtt {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid #f0f0f0;
    }
    
    .nhan {
      color: #7a7a7a;
    }
    
    .giatri {
      font-weight: 500;
      color: #2c3e50;
    }
    
    .phong {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px;
      background: #f8f9fa;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    
    .thongtinphong h4 {
      font-size: 16px;
      color: #2c3e50;
      margin-bottom: 5px;
    }
    
    .thongtinphong p {
      color: #7a7a7a;
      font-size: 14px;
    }
    
    .giaphong {
      font-size: 16px;
      font-weight: 600;
      color: #07a5fe;
    }
    
    .tongtien {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 15px;
      margin-top: 15px;
      border-top: 2px solid #eee;
    }
    
    .nhantongtien {
      font-size: 18px;
      font-weight: 600;
      color: #2c3e50;
    }
    
    .giatritongtien {
      font-size: 24px;
      font-weight: 700;
      color: #07a5fe;
    }
    
    .trangthaiCho {
      background-color: #f39c12;
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
    }
    
    .trangthaiXacNhan {
      background-color: #4caf50;
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
    }
    
    .trangthaiHuy {
      background-color: #e74c3c;
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
    }
    
    .nutxem {
      display: block;
      width: 100%;
      padding: 12px;
      text-align: center;
      border-radius: 8px;
      font-weight: 500;
      margin-top: 15px;
      text-decoration: none;
      transition: all 0.3s;
      background: #07a5fe;
      color: white;
    }
    
    .nuthuy {
      display: block;
      width: 100%;
      padding: 12px;
      text-align: center;
      border-radius: 8px;
      font-weight: 500;
      margin-top: 15px;
      text-decoration: none;
      transition: all 0.3s;
      background: white;
      color: #e74c3c;
      border: 1px solid #e74c3c;
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
  <div class="chitiet">
    <div class="main__content">
      <div class="tieude">
        <a href="index.php?chuyen_trang=datPhong"><i class="fa fa-arrow-left"></i> Quay lại</a>
        <h1>Chi tiết đặt phòng</h1>
      </div>
      
      <div class="noidung">
        <div class="cottrai">
          <!-- Thông tin khách sạn -->
          <div class="hopct">
            <h3>Thông tin khách sạn</h3>
            <div class="khachsan">
              <img src="<?php echo $imgPath; ?>" alt="">
              <div class="thongtinks">
                <h4><?php echo $don["ten_khach_san"]; ?></h4>
                <p><i class="fa fa-map-marker"></i> <?php echo $don["ten_dia_diem"]; ?>, Hà Nội</p>
                <p><i class="fa fa-phone"></i> <?php echo $don["so_dien_thoai"]; ?></p>
                <p><i class="fa fa-envelope"></i> <?php echo $don["email"]; ?></p>
              </div>
            </div>
          </div>
          
          <!-- Thông tin đặt phòng -->
          <div class="hopct">
            <h3>Thông tin đặt phòng</h3>
            <div class="hangtt">
              <span class="nhan">Ngày nhận phòng</span>
              <span class="giatri"><?php echo $ngayNhan; ?></span>
            </div>
            <div class="hangtt">
              <span class="nhan">Ngày trả phòng</span>
              <span class="giatri"><?php echo $ngayTra; ?></span>
            </div>
            <div class="hangtt">
              <span class="nhan">Số đêm</span>
              <span class="giatri"><?php echo $soDem; ?> đêm</span>
            </div>
            <div class="hangtt">
              <span class="nhan">Trạng thái đơn</span>
              <span class="<?php echo $trangThaiClass; ?>"><?php echo $trangThaiText; ?></span>
            </div>
          </div>
          
          <!-- Chi tiết phòng -->
          <div class="hopct">
            <h3>Chi tiết phòng đã đặt</h3>
            <?php 
              if($resultPhong && mysqli_num_rows($resultPhong) > 0){
                while($phong = mysqli_fetch_assoc($resultPhong)){
            ?>
            <div class="phong">
              <div class="thongtinphong">
                <h4>Phòng <?php echo $phong["so_phong"]; ?></h4>
                <p><?php echo $phong["loai_phong"]; ?></p>
              </div>
              <div class="giaphong">
                <?php echo number_format($phong["gia_phong"], 0, ',', '.'); ?> VND
              </div>
            </div>
            <?php 
                }
              } else {
                echo "<p>Không có thông tin phòng</p>";
              }
            ?>
          </div>
        </div>
        
        <div class="cotphai">
          <!-- Thanh toán -->
          <div class="hopct">
            <h3>Thông tin thanh toán</h3>
            <div class="hangtt">
              <span class="nhan">Phương thức</span>
              <span class="giatri"><?php echo $phuongThucText; ?></span>
            </div>
            <div class="hangtt">
              <span class="nhan">Trạng thái</span>
              <span class="giatri"><?php echo $trangThaiText; ?></span>
            </div>
            <div class="tongtien">
              <span class="nhantongtien">Tổng tiền</span>
              <span class="giatritongtien"><?php echo number_format($don["tong_tien"], 0, ',', '.'); ?> VND</span>
            </div>
          </div>
          
          <!-- Nút hành động -->
          <div class="hopct">
            <a class="nutxem" href="index.php?chuyen_trang=khachSan&id=<?php echo $don["khach_san_id"]; ?>">
              Xem khách sạn
            </a>
            <?php if($trangThai != "huy"){ ?>
            <a class="nuthuy" href="index.php?chuyen_trang=huyDatPhong&id=<?php echo $don["id"]; ?>">
              Hủy đặt phòng
            </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
   <?php include "./includes/footer.php";  ?>
</body>
</html>
