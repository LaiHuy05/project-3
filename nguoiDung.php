  <?php
        if(!isset($_SESSION["hoTen"] , $_SESSION["vaiTro"]) || $_SESSION["vaiTro"] != "khach hang"){
          header("Location: ./auth/dangNhap.php");
          exit;
         }
         if(isset($_GET["id"])){
           $id = $_GET["id"];
         }
        if (!empty($_POST['ho_ten']) &&
              !empty($_POST['gioi_tinh']) &&
              !empty($_POST['email']) &&
              !empty($_POST['so_dien_thoai']) &&
              !empty($_POST['dia_chi']) 
             ) {
              $hoTen = $_POST['ho_ten'];
              $phone = $_POST['so_dien_thoai'];
              $diaChi = $_POST['dia_chi'];
              $gioiTinh = $_POST['gioi_tinh'];
              $email = $_POST['email'];
              $sqlUpdate = "
              UPDATE nguoi_dung SET
                  ho_ten = '$hoTen',
                  so_dien_thoai = '$phone',
                  dia_chi = '$diaChi',
                  gioi_tinh = '$gioiTinh',
                  email = '$email'
              WHERE id = '$id'
              ";
              mysqli_query($conn, $sqlUpdate);
              // header("Location: index.php?chuyen_trang=nguoiDung&id=$id");
            }
    
  ?>
  <!DOCTYPE html>
  <html lang="vi">
  <head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <style>
        *{box-sizing:border-box}
        body{
          margin:100px 0 0;
          font-family:Arial,Helvetica,sans-serif;
         background: #f4f5fa;
        }
        h1{
            font-weight:700;
            font-size:26px;
        }
        h2{
           font-weight:700;
            font-size:18px; 
        }
        .card p{  
            font-size:15px;
            margin-top:10px;
            margin-bottom:10px;
            font-weight:bold;
        }
        .container{
          max-width:70vw;
          margin:40px auto;
          box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
          rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
          border-radius:12px;
          padding:30px;
        }
        .header{
          display:flex;
          justify-content:space-between;
          align-items:center;
          margin-bottom:30px;
        }
        .header h1{margin:0}
        .avatar{
          display:flex;
          align-items:center;
          gap:15px;
        }
        .card img{
          width:100px;
          height:100px;
          border-radius:50%;
          object-fit:cover;
          border:2px solid #ddd;
        }
        .content{
          display:grid;
          grid-template-columns:2fr 1fr;
          gap:30px;
        }
        .card__vip{
            grid-column-start:1;
            grid-column-end:3;
        }
        .card{
          border:1px solid #55555555;
          border-radius:10px;
          padding:20px;
        }
        .card h2{
          margin-top:0;
          margin-bottom:20px;
        }
        .form-group{
          display:flex;
          flex-direction:column;
          margin-bottom:15px;
        }
        .form-group label{
          margin-bottom:6px;
          font-size:14px;
          color:#555;
        }
        .form-group input,
        .form-group select{
          padding:10px;
          border-radius:8px;
          border:1px solid #ccc;
          outline:none;
        }
        input:focus{
            border-color:var(--primary-color);
        }
        .btn{
          padding:12px;
          border:none;
          border-radius:10px;
          background:var(--primary-color);
          color:#fff;
          font-weight:bold;
          cursor:pointer;
        }
        .btn:hover{opacity:0.9}
        .card__avt{
            display:flex;
            align-items:center;
            justify-content:space-between;
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
  <?php 
     
        $sqlNguoiDung = "SELECT * FROM nguoi_dung WHERE id = '$id'";
        $resultNd = mysqli_query($conn , $sqlNguoiDung);
        if(mysqli_num_rows($resultNd) > 0){
          $nguoiDung = mysqli_fetch_assoc($resultNd);
        }
      
  ?>
  <div class="container">
    <div class="header">
      <h1>Thông tin của bạn</h1>
      
    </div>
    <div class="content">
      <div class="card">
        <h2>Thông tin cơ bản</h2>
        <form action="" method="post" >
          <div class="form-group">
            <label for="ho_ten">Họ tên</label>
            <input name="ho_ten" value="<?= $nguoiDung['ho_ten'] ?>" id="ho_ten">
          </div>
          <div class="form-group">
            <label for="gioi_tinh">Giới tính</label>
            <select name="gioi_tinh" id="gioi_tinh">
              <option value="nam" <?php if($nguoiDung["gioi_tinh"] === "nam"){echo "selected";} ?>>nam</option>
              <option value="nữ" <?php if($nguoiDung["gioi_tinh"] === "nữ"){echo "selected";} ?>>nữ</option>
              <option value="khác" <?php if($nguoiDung["gioi_tinh"] === "khác"){echo "selected";} ?>>khác</option>
            </select>
          </div>
          <div class="form-group">
            <label for="so_dien_thoai">Số điện thoại</label>
            <input name="so_dien_thoai" value="<?= $nguoiDung['so_dien_thoai'] ?>" id="so_dien_thoai">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input name="email" value="<?= $nguoiDung['email'] ?>" id="email">
          </div>
          <div class="form-group">
            <label for="dia_chi">Địa chỉ</label>
            <input name="dia_chi" value="<?= $nguoiDung['dia_chi'] ?>" id="dia_chi">
          </div>
          <button type="submit" class="btn">Lưu thay đổi</button>
        </form>
      </div>
      <div class="card">
        <h2>Đổi mật khẩu</h2>
        <form action="" method="post">
          <div class="form-group">
            <label for="mat_khau_cu">Mật khẩu cũ</label>
            <input type="password"
            name="mat_khau_cu"
            id="mat_khau_cu"
            required>
          </div>
          <div class="form-group">
            <label for="mat_khau_moi">Mật khẩu mới</label>
            <input 
            name="mat_khau_moi"
            id="mat_khau_moi"
            required
             type="password">
          </div>
          <button type="submit" name="doi_mat_khau" class="btn">Cập nhật</button>
        </form>
        <?php 
        if(isset($_POST['doi_mat_khau'])){
          $matKhauCu = $_POST['mat_khau_cu'];
          $matKhauMoi = $_POST['mat_khau_moi'];
          $sqlmk = "SELECT mat_khau FROM nguoi_dung WHERE id = $id";
          $resultmk = mysqli_query($conn, $sqlmk);
          $rowmk = mysqli_fetch_assoc($resultmk);
          if($rowmk['mat_khau'] == $matKhauCu){
               $sqlUpdateMK = "
                  UPDATE nguoi_dung
                  SET mat_khau = '$matKhauMoi'
                  WHERE id = $id
                               ";
             mysqli_query($conn, $sqlUpdateMK);
             echo "<p style=color:red;>Thành công đổi mật khẩu<p>";
          }else{
             echo "<p style=color:red;>Thất bại đổi mật khẩu<p>";
          }
        }
        ?>
      </div>
      </div>
  </div>
      <?php include "./includes/footer.php";  ?>
  </body>
  </html>
