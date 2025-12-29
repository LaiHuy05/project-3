<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Sạn</title>
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

    <?php
   
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
        $sql = "INSERT INTO `khach_san`(`ten_khach_san`, `dia_diem_id`, `so_dien_thoai`, `email`, `mo_ta`) VALUES ('$tenKhachSan','$diaDiem','$sdt','$email','$moTa')";

        if (mysqli_query($conn, $sql)) {
            header('Location: trangAdmin.php?page_layout=trangKhachSan');
            exit;
        } else {
            echo '<p class="canh-bao">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
        }
    }
    ?>

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=themKhachSan" method="POST">

                <h3 class="tieu-de-trang">THÊM KHÁCH SẠN</h3>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Tên khách sạn</label>
                    <input type="text" name="ten-khach-san" class="o-nhap" placeholder="Tên khách sạn">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Email</label>
                    <input type="email" name="email" class="o-nhap" placeholder="Email">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Số điện thoại</label>
                    <input type="text" name="sdt" class="o-nhap" placeholder="SĐT">
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Mô tả</label>
                    <textarea class="o-van-ban" name="mo-ta" placeholder="Mô tả chi tiết"></textarea>
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Địa điểm</label>
                    <select name="dia-diem" class="o-lua-chon">
                        <?php
                        $sql = "SELECT * FROM dia_diem";
                        $result = mysqli_query($conn, $sql);
                        while ($diaDiem = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $diaDiem['id']; ?>">
                                <?php echo $diaDiem['ten_dia_diem']; ?>
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