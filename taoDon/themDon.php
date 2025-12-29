 <?php
    // kiểm tra dữ liệu trước khi vào trang
    if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
         header("Location: ./auth/dangNhap.php");
         exit;
      }
    // kiểm tra 3 biến lưu được gửi thông qua post
    if(isset($_POST["ngayNhan"] , $_POST["ngayTra"] , $_POST["idPhong"] , $_POST["khachSanId"])){
        // lưu giá trị các biến post đó vào biến được khởi tạo
        $ngayNhan = $_POST["ngayNhan"];
        $ngayTra = $_POST["ngayTra"];
        $khachSanId = $_POST["khachSanId"];
        // cắt chuỗi 2 biến này để lấy chính xác ngày 
        $dayN = substr($ngayNhan, 8, 2);
        $dayT = substr($ngayTra, 8, 2);
        $monthN = substr($ngayNhan ,5  , 2);
        $monthT = substr($ngayTra ,5  , 2);
        $yearN = substr($ngayNhan , 0 , 4);
        $yearT = substr($ngayTra , 0 , 4);
        //lấy id người dùng được lưu qua session lúc đăng nhập
        $idNguoiDung = $_SESSION["idNguoiDung"];
        // biến trạng thái tạo đơn mặc định chờ xác nhận
        $trangThai = "cho xac nhan";
        // thêm 1 đơn đặt phòng mới
        $sql = "insert into don_dat_phong (nguoi_dung_id , ngay_nhan , ngay_tra , trang_thai , khach_san_id) values 
        ('$idNguoiDung' , '$ngayNhan' , '$ngayTra' ,'$trangThai' , '$khachSanId')";
        mysqli_query($conn , $sql);
        // hàm mysqli_insert_id() lấy lại giá trị của id vừa mới thêm trong trường hợp trong database bảng có cột có thuộc tính auto_increment
        $donDatPhongId = mysqli_insert_id($conn);
    }
    // khởi tạo biến tổng tiền -> lưu giá trị chi phí phát sinh
    $tongTien = 0;
    // duyệt biến $_POST["idPhong"] -> giá trị được lưu dưới dạng mảng -> duyệt qua từng giá trị là từng id của phòng đã đặt
    // mỗi phòng được duyệt thêm vào chi tiết đặt phòng -> của đơn đặt phòng vừa được thêm vào database 
    foreach($_POST["idPhong"] as $idPhong){
       $sql2 = "select gia_phong from phong where id = '$idPhong'";
       $result2 = mysqli_query($conn , $sql2);
       $row = mysqli_fetch_assoc($result2);

       $giaPhong = $row["gia_phong"];
       $soLuong =  1;

       $sql3 = "insert into chi_tiet_dat_phong (don_dat_phong_id , phong_id , gia_phong , so_luong) values
        ('$donDatPhongId' , '$idPhong' , '$giaPhong' , '$soLuong')";
       $result3 = mysqli_query($conn , $sql3);

      //  biến tổng tiền cộng thêm giá trị của từng phòng bao gồm giá phòng * số lượng
       $tongTien += $giaPhong * $soLuong;

       $sqlImg = "select aks.path from phong p 
          join khach_san ks on p.khach_san_id = ks.id 
          join anh_khach_san aks on ks.id = aks.khach_san_id
          where p.id = '$idPhong'";
          $resultImg = mysqli_query($conn , $sqlImg);
          if(mysqli_num_rows($resultImg) > 0){
            $rowImg = mysqli_fetch_assoc($resultImg);
            $rowImg["path"] = substr($rowImg["path"] , 1);
          }
    }
    
   
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
      body {
        margin-top: 100px;
      }
      .container{
        padding:30px 0 100px;
      }
      h1{
        position:relative;
        font-size:30px;
        font-weight:800;
        background:var(--primary-color);
        text-align:center;
        color:white;
        padding :10px;
        border-radius:5px;
        margin-bottom: 30px;
        overflow:hidden;
      }
      
      
      h5{
        text-align:center;
        color:red;
        font-weight:500;
        padding: 10px;
         box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
      }
      .pay{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap: 10px;
      }
      .pay__img img{
        width: 100%;
        border-radius:5px;
      }
      table{
        width: 100%;
        margin-bottom: 40px;
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
        background-color:#666666;
      }
      form{
        margin-top:10px;
        padding:20px;
        width: 100%;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;

      }
     .form__input{
        display:flex;
        flex-direction:column;  
      }
      label{
       margin: 10px 0;
      }
      input , select , textarea , button {
       outline:none;
       border-radius:5px;
       border:1px solid #666666;
        padding: 10px;
        margin-top: 5px;
      }
      button.payMent{
        position:relative;
        overflow:hidden;
        border:0;
        background-color:#666666;
        color:white;
        cursor:pointer;
        
      }
      span.span__payMent{
        position:relative;
        z-index: 1;
      }
      button.payMent::after{
        content:"";
        display:block;
        height: 100%;
        width: 0;
        position:absolute;
        top: 0;
        left: 0;
        bottom: 0;
        transition:all 0.6s ease;
        
      }
       button.payMent:hover::after {
        width: 100%;
        background-color:red;
      }
      select option {
        padding: 10px;
        font-size: 15px;
        color: #333;
        background-color: #fff;
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
      <h1>Thanh toán</h1>
       <div class="pay">
          <div class="pay__img">
            <img src="<?php echo $rowImg["path"]; ?>" alt="">
          </div>
          <div class="pay__content">
            <table>
              <tr>
                <th>Ngày nhận - ngày trả</th>
                <th>Số phòng</th>
                <th>Loại phòng</th>
                <th>Giá phòng</th>
                <th>Số lượng</th>
              </tr>
              <?php 
                  // lấy dữ liệu chi tiết dặt phòng vừa được thêm vào thông qua đơn đặt phòng id
                  $sql4 = "select  ctdp.so_luong , p.so_phong ,p.loai_phong , p.gia_phong from chi_tiet_dat_phong ctdp 
                  join phong p on ctdp.phong_id = p.id where ctdp.don_dat_phong_id = '$donDatPhongId'";
                  $result4 = mysqli_query($conn , $sql4);
                  if(mysqli_num_rows($result4) > 0){
                    while($row4 = mysqli_fetch_assoc($result4)){
    
              ?>
              <tr>
                <td><?php echo "ngày ".$dayN."/".$monthN." đến ".$dayT."/".$monthT." năm ".$yearT ?></td>
                <td><?php echo $row4["so_phong"]; ?></td>
                <td><?php echo $row4["loai_phong"]; ?></td>
                <td><?php echo $row4["gia_phong"]; ?></td>
                <td><?php echo $row4["so_luong"]; ?></td>
              </tr>
              <?php  }
                  }
              ?>
            </table>
            <?php 
             // biến này lưu giá trị của ngày trả - ngày nhận -> số ngày khách ở  
             $dayAll = $dayT - $dayN;
             // tổng tiền nhân thêm số ngày đó vào
             $tongTien *= $dayAll;
             $tienHienThi = number_format($tongTien , 0 , ',' , '.');
             echo "<h5>Tổng tiền : ".$tienHienThi." VND</h5>"; 
             
            ?>
            <!-- khởi tạo form gửi đến trang thanh toán -->
            <form action="index.php?chuyen_trang=thanhToan" method="post">
                <!--3 ô input kiểu hidden -> ẩn nhưng giá trị vẫn được gửi đi -> id của đơn đặt phòng này và tổng tiền cần thanh toán  -->
                <input type="hidden" name="donDatPhongId" value="<?php echo $donDatPhongId; ?>">
                <input type="hidden" name="tongTien" value="<?php echo $tongTien;?>">
                <input type="hidden" name="trangThai" value="da thanh toan">
                <label for="phuongThuc">Phương thức thanh toán</label>
                <select name="phuongThuc" id="">
                  <option value="the">Thẻ</option>
                  <option value="chuyen khoan">Chuyển khoản</option>
                  <option value="tien mat">Tiền mặt</option>
                  <option value="vi dien tu">Ví điện tử</option>
                </select>
                <button class="payMent" type="submit"><span class="span__payMent">Thanh toán</span></button>
              </form>
          </div>
        </div>
     </div>
    </div>
    <?php include "./includes/footer.php";  ?>
  </body>
</html>