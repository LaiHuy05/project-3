<?php

$id = $_GET["id"];
$sql = "SELECT * FROM nguoi_dung WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$nguoiDung = mysqli_fetch_assoc($result);

if (
    !empty($_POST['ten-dang-nhap'])
    && !empty($_POST['mat-khau']) && !empty($_POST['ho-ten'])
    && !empty($_POST['email']) && !empty($_POST['sdt']) && !empty($_POST['dia-chi']) && !empty($_POST['vai-tro'])
) {
    $tenDangNhap = $_POST['ten-dang-nhap'];
    $matKhau = $_POST['mat-khau'];
    $hoTen = $_POST['ho-ten'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diaChi = $_POST['dia-chi'];
    $vaiTro = $_POST['vai-tro'];
    $sql = "UPDATE nguoi_dung
                SET 
                    ten_dang_nhap      = '$tenDangNhap',
                    mat_khau        = '$matKhau',
                    ho_ten         = '$hoTen',
                    email           = '$email',
                    so_dien_thoai    = '$sdt',
                    dia_chi   = '$diaChi',
                    vai_tro   = '$vaiTro'
                WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: trangAdmin.php?page_layout=trangNguoiDung');
        exit;
    } else {
        echo '<p class="canh-bao">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Người Dùng</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .khung-ngoai {
            width: 60%;
            background-color: #f9fbfd;
            margin: 40px auto;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .noi-dung-trong {
            padding: 7%;
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .nhom-nhap-lieu {
            margin-bottom: 18px;
        }

        .nhan-nhap-lieu {
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        .o-nhap,
        .o-lua-chon,
        .nut-bam {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .o-lua-chon {
            background-color: #fff;
        }

        .nut-bam {
            background-color: #293b5f;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .nut-bam:hover {
            background-color: #1f2a44;
        }

        .canh-bao {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=capNhatNguoiDung&id=<?php echo $id ?>" method="POST">
                <h3>CẬP NHẬT NGƯỜI DÙNG</h3>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Tên đăng nhập</p>
                    <input type="text" name="ten-dang-nhap" class="o-nhap" placeholder="Tên đăng nhập"
                        value="<?php echo $nguoiDung["ten_dang_nhap"] ?>">
                </div>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Mật khẩu</p>
                    <input type="password" name="mat-khau" class="o-nhap" placeholder="Mật khẩu"
                        value="<?php echo $nguoiDung["mat_khau"] ?>">
                </div>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Họ tên</p>
                    <input type="text" name="ho-ten" class="o-nhap" placeholder="Họ tên" value="<?php echo $nguoiDung["ho_ten"] ?>">
                </div>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Email</p>
                    <input type="email" name="email" class="o-nhap" placeholder="Email" value="<?php echo $nguoiDung["email"] ?>">
                </div>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Số điện thoại</p>
                    <input type="text" name="sdt" class="o-nhap" placeholder="Số điện thoại" value="<?php echo $nguoiDung["so_dien_thoai"] ?>">
                </div>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Địa chỉ</p>
                    <input type="text" name="dia-chi" class="o-nhap" placeholder="Địa chỉ" value="<?php echo $nguoiDung["dia_chi"] ?>">
                </div>
                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Vai trò</p>
                    <select name="vai-tro" class="o-lua-chon">
                        <option value="khach hang" <?php echo $nguoiDung["vai_tro"] == 'khach hang' ? 'selected' : "" ?>>
                            Khách hàng</option>
                        <option value="admin" <?php echo $nguoiDung["vai_tro"] == 'admin' ? 'selected' : "" ?>>Admin
                        </option>
                    </select>
                </div>
                <div class="nhom-nhap-lieu">
                    <button type="submit" class="nut-bam">CẬP NHẬT</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>