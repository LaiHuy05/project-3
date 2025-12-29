<?php
// kiểm tra dữ liệu trước khi vào trang
if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
     header("Location: ./auth/dangNhap.php");
     exit;
}


// Lấy từ khóa từ form
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

$sql = "SELECT ks.id, ks.ten_khach_san, ks.so_dien_thoai, ks.email, ks.mo_ta, dd.ten_dia_diem
        FROM khach_san ks
        JOIN dia_diem dd ON ks.dia_diem_id = dd.id
        WHERE ks.ten_khach_san LIKE ? OR dd.ten_dia_diem LIKE ?";

$stmt = $conn->prepare($sql);
$likeKeyword = "%" . $keyword . "%";
$stmt->bind_param("ss", $likeKeyword, $likeKeyword);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
      .container{
        padding:100px 0 150px;
      }
      h1 {
        color: #2c3e50;
        margin-bottom:30px;
        font-size: 32px;
        font-weight: 700;
      }
     
      .box {
        background-color: white;
        width: 100%;
        height: auto;
        margin: 25px 0px;
        display: flex;
        border-radius: 12px;
        padding: 15px 15px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
      }
      .box img {
        width: 250px;
        height: auto;
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
        margin: 2px 0px;
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
        transform: translateY(-3px)
      }
      .tinhtrang {
        padding: 15px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
      }
      span{
        font-weight:bold;
      }
      p.mess{
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
    } else {
        include "./includes/headerOut.php";
    }
  ?>
</header>
<div class="container">
  <div class="main__content">
    <h1>Khách sạn bạn muốn tìm</h1>
    <div class="box__list">
      <?php 
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              // lấy ảnh khách sạn
              $sqlImg = "SELECT * FROM anh_khach_san WHERE khach_san_id = '".$row['id']."' LIMIT 1";
              $resultImg = mysqli_query($conn , $sqlImg);
              $rowImg = null;
              if(mysqli_num_rows($resultImg) > 0){
                  $rowImg = mysqli_fetch_assoc($resultImg);
                  $rowImg["path"] = substr($rowImg["path"] , 1);
              }
              ?>
              <div class="box">
                <?php if($rowImg){ ?>
                  <img src="<?php echo $rowImg["path"]; ?>" alt="">
                <?php } else { ?>
                  <img src="no-image.jpg" alt="">
                <?php } ?>
                <div class="box1">
                  <div class="box10">
                    <div class="tinhtrang">
                      <li><b><?php echo $row["ten_khach_san"]; ?></b></li>
                    </div>
                    <p><span>Địa Điểm : </span><?php echo $row["ten_dia_diem"]; ?></p>
                    <p><span>Hotline : </span><?php echo $row["so_dien_thoai"]; ?></p>
                    <p><span>Email : </span><?php echo $row["email"]; ?></p>
                  </div>
                  <div class="box11">
                    <a class="nutbox11" href="index.php?chuyen_trang=khachSan&id=<?php echo $row["id"]; ?>">Xem chi tiết</a>
                  </div>
                </div>
              </div>
              <?php
          }
      } else {
          echo "<p class=mess>Không tìm thấy khách sạn nào.</p>";
      }
      ?>
    </div>
  </div>
</div>
<?php 
$stmt->close();
$conn->close();
include "./includes/footer.php";  
?>
</body>
</html>
