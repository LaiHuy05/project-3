<?php 
   if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
         header("Location: ./auth/dangNhap.php");
         exit;
      }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      /* ---------------- HERO ---------------- */

      .hero {
        text-align: center;
        padding: 100px 20px;
        margin-top: 10px;
      }

      .hero h1 {
        font-size: 32px;
        font-weight: 700;
      }

      .hero p {
        color: #555;
        margin-top: 8px;
        font-size: 15px;
      }

      .search-box {
        margin-top: 30px;
        display: inline-flex;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 8px;
        background: white;
      }

      .search-box input {
        width: 330px;
        padding: 10px;
        border: none;
        outline: none;
        font-size: 15px;
      }

      .search-box button {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
      }

      .filters {
        margin-top: 25px;
      }

      .filters select {
        padding: 10px 15px;
        margin: 0 5px;
        border-radius: 6px;
        border: 1px solid #ddd;
        background: white;
        font-size: 14px;
      }

      /* ---------------- DESTINATIONS ---------------- */

      .destinations {
        max-width: 1100px;
        margin: 40px auto 200px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
      }

      .card {
        background: white;
        padding: 12px;
        border-radius: 12px;
        transition: 0.2s;
        cursor: pointer;
      }

      .card:hover {
        transform: translateY(-4px);
      }

      .card img {
        width: 100%;
        height: 260px;
        object-fit: cover;
        border-radius: 10px;
      }

      .card h3 {
        margin-top: 10px;
        font-size: 18px;
        font-weight: 600;
      }

      .card p {
        color: #777;
        margin-top: 3px;
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
    <section class="hero">
      <form action="index.php?chuyen_trang=timKhachSan2" method="post">
        <div class="search-box">
          <input type="text" name="keyword" placeholder="Bạn muốn đi đâu?" />
          <button type="submit">Tìm kiếm</button>
        </div>
      </form>

      
    </section>

    <section class="destinations">
     <?php 
          $sqlDd = "select * from dia_diem where 1";
          $resultDd = mysqli_query($conn , $sqlDd);
          $rowDd = mysqli_fetch_assoc($resultDd);

      ?>
      <div class="card">
        <a href="index.php?chuyen_trang=timKhachSan&id=<?php echo $rowDd["id"]; ?>"><img src="./assets/img/939437285_phuong-hoan-kiem.png" alt="" /></a>
        <h3>Phường Hoàn Kiếm</h3>
        <p>
          Có mật độ khách sạn cao nhất Hà Nội, đặc biệt là các khách sạn 3 sao
          trở xuống
        </p>
      </div>

      <div class="card">
        <a href="index.php?chuyen_trang=timKhachSan&id=<?php $rowDd = mysqli_fetch_assoc($resultDd); echo $rowDd["id"]; ?>"><img src="./assets/img/793154226_phuong-ba-dinh.png" alt="" /></a>
        <h3>Phường Ba Đình</h3>
        <p>
          Nơi tập trung nhiều khách sạn 4–5 sao cao cấp, phục vụ cả khách du
          lịch và khách doanh nhân
        </p>
      </div>

      <div class="card">
       <a href="index.php?chuyen_trang=timKhachSan&id=<?php $rowDd = mysqli_fetch_assoc($resultDd); echo $rowDd["id"]; ?>">
          <img
            src="./assets/img/387849738_ban-sao-cua-126-xa-phuong---hanoionline.jpg"
            alt=""
          />
       </a>
        <h3>Phường Tây Hồ</h3>
        <p>
          Khoảng 286 khách sạn và căn hộ dịch vụ cao cấp, không gian thoáng đãng
          bên Hồ Tây
        </p>
      </div>

      <div class="card">
        <a href="index.php?chuyen_trang=timKhachSan&id=<?php $rowDd = mysqli_fetch_assoc($resultDd); echo $rowDd["id"]; ?>">
          <img
            src="./assets/img/188434224_ban-sao-cua-126-xa-phuong---hanoionline-4.png"
            alt=""
          />
        </a>
        <h3>Phường Cầu Giấy</h3>
        <p>
          Nằm ở phía Tây thành phố, khu vực này có nhiều khách sạn phục vụ đối
          tượng khách kinh doanh
        </p>
      </div>

      <div class="card">
        <a href="index.php?chuyen_trang=timKhachSan&id=<?php $rowDd = mysqli_fetch_assoc($resultDd); echo $rowDd["id"]; ?>"><img src="./assets/img/536982114_t-lim.png" alt="" /></a>
        <h3>Phường Từ Liêm</h3>
        <p>
          Nhiều khách sạn và khu căn hộ, đặc biệt các khách sạn cao cấp như JW
          Marriott Hotel Hanoi
        </p>
      </div>

      <div class="card">
        <a href="index.php?chuyen_trang=timKhachSan&id=<?php $rowDd = mysqli_fetch_assoc($resultDd); echo $rowDd["id"]; ?>"><img src="./assets/img/194637985_xa-dong-anh.png" alt="" /></a>
        <h3>Xã Đông Anh</h3>
        <p>
          Chủ yếu có các khách sạn cỡ nhỏ đến trung bình, phục vụ nhu cầu nghỉ
          ngơi ngắn hạn của khách đi máy bay
        </p>
      </div>
    </section>
    <?php include "./includes/footer.php";  ?>
    <script></script>
  </body>
</html>
