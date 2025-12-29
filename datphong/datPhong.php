<?php 
  //  kiểm tra điều kiện trước khi vào trang
   if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
         header("Location: ./auth/dangNhap.php");
         exit;
      }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      main {
        padding: 80px 0 0;
      }

      h1 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 32px;
        font-weight: 700;
      }

      h4 {
        color: rgb(135, 138, 138);
        font-weight: 400;
        margin-bottom: 20px;
      }

      .tin2 {
        margin-top: 40px;
        position: relative;
      }

      .timkiem {
        padding: 5px 5px;
        width: 100%;
      }

      .tin2 .timkiem {
        width: 100%;
        padding: 14px 14px 14px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        margin-top: 15px;
        transition: all 0.3s ease;
        background-color: white;
      }

      .tin2 .timkiem:focus {
        outline: none;
        border-color: #07a5fe;
        box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
      }

      .tin2 i {
        position: absolute;
        margin-top: 28px;
        margin-left: 18px;
        color: #999;
        font-size: 16px;
      }

      .box {
        background-color: white;
        width: 100%;
        height: 270px;
        margin: 25px 0px 50px;
        display: flex;
        border-radius: 12px;
        padding: 15px 15px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
      }

      .box:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
      }

      .box img {
        width: 250px;
        height: 240px;
        object-fit: cover;
        align-self: center;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }

      li {
        list-style: none;
      }

      .box1 {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-left: 20px;
        flex: 1;
        padding: 5px 0;
      }

      .box1 li b {
        font-size: 22px;
        color: #2c3e50;
        font-weight: 600;
      }

      .box1 p {
        color: #7a7a7a;
        margin: 12px 0px;
        font-size: 15px;
        line-height: 1.5;
      }

      .box1 b {
        font-size: 20px;
        color: #2c3e50;
        font-weight: 600;
      }

      .box10 {
        margin-top: -10px;
      }

      .box11 {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-top: 10px;
      }

      .nutbox11 {
        border: 1px solid #07a5fe;
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
        background-color: #07a5fe;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(138, 43, 226, 0.2);
      }

      .nutbox11:hover {
        transform: translateY(-1px);
      }

      .nutbox12 {
        border: 1px solid rgb(200, 200, 200);
        padding: 10px 20px;
        border-radius: 8px;
        color: #333;
        background-color: rgba(240, 240, 240, 0.97);
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
      }

      .nutbox12:hover {
        background-color: rgba(220, 220, 220, 0.97);
        border-color: rgb(180, 180, 180);
        transform: translateY(-1px);
      }

      .nutbox13 {
        color: #e74c3c;
        font-weight: 500;
        font-size: 14px;
        padding: 10px 0;
        transition: all 0.3s ease;
      }

      .nutbox13:hover {
        color: #c0392b;
        text-decoration: underline;
      }

      .tinhtrang {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
      }

      .trangthaiCho {
        border: 1px solid #f39c12;
        background-color: #f39c12;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
      }

      .trangthaiXacNhan {
        border: 1px solid #4caf50;
        background-color: #4caf50;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
      }

      .trangthaiHuy {
        border: 1px solid #e74c3c;
        background-color: #e74c3c;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
      }

      .box2 {
        border: 2px dashed #d0d0d0;
        height: auto;
        min-height: 450px;
        padding: 60px 40px;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: linear-gradient(
          to bottom,
          rgba(255, 255, 255, 0.95),
          rgba(250, 250, 250, 0.95)
        );
      }

      .box21 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100%;
        max-width: 500px;
      }

      .icon {
        font-size: 90px;
        color: #07a5fe;
        margin-bottom: 25px;
      }

      .title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 18px;
        color: #2c3e50;
      }

      .text {
        color: #666;
        margin: 10px 0;
        font-size: 16px;
        line-height: 1.6;
      }

      .timkiemcuoi {
        margin-top: 35px;
        padding: 14px 40px;
        border-radius: 8px;
        color: white;
        background-color: #07a5fe;
        border: 1px solid #07a5fe;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(138, 43, 226, 0.25);
      }

      .timkiemcuoi:hover {
        background-color: #07a5fe;
        border-color: #07a5fe;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.35);
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
    <main>
      <div class="main__content">
        <div class="tin2">
          <h1>Đặt phòng của tôi</h1>
          <h4>Xem và quản lí các chuyến đi sắp tới của bạn</h4>
          <i class="fa fa-search" aria-hidden="true"></i>
          <input
            class="timkiem"
            type="text"
            name=""
            id="searchInput"
            placeholder="Tìm theo tên khách sạn hoặc mã đặt phòng "
          />
        </div>
        
        <?php 
          // Lấy id người dùng từ session
          $nguoiDungId = $_SESSION["idNguoiDung"];
          
          // Query lấy danh sách đặt phòng của người dùng
          $sqlDatPhong = "SELECT ddp.*, ks.ten_khach_san, dd.ten_dia_diem, tt.tong_tien, tt.trang_thai as trang_thai_tt
                         FROM don_dat_phong ddp
                         LEFT JOIN khach_san ks ON ddp.khach_san_id = ks.id
                         LEFT JOIN dia_diem dd ON ks.dia_diem_id = dd.id
                         LEFT JOIN thanh_toan tt ON ddp.id = tt.don_dat_phong_id
                         WHERE ddp.nguoi_dung_id = '$nguoiDungId'
                         ORDER BY ddp.id DESC";
          $resultDatPhong = mysqli_query($conn, $sqlDatPhong);
          
          if($resultDatPhong && mysqli_num_rows($resultDatPhong) > 0){
            while($rowDp = mysqli_fetch_assoc($resultDatPhong)){
              // Lấy ảnh khách sạn
              $ksId = $rowDp["khach_san_id"];
              $sqlAnh = "SELECT path FROM anh_khach_san WHERE khach_san_id = '$ksId' LIMIT 1";
              $resultAnh = mysqli_query($conn, $sqlAnh);
              $imgPath = "./assets/img/logo.png";
              if($resultAnh && mysqli_num_rows($resultAnh) > 0){
                $rowAnh = mysqli_fetch_assoc($resultAnh);
                $imgPath = substr($rowAnh["path"], 1);
              }
              
              // Lấy chi tiết phòng đã đặt
              $ddpId = $rowDp["id"];
              $sqlChiTiet = "SELECT COUNT(*) as so_phong FROM chi_tiet_dat_phong WHERE don_dat_phong_id = '$ddpId'";
              $resultChiTiet = mysqli_query($conn, $sqlChiTiet);
              $soPhong = 1;
              if($resultChiTiet && mysqli_num_rows($resultChiTiet) > 0){
                $rowChiTiet = mysqli_fetch_assoc($resultChiTiet);
                $soPhong = $rowChiTiet["so_phong"];
              }
              
              // Format ngày
              $ngayNhan = date("d/m/Y", strtotime($rowDp["ngay_nhan"]));
              $ngayTra = date("d/m/Y", strtotime($rowDp["ngay_tra"]));
              
              // Xác định class trạng thái
              $trangThai = $rowDp["trang_thai"];
              $trangThaiClass = "trangthaiCho";
              $trangThaiText = "Chờ xác nhận";
              if($trangThai == "xac nhan"){
                $trangThaiClass = "trangthaiXacNhan";
                $trangThaiText = "Đã xác nhận";
              } else if($trangThai == "huy"){
                $trangThaiClass = "trangthaiHuy";
                $trangThaiText = "Đã hủy";
              }
        ?>
        <div class="box" data-name="<?php echo $rowDp["ten_khach_san"]; ?>" data-id="<?php echo $rowDp["id"]; ?>">
          <img src="<?php echo $imgPath; ?>" alt="" />
          <div class="box1">
            <div class="box10">
              <div class="tinhtrang">
                <li><b><?php echo $rowDp["ten_khach_san"]; ?></b></li>
                <span class="<?php echo $trangThaiClass; ?>"><?php echo $trangThaiText; ?></span>
              </div>
              <p><?php echo $rowDp["ten_dia_diem"]; ?>, Hà Nội</p>
              <p>Ngày <?php echo $ngayNhan; ?> - <?php echo $ngayTra; ?> | <?php echo $soPhong; ?> phòng</p>
              <b>Tổng cộng: <?php echo number_format($rowDp["tong_tien"], 0, ',', '.'); ?> VND</b>
            </div>
            <div class="box11">
              <a class="nutbox11" href="index.php?chuyen_trang=chiTietDatPhong&id=<?php echo $rowDp["id"]; ?>">Xem chi tiết</a>
              <?php if($trangThai != "huy"){ ?>
              <a class="nutbox13" href="index.php?chuyen_trang=huyDatPhong&id=<?php echo $rowDp["id"]; ?>">Hủy đặt phòng</a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php 
            }
          } else {
        ?>
        <div class="box box2">
          <div class="box21">
            <i class="fa fa-suitcase icon" aria-hidden="true"></i>
            <h2 class="title">Không tìm thấy đặt phòng</h2>
            <p class="text">Bạn chưa có chuyến đi nào sắp tới.</p>
            <p class="text">
              Hãy bắt đầu lên kế hoạch cho chuyến phiêu lưu tiếp theo của bạn!
            </p>
            <a class="timkiemcuoi" href="index.php?chuyen_trang=diemDen">Bắt đầu tìm kiếm</a>
          </div>
        </div>
        <?php } ?>
      </div>
    </main>
     <?php include "./includes/footer.php";  ?>
    <script>
      // Tìm kiếm đặt phòng
      const searchInput = document.getElementById('searchInput');
      const boxes = document.querySelectorAll('.box');
      searchInput.addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        boxes.forEach(box => {
          const hotelName = box.getAttribute('data-name')?.toLowerCase() || '';          
          if(hotelName.includes(searchValue)) {
            box.style.display = 'flex';
          } else {
            box.style.display = 'none';
          }
        });
      });
    </script>
  </body>
</html>
