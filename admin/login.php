<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
     <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Admin Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(rgba(255, 255, 255, 0.85)),
                url("https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg");
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hop-dang-nhap {
            display: flex;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .dang-nhap-trai {
            width: 50%;
            padding: 40px;
        }

        .dang-nhap-trai h2 {
            margin-bottom: 25px;
            color: #333;
        }

        .dang-nhap-trai input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .dang-nhap-trai button {
            width: 100%;
            padding: 12px;
            background: #2f80ed;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .dang-nhap-trai button:hover {
            background: #2566c5;
        }

        .duong-dan-phu {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }

        .duong-dan-phu a {
            font-size: 14px;
            color: #2f80ed;
            text-decoration: none;
        }

        .dang-nhap-phai {
            width: 50%;
            background: #f4fbff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .dang-nhap-phai img {
            width: 180px;
            margin-bottom: 20px;
        }

        .dang-nhap-phai p {
            color: #555;
            font-size: 15px;
            text-align: center;
        }

        .canh-bao {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="khung-dang-nhap">
        <div class="hop-dang-nhap">

            <div class="dang-nhap-trai">
                <h2>Đăng Nhập Booking Admin</h2>
                <form action="login.php" method="post">
                    <input type="text" name="username" placeholder="Tên người dùng">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <button type="submit">Đăng Nhập</button>
                </form>

                <?php
                include("../includes/connect.php");

                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $tenDangNhap = $_POST['username'];
                    $matKhau = $_POST['password'];

                    $sql = "SELECT * 
            FROM nguoi_dung 
            WHERE ten_dang_nhap='$tenDangNhap' 
              AND mat_khau='$matKhau'
              AND vai_tro='admin'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        session_start();
                        $_SESSION["username"] = $tenDangNhap;
                        $_SESSION["vai_tro"] = "admin";

                        header("location: trangAdmin.php?page_layout=trangTongQuan");
                        exit();
                    } else {
                        echo '<p class="canh-bao">Bạn không có quyền truy cập trang quản trị!</p>';
                    }
                }
                ?>


                <div class="duong-dan-phu">
                    <a href="#">Quên mật khẩu?</a>
                    <a href="#">Tạo tài khoản</a>
                </div>
            </div>

            <div class="dang-nhap-phai">
                <img src="./img/login.png" alt="Login Image">
                <p>Quản lý đặt chỗ thông minh và hiệu quả</p>
            </div>

        </div>
    </div>

</body>

</html>