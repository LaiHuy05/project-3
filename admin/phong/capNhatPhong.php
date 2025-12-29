<?php

$id = $_GET["id"];
$sql = "SELECT * FROM phong WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$phong = mysqli_fetch_assoc($result);

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
    $sql = "UPDATE `phong` SET `khach_san_id`='$khachSan',`so_phong`='$soPhong',`loai_phong`='$loaiPhong',`gia_phong`='$giaPhong',`trang_thai`='$trangThai' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: trangAdmin.php?page_layout=trangPhong');
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
    <title>Cập Nhật Phòng</title>
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

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=capNhatPhong&id=<?php echo $id ?>" method="POST">

                <h3 class="tieu-de-trang">CẬP NHẬT PHÒNG</h3>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Số phòng</label>
                    <input type="text" name="so-phong" class="o-nhap" placeholder="Số phòng" value="<?php echo $phong["so_phong"] ?>">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Loại phòng</label>
                    <input type="text" name="loai-phong" class="o-nhap" placeholder="Loại phòng" value="<?php echo $phong["loai_phong"] ?>">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Giá phòng</label>
                    <input type="number" name="gia-phong" class="o-nhap" placeholder="Giá phòng" value="<?php echo $phong["gia_phong"] ?>">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Trạng thái</label>
                    <select name="trang-thai" class="o-lua-chon">
                        <option value="dat" <?php echo $phong["trang_thai"] == 'dat' ? 'selected' : "" ?>>Đặt</option>
                        <option value="trong" <?php echo $phong["trang_thai"] == 'trong' ? 'selected' : "" ?>>Trống</option>
                        <option value="baotri" <?php echo $phong["trang_thai"] == 'baotri' ? 'selected' : "" ?>>Bảo trì</option>
                    </select>
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Khách sạn</label>
                    <select name="khach-san" class="o-lua-chon">
                        <?php
                        $khach_san = mysqli_query($conn, "SELECT * FROM khach_san");
                        while ($row = mysqli_fetch_assoc($khach_san)) {
                            $selected = ($row['id'] == $phong['khach_san_id']) ? "selected" : "";
                            echo "<option value='{$row['id']}' $selected>{$row['ten_khach_san']}</option>";
                        }
                        ?>
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