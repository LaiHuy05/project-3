<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Người Dùng</title>
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

        .tieu-de-bieu-mau {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .nhom-bieu-mau {
            margin-bottom: 18px;
        }

        .nhan-bieu-mau {
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
            display: block;
        }

        .o-nhap,
        .o-chon,
        .nut-gui {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .o-chon {
            background-color: #fff;
        }

        .nut-gui {
            background-color: #293b5f;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .nut-gui:hover {
            background-color: #1f2a44;
        }

        .canh-bao {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    
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
        $sql = "INSERT INTO `nguoi_dung`(`ten_dang_nhap`, `mat_khau`, `ho_ten`, `email`, `so_dien_thoai`, `dia_chi`, `vai_tro`) VALUES ('$tenDangNhap','$matKhau','$hoTen','$email','$sdt','$diaChi','$vaiTro')";

        if (mysqli_query($conn, $sql)) {
            header('Location: trangAdmin.php?page_layout=trangNguoiDung');
            exit;
        } else {
            echo '<p class="canh-bao">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
        }
    }
    ?>

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=themNguoiDung" method="POST">
                <h3 class="tieu-de-bieu-mau">THÊM NGƯỜI DÙNG</h3>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Tên đăng nhập</label>
                    <input type="text" name="ten-dang-nhap" class="o-nhap" placeholder="Tên đăng nhập">
                </div>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Mật khẩu</label>
                    <input type="password" name="mat-khau" class="o-nhap" placeholder="Mật khẩu">
                </div>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Họ tên</label>
                    <input type="text" name="ho-ten" class="o-nhap" placeholder="Họ tên">
                </div>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Email</label>
                    <input type="email" name="email" class="o-nhap" placeholder="Email">
                </div>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Số điện thoại</label>
                    <input type="text" name="sdt" class="o-nhap" placeholder="SĐT">
                </div>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Địa chỉ</label>
                    <input type="text" name="dia-chi" class="o-nhap" placeholder="Địa chỉ">
                </div>

                <div class="nhom-bieu-mau">
                    <label class="nhan-bieu-mau">Vai trò</label>
                    <select name="vai-tro" class="o-chon">
                        <option value="khach hang">Khách hàng</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="nhom-bieu-mau">
                    <button type="submit" class="nut-gui">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>