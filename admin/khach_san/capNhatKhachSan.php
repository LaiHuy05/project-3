<?php

$id = $_GET["id"];
$sql = "SELECT * FROM khach_san WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$khachSan = mysqli_fetch_assoc($result);

if (
    !empty($_POST['ten-khach-san'])
    && !empty($_POST['email']) && !empty($_POST['sdt'])
    && !empty($_POST['mo-ta']) && !empty($_POST['dia-diem'])
) {
    $tenKhachSan = $_POST['ten-khach-san'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diaDiem = $_POST['dia-diem'];
    $moTa = $_POST['mo-ta'];
    $sql = "UPDATE `khach_san` SET `ten_khach_san`='$tenKhachSan',`dia_diem_id`='$diaDiem',`so_dien_thoai`='$sdt',`email`='$email',`mo_ta`='$moTa' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: trangAdmin.php?page_layout=trangKhachSan');
        exit;
    } else {
        echo '<p class="canh-bao">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Khách Sạn</title>
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

        .o-van-ban {
            width: 100%;
            height: 100px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            resize: vertical;
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
            <form action="trangAdmin.php?page_layout=capNhatKhachSan&id=<?php echo $id;?>" method="POST">

                <h3 class="tieu-de-trang">CẬP NHẬT KHÁCH SẠN</h3>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Tên khách sạn</label>
                    <input type="text" name="ten-khach-san" class="o-nhap" placeholder="Tên khách sạn" value="<?php echo $khachSan["ten_khach_san"] ?>">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Email</label>
                    <input type="email" name="email" class="o-nhap" placeholder="Email" value="<?php echo $khachSan["email"] ?>" >
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Số điện thoại</label>
                    <input type="text" name="sdt" class="o-nhap" placeholder="SĐT" value="<?php echo $khachSan["so_dien_thoai"] ?>">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Mô tả</label>
                    <textarea class="o-van-ban" name="mo-ta" placeholder="Mô tả chi tiết" ><?php echo $khachSan["mo_ta"] ?></textarea>
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Địa điểm</label>
                    <select name="dia-diem" class="o-lua-chon">
                        <?php
                        $dia_Diem = mysqli_query($conn, "SELECT * FROM dia_diem");
                        while ($row = mysqli_fetch_assoc($dia_Diem)) {
                            $selected = ($row['id'] == $khachSan['dia_diem_id']) ? "selected" : "";
                            echo "<option value='{$row['id']}' $selected>{$row['ten_dia_diem']}</option>";
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