<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách địa điểm</title>
    <style>
        .bang-tuy-chinh {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto 0;
            border: 1px solid black;
            overflow: hidden;
            border-radius: 20px;
        }

        .bang-tuy-chinh th,
        .bang-tuy-chinh td {
            border-bottom: 0.01px solid gainsboro;
            padding: 14px 12px;
            text-align: center;
        }

        .bang-tuy-chinh thead {
            background-color: #f3f3f3;
            font-weight: bold;
        }

        .bang-tuy-chinh tbody tr {
            background-color: #fff;
        }

        .bang-tuy-chinh tbody tr:hover {
            background-color: #f9f9f9;
        }

        .nut-bam {
            padding: 8px 10px;
            cursor: pointer;
            border: 1px solid gainsboro;
            border-radius: 10px;
            display: inline-block;
            text-decoration: none;
        }

        .sua {
            background-color: #e5e5e5;
            color: #000;
        }

        .xoa {
            background-color: #293b5f;
            color: white;
        }

        .dau-trang {
            width: 90%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 auto;
        }

        .them-moi {
            padding: 15px 20px;
            border-radius: 10px;
            background-color: #293b5f;
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div class="dau-trang">
        <h2>TRANG QUẢN LÍ ĐỊA ĐIỂM</h2>
        <a class="them-moi" href="trangAdmin.php?page_layout=themDiaDiem">
            <i class="fa-solid fa-plus"></i> Thêm địa điểm
        </a>
    </div>

    <table class="bang-tuy-chinh">
        <thead>
            <tr>
                <th>STT</th>
                <th>TÊN ĐỊA ĐIỂM</th>
                <th>CHỨC NĂNG</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT * FROM `dia_diem`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["ten_dia_diem"] ?></td>
                    <td>
                        <a class="nut-bam sua" href="trangAdmin.php?page_layout=capNhatDiaDiem&id=<?php echo $row["id"] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a class="nut-bam xoa" href="./dia_diem/xoaDiaDiem.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Bạn có chắc muốn xóa địa điểm này?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>