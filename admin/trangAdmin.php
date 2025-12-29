<?php ob_start(); ?>
<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location: login.php");
}
$page = $_GET['page_layout'] ?? 'trangTongQuan';
if (isset($_GET["page_layout"])) {
  switch ($_GET["page_layout"]) {
    case "dangXuat":
      session_unset();
      session_destroy();
      header('location: login.php');
      break;
  }
}
include("../includes/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: white;
      color: #333;
    }

    .khung-chua {
      display: flex;
      height: 100vh;
    }

    .trinh-don-ben {
      width: 269px;
      height: 100vh;
      background-color: #293b5f;
      border-right: 1px solid #131414;
      flex-shrink: 0;
      overflow-y: hidden;
    }

    .khung-chua-hai {
      flex-grow: 1;
      overflow-y: auto;
      height: 100%;
    }

    .xin-chao {
      color: #009BFF
    }

    .phan-tren {
      height: 10%;
      background-color: #f5f5f5;
      display: flex;
      align-items: center;
    }

    .tim-kiem {
      margin-left: 20px;
      display: flex;
      margin-right: 34%;
    }

    .tim-kiem input {
      width: 500px;
    }

    .tim-kiem button {
      width: 20%;
      height: 36px;
      background-color: #009BFF;
      color: white;
      border: none;
    }

    .tai-khoan {
      margin-left: 10px;
    }

    .anh-quan-tri {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .lien-ket-tren {
      padding: 0;
      margin: -10px 0 0 0;
      list-style: none;
    }

    .lien-ket-duoi {
      padding: 0;
      margin: 100px 0 0 0;
      list-style: none;
    }

    .trinh-don-ben li:hover,
    .trinh-don-ben li.kich-hoat {
      background-color: rgba(255, 255, 255, 0.3);
    }

    .trinh-don-ben li.kich-hoat {
      border-left: 4px solid #009BFF;
    }

    .lien-ket-tren li a,
    .lien-ket-duoi li a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 20px;
      text-decoration: none;
      color: white;
    }

    .lien-ket-tren i,
    .lien-ket-duoi i {
      width: 22px;
      font-size: 18px;
    }
  </style>
</head>

<body>

  <header class="khung-chua">
    <div class="trinh-don-ben">
      <div class="chu-trinh-don">
        <div class="anh-quan-tri">
          <img width="80%" src="./img/logo-utt-border.png" alt="" />
        </div>

        <div class="duong-dan">
          <ul class="lien-ket-tren">
            <li class="<?= $page == 'trangTongQuan' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangTongQuan">
                <i class="fa-solid fa-tachometer-alt"></i> Trang tổng quan
              </a>
            </li>

            <li class="<?= $page == 'trangNguoiDung' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangNguoiDung">
                <i class="fa-solid fa-user"></i> Người dùng
              </a>
            </li>

            <li class="<?= $page == 'trangDonDatPhong' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangDonDatPhong"><i class="fa-solid fa-book"></i> Đơn đặt phòng</a>
            </li>
            <li class="<?= $page == 'trangPhong' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangPhong"><i class="fa-solid fa-bed"></i>phòng</a>
            </li>
            <li class="<?= $page == 'trangDiaDiem' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangDiaDiem"><i class="fa-solid fa-location-dot"></i> Địa điểm</a>
            </li>
            <li class="<?= $page == 'trangKhachSan' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangKhachSan"><i class="fa-solid fa-hotel"></i> Khách sạn</a>
            </li>
            <li class="<?= $page == 'trangAnh' ? 'kich-hoat' : '' ?>">
              <a href="trangAdmin.php?page_layout=trangAnh"> <i class="fa-regular fa-file-image icon"></i> Ảnh </a>
            </li>
          </ul>

          <ul class="lien-ket-duoi">
            <li>
              <a href=""><i class="fa-solid fa-home"></i> Trang chủ</a>
            </li>
            <li>
              <a href="trangAdmin.php?page_layout=dangXuat"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="khung-chua-hai">
      <div class="phan-tren">
        <form class="tim-kiem">
          <input class="tim-kiem-mot" type="text" placeholder="Tìm kiếm..." />
          <button class="tim-kiem-hai" type="submit">Tìm kiếm</button>
        </form>
        <div>
          <?php echo "<p class='xin-chao'>Xin chào " . $_SESSION["username"] . "</p>" ?>
        </div>
        <div class="tai-khoan">
          <a href="#"><img width="45px" src="./img/account.png" alt=""></a>
        </div>
      </div>
      <?php
      if (isset($_GET["page_layout"])) {
        switch ($_GET["page_layout"]) {
          case "trangTongQuan":
            include("./trang_tong_quan/trangTongQuan.php");
            break;
          case "trangNguoiDung":
            include("./trang_nguoi_dung/trangNguoiDung.php");
            break;
          case "capNhatNguoiDung":
            include("./trang_nguoi_dung/capNhatNguoiDung.php");
            break;
          case "themNguoiDung":
            include("./trang_nguoi_dung/themNguoiDung.php");
            break;
          case "trangDiaDiem":
            include("./dia_diem/trangDiaDiem.php");
            break;
          case "capNhatDiaDiem":
            include("./dia_diem/capNhatDiaDiem.php");
            break;
          case "themDiaDiem":
            include("./dia_diem/themDiaDiem.php");
            break;
          case "trangKhachSan":
            include("./khach_san/trangKhachSan.php");
            break;
          case "themKhachSan":
            include("./khach_san/themKhachSan.php");
            break;
          case "capNhatKhachSan":
            include("./khach_san/capNhatKhachSan.php");
            break;
          case "trangPhong":
            include("./phong/trangPhong.php");
            break;
          case "themPhong":
            include("./phong/themPhong.php");
            break;
          case "capNhatPhong":
            include("./phong/capNhatPhong.php");
            break;
          case "trangAnh":
            include("./quan_li_anh/trangAnh.php");
            break;
          case "themAnh":
            include("./quan_li_anh/themAnh.php");
            break;
          case "capNhatAnh":
            include("./quan_li_anh/capNhatAnh.php");
            break;
          case "trangDonDatPhong":
            include("./don_dat_phong/trangDonDatPhong.php");
            break;
          case "chiTietDonDatPhong":
            include("./don_dat_phong/chiTietDonDatPhong.php");
            break;
        }
      }
      ?>
    </div>
  </header>

</body>

</html>
<?php ob_end_flush(); ?>