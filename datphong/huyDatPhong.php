<?php
  // Kiểm tra đăng nhập
  if(!isset($_SESSION["hoTen"], $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
    header("Location: ./auth/dangNhap.php");
    exit;
  }

  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $nguoiDungId = $_SESSION["idNguoiDung"];
    
    // Kiểm tra đơn đặt phòng có thuộc về người dùng này không
    $sqlCheck = "SELECT * FROM don_dat_phong WHERE id = '$id' AND nguoi_dung_id = '$nguoiDungId'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    
    if($resultCheck && mysqli_num_rows($resultCheck) > 0){
      // Cập nhật trạng thái phòng về "trong"
      $sqlCapNhatPhong = "UPDATE phong SET trang_thai = 'trong' WHERE id IN (SELECT phong_id FROM chi_tiet_dat_phong WHERE don_dat_phong_id = '$id')";
      mysqli_query($conn, $sqlCapNhatPhong);
      
      // Cập nhật trạng thái đơn thành "huy"
      $sqlHuy = "UPDATE don_dat_phong SET trang_thai = 'huy' WHERE id = '$id'";
      mysqli_query($conn, $sqlHuy);
      
      ?>
      <!DOCTYPE html>
      <html>
      <head>
        <style>
          .phunen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
          }
          .hopthongbao {
            background: white;
            padding: 40px 50px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
          }
          .iconthongbao {
            width: 80px;
            height: 80px;
            background: #4caf50;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
          }
          .iconthongbao i {
            font-size: 40px;
            color: white;
          }
          .tieudethongbao {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
          }
          .noidungthongbao {
            font-size: 16px;
            color: #7a7a7a;
            margin-bottom: 25px;
          }
          .nutthongbao {
            background: #07a5fe;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
          }
        </style>
      </head>
      <body>
        <div class="phunen">
          <div class="hopthongbao">
            <div class="iconthongbao">
              <i class="fa fa-check"></i>
            </div>
            <h2 class="tieudethongbao">Hủy phòng thành công!</h2>
            <p class="noidungthongbao">Đơn đặt phòng của bạn đã được hủy.</p>
            <button class="nutthongbao" onclick="window.location.href='index.php?chuyen_trang=datPhong'">Đóng</button>
          </div>
        </div>
      </body>
      </html>
      <?php
      exit;
    } else {
      ?>
      <!DOCTYPE html>
      <html>
      <head>
        <style>
          .phunen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
          }
          .hopthongbao {
            background: white;
            padding: 40px 50px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
          }
          .iconthongbao {
            width: 80px;
            height: 80px;
            background: #e74c3c;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
          }
          .iconthongbao i {
            font-size: 40px;
            color: white;
          }
          .tieudethongbao {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
          }
          .nutthongbao {
            background: #07a5fe;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
          }
        </style>
      </head>
      <body>
        <div class="phunen">
          <div class="hopthongbao">
            <div class="iconthongbao">
              <i class="fa fa-times"></i>
            </div>
            <h2 class="tieudethongbao">Không tìm thấy đơn đặt phòng!</h2>
            <a class="nutthongbao" href="index.php?chuyen_trang=datPhong">Đóng</a>
          </div>
        </div>
      </body>
      </html>
      <?php
      exit;
    }
  } else {
    header("Location: index.php?chuyen_trang=datPhong");
    exit;
  }
?>
