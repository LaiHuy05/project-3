<?php
include "../includes/connect.php";
$error = "";
$success = "";
if (isset($_POST['sigup'])) {
    $hoTen    = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $address  = trim($_POST['address'] ?? '');
    $gender   = $_POST['gender'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    if (
        $hoTen === "" || $username === "" || $email === "" ||
        $phone === "" || $address === "" ||
        $gender === "" || $password === "" || $confirm === ""
    ) {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    }
    else if ($password !== $confirm) {
        $error = "Mật khẩu xác nhận không khớp.";
    }
    else {
        switch ($gender) {
            case 'Nam':
                $gioiTinhId = 1;
                break;
            case 'Nu':
                $gioiTinhId = 2;
                break;
            default:
                $gioiTinhId = 3;
        }
        $checkSql = "SELECT id FROM nguoi_dung 
                     WHERE ten_dang_nhap = '$username' 
                        OR email = '$email'";
        $checkRes = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkRes) > 0) {
            $error = "Tên đăng nhập hoặc email đã tồn tại.";
        } else {
            $sqlInsert = "
                INSERT INTO nguoi_dung
                (ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, dia_chi, gioi_tinh)
                VALUES
                ('$username', '$password', '$hoTen', '$email', '$phone', '$address', $gioiTinhId)
            ";
            if (mysqli_query($conn, $sqlInsert)) {
              
                header("Location: ../auth/dangNhap.php");
                exit;
            } else {
                $error = "Lỗi hệ thống: " . mysqli_error($conn);
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sora:wght@100..800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
 <style>
    * {
      box-sizing: border-box;
    }

    :root {
      --primary-color: #07a5fe;
    }

    body {
      font-family: "Roboto", sans-serif;
      background-color: #f7f7fa;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .sigup {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .container-sigup {
      display: flex;
      width: 900px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      overflow: visible;
    }

    .img-sigup {
      width: 50%;
      overflow: hidden;
    }

    .img-sigup img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .form-sigup-section {
      width: 50%;
      padding: 30px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      overflow-y: auto;
    }

    .img-logo {
      margin-bottom: 10px;
    }

    .img-logo img {
      width: 90px;
    }

    form {
      width: 100%;
      max-width: 320px;
    }

    .input-group1 {
      margin-bottom: 15px;
    }

    .input-group1 label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 5px;
    }

    .input-sigup {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 10px;
    }

    .input-sigup input {
      border: none;
      outline: none;
      flex: 1;
      font-size: 13px;
    }

    .gender-group {
      display: flex;
      gap: 15px;
      font-size: 14px;
    }

    .signup-button {
      width: 100%;
      padding: 12px;
      background-color: var(--primary-color);
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 10px;
    }

    .signup-button:hover {
      background-color: #4a327e;
    }

    .login-link {
      margin-top: 15px;
      font-size: 14px;
    }

    .login-link a {
      color: var(--primary-color);
      font-weight: 600;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

   .error-message {
  width: 100%;
  max-width: 320px;
  background-color: #fdecea;
  color: #b71c1c;
  padding: 10px 12px;
  border-radius: 4px;
  font-size: 14px;
  margin-bottom: 15px;
  border: 1px solid #f5c2c7;
  text-align: center;
 }

</style>
    <title>Đăng ký</title>
  </head>
  <body>
    <div class="sigup">
      <div class="container-sigup">
        <div class="img-sigup">
          <img src="../assets/img/imgsigup.jpg" alt="Nội thất sảnh chờ" />
        </div>
        <div class="form-section form-sigup-section">
          <div class="img-logo">
            <img src="../assets/img/logo.png" alt="" />
          </div>
          <?php if (!empty($error)) : ?>
         <div class="error-message">
          <?php echo $error; ?>
         </div>
         <?php endif; ?>

          <form action="" method="post">
 
  <div class="input-group1">
    <label for="name">Họ và Tên</label>
    <div class="input-sigup">
      <input
        name="name"
        id="name"
        type="text"
        placeholder="Nhập họ và tên của bạn"
        required
      />
    </div>
  </div>

  <div class="input-group1">
    <label for="username">Tên đăng nhập</label>
    <div class="input-sigup">
      <input
        name="username"
        id="username"
        type="text"
        placeholder="Nhập tên đăng nhập"
        required
      />
    </div>
  </div>


  <div class="input-group1">
    <label for="email">Email</label>
    <div class="input-sigup">
      <input
        name="email"
        id="email"
        type="email"
        placeholder="example@mail.com"
        required
      />
    </div>
  </div>

<div class="input-group1">
  <label for="phone">Số điện thoại</label>
  <div class="input-sigup">
    <input
      name="phone"
      id="phone"
      type="text"
      placeholder="Nhập số điện thoại"
      required
    />
  </div>
</div>

<div class="input-group1">
  <label for="address">Địa chỉ</label>
  <div class="input-sigup">
    <input
      name="address"
      id="address"
      type="text"
      placeholder="Nhập địa chỉ"
      required
    />
  </div>
</div>

  <div class="input-group1">
    <label>Giới tính</label>
    <div class="input-sigup" style="gap: 15px; border: none; padding-left: 0">
      <label><input type="radio" name="gender" value="nam" required /> Nam</label>
      <label><input type="radio" name="gender" value="nữ" /> Nữ</label>
      <label><input type="radio" name="gender" value="khác" /> Khác</label>
    </div>
  </div>
  <div class="input-group1">
    <label for="password">Mật khẩu</label>
    <div class="input-sigup">
      <input
        name="password"
        id="password"
        type="password"
        placeholder="Nhập mật khẩu của bạn"
        required
      />
      <span class="toggle-eye">
        <i class="fas fa-eye-slash toggle-password"></i>
      </span>
    </div>
  </div>
  <div class="input-group1">
    <label for="confirm_password">Xác nhận Mật khẩu</label>
    <div class="input-sigup">
      <input
        name="confirm_password"
        id="confirm_password"
        type="password"
        placeholder="Nhập lại mật khẩu của bạn"
        required
      />
      <span class="toggle-eye">
        <i class="fas fa-eye-slash toggle-password"></i>
      </span>
    </div>
  </div>

  <button type="submit" class="signup-button" name="sigup">
    Đăng Ký
  </button>

</form>

          <div class="login-link">
            Đã có tài khoản? <a href="./dangNhap.php">Đăng nhập</a>
          </div>
        </div>
      </div>
    </div>
    <script>
  
  const toggleIcons = document.querySelectorAll(".toggle-password");

  toggleIcons.forEach(function (icon) {
    icon.addEventListener("click", function () {
      const input = this.closest(".input-sigup").querySelector("input");

      if (input.type === "password") {
        input.type = "text";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
      } else {
        input.type = "password";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
      }
    });
  });
</script>

  </body>
</html>
