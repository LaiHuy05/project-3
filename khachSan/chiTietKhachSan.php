<?php  
      // kiểm tra điều kiện trước khi vào trang này -> tồn tại biến họ tên và vai trò trong session
      // biến vai trò phải là khách hàng -> nếu mắc 1 trong 2 điều kiện này quay lại trang đăng nhập
      if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
         header("Location: ./auth/dangNhap.php");
         exit;
      }
      $idNguoiDung = $_SESSION["idNguoiDung"];
      // kiểm tra biến id nằm trong get(đường dẫn) -> tồn tại chưa
      if(isset($_GET["id"])){
        // khởi tại biến chứa giá trị của biến id đó -> lấy dữ liệu khách sạn có id được gửi đến
        $idKs = $_GET["id"];
        $sqlKs = "select ks.* , dd.ten_dia_diem from khach_san ks join dia_diem dd on ks.dia_diem_id = dd.id where ks.id = '$idKs'";
        $resultKs = mysqli_query($conn , $sqlKs);
        if(mysqli_num_rows($resultKs) > 0){
          $rowKs = mysqli_fetch_assoc($resultKs);
        } 
      }
    if (isset($_POST["diemDanhGia"]) && isset($_POST["binhLuan"])) {
        $diemDanhGia = $_POST["diemDanhGia"];
        $binhLuan = $_POST["binhLuan"];
        

        $sqlDg = "INSERT INTO danh_gia (nguoi_dung_id, khach_san_id, diem_danh_gia, binh_luan) 
                  VALUES ('$idNguoiDung', '$idKs', '$diemDanhGia', '$binhLuan')";
        mysqli_query($conn, $sqlDg);  
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      body {
        margin-top: 100px;
        /* overflow:hidden; */
      }
      body.active{
        overflow:hidden;
      }
      .hero__img {
        padding: 30px 0;
        width: 100%;
        height: 640px;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 10px;
      }
      .hero__img__big {
        grid-row-start: 1;
        grid-row-end: 3;
        border-radius: 10px;
        overflow:hidden;
      }

      .hero__img__smalls {
        border-radius: 10px;
        overflow:hidden;
      }
      .hero__img__smalls img{
        width: 100%;
        height: 100%;
        object-fit:cover;
        transition:all 0.5s ease;
        cursor:pointer; 
      }
      .hero__img__smalls img:hover{
        transform:scale(1.1);
      }
      
      .hero__title h1 {
        font-size: 35px;
        font-weight: 700;
        margin-bottom: 10px;
      }
       span {
        margin-left:5px;
        margin-right: 15px;
        font-size: 15px;
        color: #666666;
      }
      .hero__title i{
        font-size: 15px;
        color: #666666;
      }
      .hero__content {
        margin: 30px 0;
        width: 100%;
        display:flex;
        justify-content:space-between;
      }
      .hero__content__about {
        width: 60%;
        padding: 20px 10px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
          rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 10px;
      }
       h2 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
      }
      .hero__content__about p {
        font-size: 17px;
        color: #666666;
        margin-bottom:10px;
        letter-spacing:0.2px;
      }
      .hero__content__service{
        width: 38%;
        padding: 20px 10px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
          rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 10px;
      }
      .hero__content__service i{
        font-size:15px;
        color:var(--primary-color);
        
      }
      .service__info{
        display:flex;
        flex-wrap:wrap;
        gap: 15px;
      }
      .book__form{
        margin-bottom:50px;
        padding:20px ;
         box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
          rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 10px;
      }
      .book__form input{
        border:1px solid #666666;
        outline:none;
        border-radius:5px;
        padding: 10px;
        background-color:#f4f4f4;
        margin-left:10px;
      }
      .book__form__box{
        display:inline-block;
        padding:10px;
        border:1px solid #666666;
        border-radius:5px;
      }
      .book__form label{
        font-size: 17px;
        color: #666666;
        margin-left:10px;
        
      }
      table{
        width: 100%;
        margin-top:10px;
        border-collapse:collapse;
      }
      td, th {
       border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
      
      }
      th{
        font-size:18px;
        color:white;
        background-color:var(--primary-color);
      }
      .book__form button,.box__rate button{
        padding: 10px 20px;
        background-color:var(--primary-color);
        color:white;
        font-size:15px;
        border-radius:5px;
        cursor:pointer;
        margin-top: 10px;
        transition:all 0.4s ease;
      }
      .book__form button:hover,.box__rate button:hover{
        transform:translateY(-3px);
        
      }
      select{
        padding: 5px;
        border-radius:5px;
      }
      select option{
        outline:none;
        border-radius:5px;
        padding: 5px;
        font-size: 15px;
        color: #333;
        background-color: #fff;
        border:0;
      }
      i.fa-users{
        color:var(--primary-color);
      }
      .box__rate{
        margin-bottom:50px;
        padding:20px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
          rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        border-radius: 10px;
      }
      .box__rate label{
        margin-bottom: 10px;
        font-size: 17px;
        color: #666666;
      }
      .box__rate h3{
        font-size: 20px;
        font-weight: 600;
        margin: 20px 0;
      }
      .rate__form__cmt{
        /* padding:10px; */
       display:flex;
       flex-direction:column;
      }
      textarea{
        font-size:16px;
        padding:5px;
        border-radius:10px;
        outline:none;
      }
     .rate__guest__list{
      display:flex;
      flex-wrap:wrap;
      gap: 20px;
     }
     .rate__guest__card{
        padding:10px 5px;
        width: 32%;
        border:1px dashed gray;
        border-radius:10px;
     }
     .user__rate{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:15px;
     }
     .user__rate p{
      padding:8px 3px;
      background-color: var(--primary-color);
      color:white;
      font-weight:700;
      border-top-left-radius:7px;
      border-bottom-right-radius:7px;
      border-top-right-radius:7px;
     }
     .user__rate h4{
      font-weight:600;
      font-size:17px;
     }
     .user__cmt p{
        color:#666666;
        font-size:15px;
        margin-left: 5px;
     }
     .user__info{
      display:flex;
      align-items:center;
      gap: 15px;
     }
     .avt{
        width: 30px;
        height:30px;

      }
      .avt img{
        margin-left: 5px;
        width: 100%;
        height: 100%;
        border-radius:50%;
      }
      .title__name{
        display:flex;
        justify-content:space-between;
        align-items:center;
      }
      .title__rate{
          padding:15px 5px;
          background-color: var(--primary-color);
          color:white;
          font-weight:700;
          border-top-left-radius:7px;
          border-bottom-right-radius:7px;
          border-top-right-radius:7px;
      }
      button.delete__cmt{
        margin-top:3px;
        padding: 5px 10px;
      }
      
      /* phần xem ảnh  */
      .showSlide{
        display:none;
        background-color:rgba(0, 0, 0, 0.8);
        width: 100vw;
        inset:0;
        position:fixed;
        z-index:100;
        opacity:0;
        
      }
      .showSlide.active{
         opacity:1;
         display:flex;
        justify-content:center;
        align-items:center;
      }
      .showSlide .showSlide__img{
        width:60%;
        height:80%;
        background:url("./assets/img/noel3.gif");
        background-repeat: no-repeat;  
        background-size:cover;
        background-position:center;
        border-radius:10px;
        transition:all 0.5s ease;
        
      }
      
      .showSlide .slide__main__icon {
        width: 46px;
        height: 46px;

        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;

        cursor: pointer;
        transition: 0.25s;
      }

      .showSlide button {
        width: 20px;
        height: 50px;
        font-size: 18px;
        border: 0;
        outline: none;
        background-color:rgba(255, 255, 255, 0.55);
        cursor: pointer;
        position: absolute;
        border-radius: 10px;
        display:flex;
        justify-content:center;
        align-items:center;
      }
      button:disabled {
        opacity: 0;
      }
      button.slide__main__next {
        right: 5px;
        top: 50%;
      }
      button.slide__main__prev {
        left: 5px;
        top: 50%;
      }
      button.slide__main__close{
        top: 20px;
        right:20px;
      }
    
    </style>
    <title>Document</title>
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
  <div class="showSlide">
     <div class="showSlide__img">
       
     </div>
     <button class="slide__main__prev">
       <i class="fa-solid fa-angle-left"></i>
     </button>
     <button class="slide__main__next">
       <i class="fa-solid fa-angle-right"></i>
     </button>
     <button class="slide__main__close">
      <i class="fa-solid fa-x"></i>
     </button>
  </div>
    <div class="container">
      <div class="main__content">
        <div class="hero__img">
          <?php 
            //lấy tất cả ảnh của khách sạn dựa trên id được gửi đến  
            $sqlImg = "select * from anh_khach_san where khach_san_id = '$idKs'";
            $resultImg = mysqli_query($conn , $sqlImg);
            if(mysqli_num_rows($resultImg) > 0){
              // lấy đường dẫn ảnh đầu tiên 
              $rowImg = mysqli_fetch_assoc($resultImg);
              // xóa bớt đường dẫn do đường dẫn lúc lưu và lúc lấy thừa 1 dấu chấm ở đầu
              $rowImg["path"] = substr($rowImg["path"] , 1);
            }
          ?>
          <div class="hero__img__smalls hero__img__big">
            <!-- gán đường dẫn vào ảnh to đầu -->
            <img src="<?php echo $rowImg["path"]; ?>" alt="">
          </div>


          <?php 
              // duyệt nốt 4 ảnh còn lại
              for($i= 0 ; $i < 4 ; $i++){
                $rowImg = mysqli_fetch_assoc($resultImg);

                // --- SỬA Ở ĐÂY: Thêm kiểm tra, nếu hết ảnh (null) thì dừng luôn ---
                if (!$rowImg) {
                    break;
                }
                // ------------------------------------------------------------------

                $rowImg["path"] = substr($rowImg["path"] , 1);
          ?>
            <div class="hero__img__smalls">
              <img src="<?php echo $rowImg["path"]; ?>" alt="">
            </div>
          <?php } ?>
        </div>



        <div class="hero__title">
          <div class="title__name">
            <h1><?php echo $rowKs["ten_khach_san"]; ?></h1>
            <?php 
            $kiemTra = false;
            $sqlKt ="select khach_san_id from danh_gia where 1";
            $resultKt = mysqli_query($conn , $sqlKt);
            while($rowKt = mysqli_fetch_assoc($resultKt)){
              if($rowKt["khach_san_id"] === $idKs){
                $kiemTra = true;
                break;
              } else{
                $kiemTra = false;
              } 
              
            }
             if($kiemTra === true){
                 $sqlTb = "SELECT khach_san_id, AVG(diem_danh_gia) AS diem_trung_binh
                          FROM danh_gia
                          WHERE khach_san_id = '$idKs'
                          GROUP BY khach_san_id";
                $resultTb = mysqli_query($conn , $sqlTb);
                $rowTb = mysqli_fetch_assoc($resultTb);
                $rowTb["diem_trung_binh"] = substr($rowTb["diem_trung_binh"] ,0,3);
                echo "<p class=title__rate>". $rowTb["diem_trung_binh"]."</p>";
            
             }else{
                echo "<p class=title__rate>0.0</p>";
             }
              
              ?> 
            
          </div>

          <i class="fa-solid fa-location-dot"></i>
          <span><?php echo $rowKs["ten_dia_diem"]; ?> , Hà Nội</span>
          <i class="fa-solid fa-envelope"></i>
          <span><?php echo $rowKs["email"]; ?></span>
          <i class="fa-solid fa-phone-volume"></i>
          <span><?php echo $rowKs["so_dien_thoai"]; ?></span>
        </div>
        <div class="hero__content">
          <div class="hero__content__about">
            <h2>Thông tin của khách sạn</h2>
            <p><?php echo $rowKs["mo_ta"]; ?></p>
          </div>
          <div class="hero__content__service">
            <h2>Dịch vụ của khách sạn</h2>
           <div class="service__info">
              <div class="service__info__card">
                <i class="fa-solid fa-wifi"></i>
                <span>Miễn phí wi-fi</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-bell-concierge"></i>
                <span>Nhà hàng</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-signal"></i>
                <span>Mạng 6G</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-square-parking"></i>
                <span>Hỗ trợ đỗ xe</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-dumbbell"></i>
                <span>Phòng gym</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-wine-glass"></i>
                <span>Quầy bar</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-spa"></i>
                <span>Spa - mát xa</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-person-swimming"></i>
                <span>Bể bơi</span>
              </div>
              <div class="service__info__card">
                <i class="fa-solid fa-ban-smoking"></i>
                <span>Khu vực hút thuốc</span>
              </div>
           </div>
          </div>
        </div>
        <div class="book__form">
          <h2>Phòng trống</h2>
            <!-- khởi tạo form gửi dữ liệu kiểu post đến trang thêm đơn -->
            <form action="index.php?chuyen_trang=themDon" method="post">
              <div class="book__form__box">
                  <!-- dữ liệu ngày nhận ngày trả -->
                  <label for="ngayNhan">Ngày nhận</label>
                  <input type="date" name="ngayNhan" id="ngayNhan" required>
                  <label for="ngayTra">Ngày trả</label>
                  <input type="date" name="ngayTra" id="ngayTra" required>
                  <input type="hidden" name="khachSanId" value="<?php echo $idKs; ?>">
              </div>
              <table>
                <tr>
                  <th>Chọn</th>
                  <th>Số phòng</th>
                  <th>Loại phòng</th>
                  <th>Giá phòng</th>
                  <th>Sức chứa</th>
                  <th>Số lượng</th>
                </tr>

                  <?php 
                  // khởi tạo bảng lấy dữ liệu của tất cả các phòng trạng thái trống của khách sạn này
                    $sql = "select p.* from  phong p
                     where trang_thai = 'trong' and p.khach_san_id = '$idKs'";
                    $result = mysqli_query($conn , $sql);
                    if(mysqli_num_rows($result) > 0){
                      while($row= mysqli_fetch_assoc($result)){
                  ?>
                <tr>
                  <!-- khởi tạo 1 ô input kiểu checkbox cho mỗi phòng -> giúp người dùng có thể đặt nhiều phòng trong 1 đơn
                  đặt name idPhong[] ->biến này được hiểu lưu được nhiều giá trị -> khi gửi các giá trị biến post sẽ lưu các giá trị này dưới dạng mảng-->
                  <td><input type="checkbox" name="idPhong[]" id="" value="<?php echo $row["id"]; ?>" ></td>
                  <td><?php echo $row["so_phong"]; ?></td>
                  <td><?php echo $row["loai_phong"]; ?></td>
                  <td><?php echo $row["gia_phong"]; ?></td>
                  <td>
                    <?php 
                        $sqlSc = "select * from suc_chua_phong where phong_id = '$row[id]'";
                        $resultSc = mysqli_query($conn , $sqlSc);
                        if(mysqli_num_rows($resultSc) > 0){
                          while($rowSc = mysqli_fetch_assoc($resultSc)){
                          
                     ?>
                     <i class="fa-solid fa-users"></i><?php echo " ".$rowSc["so_luong"] ." ".$rowSc["loai_khach"]." ";  ?>
                     <?php }
                        }  ?>
                  </td>
                  <td>1</td>
                </tr>
                <?php   
                     }
                    } 
                ?>

              </table>
              <!-- form được gửi đi bao gồm dữ liệu của các phòng bạn đặt và ngày nhận , ngày trả phòng  -->
               <button type="submit">Đặt phòng</button>
            </form>
          </div>
         <div class="box__rate">
          <h2>Đánh giá</h2>
          <?php 
            $sqlDdp = "select nguoi_dung_id from don_dat_phong where khach_san_id = '$idKs'";
              $resultDdp = mysqli_query($conn , $sqlDdp);
              $kiemTraDdp = false;
              if(mysqli_num_rows($resultDdp) > 0){
                while($rowDdp = mysqli_fetch_assoc($resultDdp)){
                    if($rowDdp["nguoi_dung_id"] === $idNguoiDung){
                      $kiemTraDdp = true;
                      break;
                    }
                }
                if($kiemTraDdp){
          ?>
              <form action="" method="post">
                <div class="rate__form">
                  <label for="diemDanhGia">Điểm đánh giá</label>
                  <select name="diemDanhGia" id="">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5" selected>5</option>
                  </select>
                </div>
                <div class="rate__form__cmt">
                  <label for="binhLuan">Bình luận</label>
                  <textarea name="binhLuan" id="" required></textarea>
                </div>
                <button type="submit">Thêm đánh giá</button>
              </form>
          <?php }else{
             echo "<p style=color:red>Hãy đặt phòng để thêm đánh giá ngay nào ò_Ó</p>";
          }
          }else{
            echo "<p style=color:red>Hãy đặt phòng để thêm đánh giá ngay nào ò_Ó</p>";
          } ?>
          <h3>Các đánh giá khác</h3>
          <div class="rate__guest__list">
            <?php 
              
              $sqlBl = "select dg.* , nd.ho_ten , nd.anh_dai_dien from danh_gia dg 
              join nguoi_dung nd on dg.nguoi_dung_id = nd.id where dg.khach_san_id = '$idKs'
              order by dg.id desc";
              $resultBl = mysqli_query($conn , $sqlBl);
              if(mysqli_num_rows($resultBl) > 0){
                while($rowBl = mysqli_fetch_assoc($resultBl)){

                
            ?>
            <div class="rate__guest__card">
                <div class="user__rate">
                  <div class="user__info">
                    <div class="avt"><img src="<?php echo $rowBl["anh_dai_dien"]; ?>" alt=""></div>
                    <h4><?php echo $rowBl["ho_ten"]; ?></h4>
                  </div>
                  <p><?php echo $rowBl["diem_danh_gia"].".0"; ?></p>
                </div>
                <div class="user__cmt">
                  <p><?php echo "`". $rowBl["binh_luan"]."`"; ?></p>
                </div>
                
            </div>
            <?php }
              } ?>
          </div>

         </div>
      </div>
    </div>
    <?php include "./includes/footer.php";  ?>
    <script>
      // input kiểu date chọn thời gian đặt phòng tính từ thời điểm hiện tại

      // khởi tạo biến gán bằng ngày tháng năm hiện tại thông qua 3 hàm new Date() ->lấy thời gian hiện tại
      // toISOString()-> chuyển đối tượng Date đã được khởi tạo trước đó thành chuẩn ISO , split("T")[0] -> chia chuỗi làm 2 phần lấy ngày tháng năm
      const homNay = new Date().toISOString().split("T")[0];
      // lấy input id ngày nhận -> thêm thuộc tính min -> giá trị là ngày hôm này vừa được khởi tạo
      document.getElementById("ngayNhan").setAttribute("min", homNay);
      // thêm sự kiện cho input id ngày nhận change -> khi giá trị trong input này được thay đổi
      document.getElementById("ngayNhan").addEventListener("change", function() {
          // giá trị đó sẽ được gán giá trị của thuộc tính min của input id ngày trả
           document.getElementById("ngayTra").setAttribute("min", this.value);
      });
     
     //slide ảnh 
     const imgList = document.querySelectorAll(".hero__img__smalls img");
     const showSlide = document.querySelector(".showSlide");
     const showSlideImg = document.querySelector(".showSlide__img");
     const slideNext = document.querySelector(".slide__main__next");
     const slidePrev = document.querySelector(".slide__main__prev");
     const slideClose = document.querySelector(".slide__main__close");
     let currentIndex = 0;

    function hienThi(index){
      showSlideImg.style.background = `url(${imgList[index].src})`;
      currentIndex = index;

      if(currentIndex === 0){
        slidePrev.disabled = true;
      }else{
        slidePrev.disabled = false;
      }

      if(currentIndex === imgList.length - 1){
        slideNext.disabled = true;
      }else{
        slideNext.disabled = false;
      }
    }
  
    slideNext.addEventListener("click" , function(){
      currentIndex++;
      hienThi(currentIndex);
    });
    slidePrev.addEventListener("click" , function(){
      currentIndex--;
      hienThi(currentIndex);
    });
    slideClose.addEventListener("click" , function(){
      showSlide.classList.remove("active");
      document.body.classList.remove("active");
    })

     for(let index = 0 ; index < imgList.length ; index++){
      imgList[index].addEventListener("click" , function(){
       showSlide.classList.add("active");
       document.body.classList.add("active");
       hienThi(index);
      })
     }
     

     
    </script>
  </body>
</html>
