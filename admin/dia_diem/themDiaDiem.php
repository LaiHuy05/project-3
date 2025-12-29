<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm địa điểm</title>
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
            display: block;
        }

        .o-nhap,
        .nut-bam {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
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
    
    if (!empty($_POST['ten-dia-diem'])) {
        $tenDiaDiem = $_POST['ten-dia-diem'];
        $sql = "INSERT INTO `dia_diem`(`ten_dia_diem`) VALUES ('$tenDiaDiem')";

        if (mysqli_query($conn, $sql)) {
            header('Location: trangAdmin.php?page_layout=trangDiaDiem');
            exit;
        } else {
            echo '<p class="canh-bao">Lỗi SQL: ' . mysqli_error($conn) . '</p>';
        }
    }
    ?>

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=themDiaDiem" method="POST">
                <h3>THÊM ĐỊA ĐIỂM</h3>
                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Tên địa điểm</label>
                    <input type="text" name="ten-dia-diem" class="o-nhap" placeholder="Tên địa điểm">
                </div>
                <div class="nhom-nhap-lieu">
                    <button type="submit" class="nut-bam">THÊM MỚI</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>