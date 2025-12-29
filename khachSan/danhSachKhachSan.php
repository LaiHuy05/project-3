<?php 
    // kiểm tra dữ liệu trước khi vào trang
    if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
         header("Location: ./auth/dangNhap.php");
         exit;
    }


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
      .box__list{
        width: 100%;
        display:flex;
        flex-wrap:wrap;
        justify-content:space-between;
      }
      .box {
        background-color: white;
        width: 48%;
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
        width: 150px;
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
            <h1>Danh sách khách sạn</h1>
            <div class="box__list">
                <?php
                    $sqlKs = "select ks.* , dd.ten_dia_diem from khach_san ks 
                    join dia_diem dd on ks.dia_diem_id = dd.id where 1";
                    $resultKs = mysqli_query($conn , $sqlKs);
                    if(mysqli_num_rows($resultKs) > 0){
                        while($rowKs = mysqli_fetch_assoc($resultKs)){

                    
                ?>
            
                    <div class="box">
                        <?php 
                            $sqlImg = "select * from anh_khach_san where khach_san_id = '$rowKs[id]'";
                            $resultImg = mysqli_query($conn , $sqlImg);
                            if(mysqli_num_rows($resultImg) > 0){
                                $rowImg = mysqli_fetch_assoc($resultImg);
                                $rowImg["path"] = substr($rowImg["path"] , 1);
                            }
                        ?>
                    <img src="<?php echo $rowImg["path"]; ?>" alt="" />
                        <div class="box1">
                            <div class="box10">
                                <div class="tinhtrang">
                                    <li><b><?php echo $rowKs["ten_khach_san"]; ?></b></li>
                                </div>
                                <p><span>Địa Điểm : </span><?php echo $rowKs["ten_dia_diem"]; ?> , Hà Nội</p>
                                <p><span>Hotline : </span><?php echo $rowKs["so_dien_thoai"]; ?></p>
                            </div>
                            <div class="box11">
                                <a class="nutbox11" href="index.php?chuyen_trang=khachSan&id=<?php echo $rowKs["id"]; ?>">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <?php   }
                        } ?>
            </div>
        </div>
    </div>
    <?php include "./includes/footer.php";  ?>
</body>
</html>