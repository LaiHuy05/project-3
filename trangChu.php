<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      /* phần slide */
      .slide__main {
        position: relative;
        margin-top: 150px;
        width: 100%;
        height: 400px;
        background: url( "./uploads/1765362847_ht2_1.webp");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 10px;
        transition: all 0.5s ease;
      }
      .slide__main__hero {
        position: absolute;
        bottom: 40px;
        left: 40px;

        display: flex;
        align-items: center; 

        gap: 16px; 

        background: rgba(0, 0, 0, 0.35);
        padding: 16px 22px;
        border-radius: 12px;
        backdrop-filter: blur(4px);
        color: white;

        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        transition: all 0.5s ease;
      }

      /* TITLE */
      .slide__main__text h1 {
        margin: 0;
        font-size: 36px;
        font-weight: 700;
        
      }

      .slide__main__text h2 {
        margin: 4px 0 0;
        font-size: 20px;
        font-weight: 300;
        
      }

      /* ICON BUTTON */
      .slide__main__icon {
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

      .slide__main__icon:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: scale(1.12);
      }
      .slide__main button {
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
      .slide__main button:disabled {
        cursor: not-allowed;
        opacity: 0.5;
      }
      button.slide__main__next {
        right: 5px;
        top: 50%;
      }
      button.slide__main__prev {
        left: 5px;
        top: 50%;
      }

      /* phần hotels */

      .hotels {
        padding: 100px 0;
      }
      .hotels__content {
        position: relative;
      }
      .hotels h2 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
      }
      .hotels__list {
        display: flex;
        /* gap: 40px; */
        width: 100%;
        flex-wrap: wrap;
        justify-content: space-between;
      }
      .hotels__card {
        padding: 18px;
        /* background-color:  #f5f5f5;;  */
        position: relative;
        max-height: 380px;
        width: 24%;
        z-index: 1;
        margin-bottom: 30px;
        border-radius: 12px;
        box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;
        transition: all 0.4s ease;
        overflow: hidden;
      }

      .hotels__card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
      }

      .hotels__card:hover {
        background-color:#2c2c2c;
        transform: translateY(-6px) scale(1.02);
      }
      .hotels__card:hover h3{
        color:white;
      }

      .hotels__card h3 {
        color: black;
        font-size: 16px;
        font-weight: 600;
        margin-top: 12px;
      }

      .hotels__card p {
        color: gray;
        font-size: 14px;
        margin-top: 6px;
        line-height: 1.4;
      }

      .hotels button {
        position: absolute;
        color: var(--primary-color);
        background: #f5f4fa;
        cursor: pointer;
        right: 0;
      }
      .hotels.active .hotels__all{
        opacity:1;
        font-size:13px;
        position: absolute;
        color: var(--primary-color);
        background: #f5f4fa;
        right: 0;
      }
      .hotels.active .hotels__all:hover{
        text-decoration: underline;
      }
      .hotels .hotels__all{
        opacity:0;
      }
      .hotels.active button.hotels__less {
        right: 95%;
        left: 0;
      }
      .hotels.active button.hotels__more{
        right:50%;
        opacity:0;
      }
     
      .hotels button:hover {
        text-decoration: underline;
      }
      /* phần services */
      .services {
        padding: 50px 0 150px;
      }
      .services__main {
        padding: 60px 10px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        border-radius: 10px;
      }
      .services__box {
        width: 30%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      .services__box i {
        font-size: 28px;
      }
      .services__box h3 {
        font-size: 18px;
        margin: 20px 0;
        font-weight: bold;
      }
      .services__box p {
        font-size: 16px;
        text-align: center;
        color: gray;
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
    <div class="slide">
      <div class="main__content">
        <div class="slide__main">
          <div class="slide__main__hero">
            <div class="slide__main__text">
              <h1>Khách sạn THE LEGEND</h1>
              <h2>Hoàn Kiếm , Hà Nội</h2>
            </div>
            <!-- <a href="index.php?chuyen_trang=khachSan&id=1" class="slide__main__icon">
              <i class="fa-regular fa-bookmark"></i>
            </a> -->
          </div>
          <button class="slide__main__prev">
            <i class="fa-solid fa-angle-left"></i>
          </button>
          <button class="slide__main__next">
            <i class="fa-solid fa-angle-right"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="hotels">
      <div class="main__content">
        <div class="hotels__content">
          <h2>Chỗ ở nổi bật</h2>
          <div class="hotels__list">
            <?php 
                $sqlKs = "select ks.* , dd.ten_dia_diem from khach_san ks join dia_diem dd on ks.dia_diem_id = dd.id";
                $resultKs = mysqli_query($conn , $sqlKs);
                $totalKs = mysqli_num_rows($resultKs);
                for($i = 0 ; $i < 4 ;$i++  ){
                  $rowKs = mysqli_fetch_assoc($resultKs);
                    
            ?>
            <div class="hotels__card">
                <?php 
                  $sqlImg = "select * from anh_khach_san where khach_san_id = '$rowKs[id]' ";
                  $resultImg = mysqli_query($conn , $sqlImg);
                  if(mysqli_num_rows($resultImg) > 0){
                      $rowImg = mysqli_fetch_assoc($resultImg); 
                      // cắt chuỗi do đường dẫn của path nằm khác cấp file nên khi index.php của khách hàng truy cập -> sẽ phải bỏ bớt đường dẫn
                      $rowImg["path"] = substr($rowImg["path"] , 1);
                  }
                  
                ?>
              <a
                class="hotels__card__img"
                href="index.php?chuyen_trang=khachSan&id=<?php echo $rowKs["id"]; ?>"
                ><img src="<?php echo $rowImg["path"]; ?>" alt=""/>
              </a>
              <h3 class="hotels__card__name"><?php echo $rowKs["ten_khach_san"]; ?></h3>
              <p class="hotels__card__location"><?php echo $rowKs["ten_dia_diem"]; ?> , Hà Nội</p>
              
            </div>
            <?php } ?>
           
          </div>
          <button class="hotels__less">Ẩn bớt</button>
          <button class="hotels__more">Xem thêm</button>
          <a class="hotels__all" href="index.php?chuyen_trang=danhSachKhachSan">Xem tất cả</a>
        </div>
      </div>
    </div>
    <div class="services">
      <div class="main__content">
        <div class="services__main">
          <div class="services__box">
            <i class="fa-solid fa-check-to-slot"></i>
            <h3>Đảm bảo đánh giá tốt nhất</h3>
            <p>
              Tìm được giá thấp hơn và chúng tôi sẽ khớp giá. Không cần hỏi.
            </p>
          </div>
          <div class="services__box">
            <i class="fa-solid fa-microphone"></i>
            <h3>Hỗ trợ khách hàng 24/7</h3>
            <p>
              Đội ngũ của chúng tôi luôn sẵn sàng giúp đỡ bạn suốt ngày đêm, bất
              cứ khi nào bạn cần.
            </p>
          </div>
          <div class="services__box">
            <i class="fa-solid fa-calendar-check"></i>
            <h3>Miễn phí hủy phòng</h3>
            <p>
              Linh hoạt với các tùy chọn hủy miễn phí trên hầu hết các phòng.
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php include "./includes/footer.php";  ?>
    <script>
      // phần trượt slide
      const slideBox = document.querySelector(".slide__main");
      // khởi tạo 2 biến là 2 nút bấm next và prev
      const slideNext = document.querySelector(".slide__main__next");
      const slidePrev = document.querySelector(".slide__main__prev");
      const linkSlide = document.querySelector(".slide__main__icon");
      const textMain = document.querySelector(".slide__main h1");
      const textBot = document.querySelector(".slide__main h2");

      // khởi tạo mảng chứa danh sách các đường dẫn ảnh để khi sự kiện click diễn ra thay đổi theo giá trị index của các phần tử trong mảng
      let listSlide = [
        {
          name : "merry christmas",
          location: "",        
          img:"./assets/img/noel2.gif"
        },
       
        <?php 
        $sqlKs2 = "select ks.* , dd.ten_dia_diem from khach_san ks join dia_diem dd on ks.dia_diem_id = dd.id";
        $resultKs2 = mysqli_query($conn , $sqlKs2);
        
        if(mysqli_num_rows($resultKs2) > 0 ){
            while($rowKs2 = mysqli_fetch_assoc($resultKs2)){

        ?>
        {
          name: "<?php echo $rowKs2["ten_khach_san"];?>",
          location: "<?php echo $rowKs2["ten_dia_diem"];?>",
          
          img: "<?php 
              $sqlImg2 = "select * from anh_khach_san where khach_san_id = '$rowKs2[id]' ";
              $resultImg2 = mysqli_query($conn , $sqlImg2);
              if(mysqli_num_rows($resultImg2) > 0){
                $rowImg2 = mysqli_fetch_assoc($resultImg2); 
                $rowImg2 = mysqli_fetch_assoc($resultImg2); 
                
                $rowImg2["path"] = substr($rowImg2["path"] , 1);
                echo $rowImg2["path"];
              }
              
          ?>",
        },
        <?php   
          }
        } 
        ?>
      ];

      // khởi tạo phần tử index ban đầu
      let currentIndex = 0;

      // hàm hiển thị ảnh theo vị trí index được cung cấp thông qua 2 sự kiện của 2 nút bấm
      function showSlide(index) {
        // thay đổi style của khối slideBox -> thuộc tính ảnh nền
        slideBox.style.backgroundImage = `url(${listSlide[index].img})`;
        textMain.innerText = listSlide[index].name;
        textBot.innerText = listSlide[index].location;

        // Kiểm tra disable nút
        // trạng thái disabled của nút prev = true -> khi giá trị tham số index truyền vào = 0
        slidePrev.disabled = index === 0;
        // trạng thái disabled của nút next = true -> giá trị tham số index truyền vào = kích thước của mảng - 1
        slideNext.disabled = index === listSlide.length - 1;
      }

      // Gán sự kiện click nút next
      slideNext.addEventListener("click", () => {
        // khi click vào nút next sự kiện diễn ra
        // kiểm tra giá trị hiện tại của biến currentIndex phải nhỏ hơn kích thước của mảng - 1
        if (currentIndex < listSlide.length - 1) {
          // tăng biến current index lên 1
          currentIndex++;
          // gọi đến hàm hiển thị ảnh với giá trị current index mới được truyền vào
          showSlide(currentIndex);
        }
      });
      // gán sự kiện click nút prev
      slidePrev.addEventListener("click", () => {
        if (currentIndex > 0) {
          // giảm biến currenIndex đi 1
          currentIndex--;
          // gọi đến hàm hiển thị ảnh với giá trị currentIndex mới được truyền vào
          showSlide(currentIndex);
        }
      });

     
      showSlide(currentIndex);


      // phần xem thêm và ẩn bớt
      const xemThem = document.querySelector(".hotels__more");
      const anBot = document.querySelector(".hotels__less");
      const quanLyKhachSan = document.querySelector(".hotels__list");
      const khachSan = document.querySelector(".hotels");
      
      let listHotels = [
        <?php 
        $sqlKs3 = "select ks.* , dd.ten_dia_diem from khach_san ks join dia_diem dd on ks.dia_diem_id = dd.id";
        $resultKs3 = mysqli_query($conn , $sqlKs3);
        $totalKs3 = mysqli_num_rows($resultKs3);
           for($index = 0 ; $index < 4 ;$index++  ){
              $rowKs3 = mysqli_fetch_assoc($resultKs3);
        ?>
        {
          nameHotel: "<?php echo $rowKs3["ten_khach_san"]; ?>",
          hrefHotel:"index.php?chuyen_trang=khachSan&id=<?php echo $rowKs3["id"]; ?>",
          imgHotel: "<?php 
              $sqlImg3 = "select * from anh_khach_san where khach_san_id = '$rowKs3[id]' ";
              $resultImg3 = mysqli_query($conn , $sqlImg3);
              if(mysqli_num_rows($resultImg3) > 0){
                $rowImg3 = mysqli_fetch_assoc($resultImg3); 
                $rowImg3["path"] = substr($rowImg3["path"] , 1);
                echo $rowImg3["path"];
              }
              
          ?>",
          locationHotel: "<?php echo $rowKs3["ten_dia_diem"]; ?> , Hà Nội",
          
        },
        <?php } ?>
      ];

      function hienThiKhachSan() {
        quanLyKhachSan.innerHTML = "";
        for (let index = 0; index < listHotels.length; index++) {
          quanLyKhachSan.innerHTML += `<div class="hotels__card">
                <a class="hotels__card__img" href="${listHotels[index].hrefHotel}"
                  ><img src=${listHotels[index].imgHotel} alt=""
                /></a>
                <h3 class="hotels__card__name">${listHotels[index].nameHotel}</h3>
                <p class="hotels__card__location">${listHotels[index].locationHotel}</p>
              </div>`;
        }
      }
      function themKhachSan() {
        listHotels.push(
          <?php 
            for($index = 0 ; $index < 4 ;$index++  ){
              $rowKs3 = mysqli_fetch_assoc($resultKs3);
          ?>
          {
            nameHotel: "<?php echo $rowKs3["ten_khach_san"]; ?>",
            hrefHotel:"index.php?chuyen_trang=khachSan&id=<?php echo $rowKs3["id"]; ?>",
            imgHotel: "<?php 
                $rowImg3 = mysqli_fetch_assoc($resultImg3); 
                $rowImg3["path"] = substr($rowImg3["path"] , 1);
                echo $rowImg3["path"];
          ?>",
            locationHotel: "<?php echo $rowKs3["ten_dia_diem"]; ?> , Hà Nội",
          },
          <?php } ?>
        );
        hienThiKhachSan();
      }

      function xoaKhachSan() {
        listHotels.splice(4, listHotels.length - 1);
        hienThiKhachSan();
      }

      xemThem.addEventListener("click", function () {
        themKhachSan();
        khachSan.classList.add("active");
      });
      anBot.addEventListener("click", function () {
        xoaKhachSan();
        khachSan.classList.remove("active");
      });
      
    </script>
  </body>
</html>
