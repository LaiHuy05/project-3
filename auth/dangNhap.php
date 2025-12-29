<?php
session_start();
include "../includes/connect.php";
$error = "";
if (isset($_POST["tenDangNhap"])) {
    $tenDangNhap = $_POST["tenDangNhap"];
    $matKhau     = $_POST["matKhau"];
    $sql = "
        SELECT * 
        FROM nguoi_dung 
        WHERE ten_dang_nhap = '$tenDangNhap'
    ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 0) {
        $error = "Tài khoản không tồn tại.";
    } else {

        $row = mysqli_fetch_assoc($result);

        
        if ($matKhau !== $row["mat_khau"]) {
            $error = "Mật khẩu không chính xác.";
        } else {
            $_SESSION["hoTen"]      = $row["ho_ten"];
            $_SESSION["idNguoiDung"] = $row["id"];
            $_SESSION["vaiTro"]     = $row["vai_tro"];
            if ($row["vai_tro"] === "khach hang") {
                header("Location: ../index.php?chuyen_trang=trangChu");
            } else {
                header("Location: ../admin/trangAdmin.php");
            }
            exit;
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
  margin: 0;
  padding: 0;
}

:root {
  --primary-color: #07a5fe;
}

a {
  text-decoration: none;
}

body {
  font-family: "Roboto", sans-serif;
  background-color: #f4f5fa;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.login {
  display: flex;
  justify-content: center;
  width: 100%;
}

.container-login {
  display: flex;
  width: 90%;
  max-width: 1200px;
  background-color: #ffffff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.img-login {
  width: 50%;
  max-height: 80vh;
  overflow: hidden;
}

.img-login img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.form-login-section {
  width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px;
}

.login-form-wrapper {
  width: 100%;
  max-width: 400px;
}

.login-form-wrapper h2 {
  font-size: 28px;
  margin-bottom: 8px;
  color: #333;
}

.subtitle {
  font-size: 16px;
  color: #666;
  margin-bottom: 30px;
}

.input-group {
  margin-bottom: 20px;
}

.input-group label {
  display: block;
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 6px;
  color: #333;
}

.input-login {
  display: flex;
  align-items: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px 12px;
  background-color: #fff;
}

.input-login i {
  color: #888;
  margin-right: 10px;
  font-size: 15px;
}

.input-login input {
  flex: 1;
  border: none;
  outline: none;
  font-size: 16px;
  background: transparent;
}

.toggle-eye {
  cursor: pointer;
  color: #888;
  padding: 4px 6px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.toggle-eye:hover {
  color: #333;
}

.forgot-password {
  display: block;
  margin-top: 6px;
  text-align: right;
  font-size: 14px;
  color: var(--primary-color);
}

.forgot-password:hover {
  text-decoration: underline;
}

.login-button {
  width: 100%;
  padding: 12px;
  margin-top: 30px;
  background-color: var(--primary-color);
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
  transition: filter 0.3s;
}

.login-button:hover {
  filter: brightness(110%);
}

.sigup-link {
  text-align: center;
  margin-top: 20px;
  font-size: 15px;
  color: #666;
}

.sigup-link a {
  color: var(--primary-color);
  font-weight: 600;
}

.sigup-link a:hover {
  text-decoration: underline;
}

</style>
    <title>Đăng Nhập</title>
  </head>
  <body>
    <div class="login">
      <div class="container-login">
        <div class="img-login">
          <img src="../assets/img/imglogin.jpg" alt="Hình ảnh nội thất" />
        </div>

        <div class="form-section form-login-section">
          <div class="login-form-wrapper">
            <h2>Chào mừng trở lại!</h2>
            <p class="subtitle">
              Truy cập tài khoản của bạn để quản lý đặt phòng.
            </p>
            <form action="" method="post">
              <div class="input-group">
                <label for="email">Tên đăng nhập</label>
                <div class="input-login">
                  <i class="fa-solid fa-user"></i>
                  <input
                    name="tenDangNhap"
                    id="email"
                    type="text"
                    placeholder="Nhập tên người dùng của bạn"
                    required
                  />
                </div>
              </div>
             <div class="input-group">
              <label for="password">Mật khẩu</label>

            <div class="input-login">
               <i class="fa-solid fa-lock"></i>
              <input
               name="matKhau"
               id="password"
               type="password"
               placeholder="Nhập mật khẩu của bạn"
               required
              />
             <i class="fa-solid fa-eye-slash toggle-eye"></i>

           </div>

            <a href="#" class="forgot-password">Quên mật khẩu?</a>
</div>

              <button type="submit" class="login-button">Đăng Nhập</button>
            </form>
            <div class="sigup-link">
              Chưa có tài khoản? <a href="./dangKy.php">Đăng ký ngay</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
  const toggleEye = document.querySelector(".toggle-eye");
  const eyeIcon = toggleEye.querySelector("i");
  const passwordInput = document.querySelector('input[name="matKhau"]');

  toggleEye.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    }
  });
</script>

  </body>
</html>
