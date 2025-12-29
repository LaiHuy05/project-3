<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phòng</title>
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

        .tieu-de-trang {
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
            display: block;
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
    <?php
   
    if (
        !empty($_POST['so-phong'])
        && !empty($_POST['khach-san']) && !empty($_POST['loai-phong'])
        && !empty($_POST['gia-phong']) && !empty($_POST['trang-thai'])
    ) {
        $soPhong = $_POST['so-phong'];
        $khachSan = $_POST['khach-san'];
        $loaiPhong = $_POST['loai-phong'];
        $giaPhong = $_POST['gia-phong'];
        $trangThai = $_POST['trang-thai'];
        $sql = "INSERT INTO `phong`(`khach_san_id`, `so_phong`, `loai_phong`, `gia_phong`, `trang_thai`) VALUES ('$khachSan','$soPhong','$loaiPhong','$giaPhong','$trangThai')";

        if (mysqli_query($conn, $sql)) {
            header('Location: trangAdmin.php?page_layout=trangPhong');
            exit;
        } else {
            echo '<p class="canh-bao">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
        }
    }
    ?>

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=themPhong" method="POST">

                <h3 class="tieu-de-trang">THÊM PHÒNG</h3>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Số phòng</label>
                    <input type="text" name="so-phong" class="o-nhap" placeholder="Số phòng">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Loại phòng</label>
                    <input type="text" name="loai-phong" class="o-nhap" placeholder="Loại phòng">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Giá phòng</label>
                    <input type="number" name="gia-phong" class="o-nhap" placeholder="Giá phòng">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Trạng thái</label>
                    <select name="trang-thai" class="o-lua-chon">
                        <option value="dat">Đặt</option>
                        <option value="trong">Trống</option>
                        <option value="baotri">Bảo trì</option>
                    </select>
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Khách sạn</label>
                    <select name="khach-san" class="o-lua-chon">
                        <?php
                        $sql = "SELECT * FROM khach_san";
                        $result = mysqli_query($conn, $sql);
                        while ($khachSan = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $khachSan['id']; ?>">
                                <?php echo $khachSan['ten_khach_san']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="nhom-nhap-lieu">
                    <button type="submit" class="nut-bam">THÊM MỚI</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>