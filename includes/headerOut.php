<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      * {
        box-sizing: border-box;
      }
      :root {
        --primary-color: #07a5fe;
      }
      body {
        font-family: "Roboto";
        background: #f5f4fa;
      }
      .main__content {
        margin: 0 auto;
        width: 70vw;
      }

      a {
        text-decoration: none;
        color: black;
      }
      button {
        border: 0;
        outline: none;
      }
      /* phần navigation */
      .navigation {
        position: fixed;
        inset: 0;
        height: 100px;
        background-color: #f5f4fa;
        z-index: 10;
        transition: all 0.4s ease;
      }

      .navigation__main img {
        width: 100px;
        height: 90px;
      }
      .main__content .navigation__main {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .navigation__main .nav__link {
        display: flex;
        align-items: center;
      }
      .nav__link__a a {
        font-size: 16px;
        padding: 0 20px;
        transition: all 0.4s ease;
        /* transition: color 0.2s ease; */
      }
      .nav__link__a a:hover,
      .link__active {
        color: var(--primary-color);
      }
      .nav__link__button,.nav__user__button button {
        padding: 10px 20px;
        background-color: var(--primary-color);
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 20px;
        transition: all 0.3s ease;
      }
      .nav__link__button button:active {
        transform: scale(0.98);
      }
      .nav__link__button button:hover {
        filter: brightness(110%);
      }
      .nav__link__button .register {
        background-color: white;
        color: var(--primary-color);
        border: 1px solid #80808082;
      }
      .navigation.scrolled {
        height: 90px;
        background-color: #2c2c2c;
      }
      .navigation.scrolled .user__active i{
        color:#f5f4fa;
      }
      .nav__user {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
      }
      .user__active {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
      }
      .user__active h3 {
        color: #07a5fe;
        font-size: 17px;
      }
      .user__active i {
        font-size: 25px;
        transition:all 0.5s ease;
      }
      .avt{
        width: 30px;
        height:30px;

      }
      .avt img{
        width: 100%;
        height: 100%;
        border-radius:50%;
      }
      .log__out{
        padding: 10px 20px;
        background-color: var(--primary-color);
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 20px;
        transition: all 0.3s ease;
      }
    </style>
  </head>
  <body>
      <div class="navigation">
        <div class="main__content">
          <div class="navigation__main">
            <a href="index.php?chuyen_trang=trangChu"
              ><img src="./assets/img/image.png" alt="lỗi"
            /></a>
            <div class="nav__link">
              <div class="nav__link__a">
                <a class="<?php if(isset($_GET["chuyen_trang"])){if($_GET["chuyen_trang"] == "trangChu"){echo "link__active";}}?>" href="index.php?chuyen_trang=trangChu">Trang Chủ</a>
                <a class="<?php if(isset($_GET["chuyen_trang"])){if($_GET["chuyen_trang"] == "diemDen" ){echo "link__active";}}?>" href="index.php?chuyen_trang=diemDen">Điểm Đến</a>
                <a class="<?php if(isset($_GET["chuyen_trang"])){if($_GET["chuyen_trang"] == "datPhong"){echo "link__active";}}?>" href="index.php?chuyen_trang=datPhong">Đặt Phòng Của Tôi</a>
              </div>
            </div>
            <div class="nav__user">
              <div class="user__active">
                <h3><?php echo $_SESSION["hoTen"]; ?></h3>
                <?php  
                  $idNd = $_SESSION["idNguoiDung"];
                  $sqlNd = "select anh_dai_dien from nguoi_dung where id='$idNd'";
                  $resultNd = mysqli_query($conn , $sqlNd);
                  $rowNd = mysqli_fetch_assoc($resultNd);

                ?>
                <div class="avt"><a href="index.php?chuyen_trang=nguoiDung&id=<?php echo $idNd; ?>"><img src="<?php echo $rowNd["anh_dai_dien"]; ?>" alt=""></a></div>
              </div>
              <div class="nav__user__button">
                  <a class="log__out" href="./auth/dangXuat.php" style="color: white">Đăng Xuất</a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
