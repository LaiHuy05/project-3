<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <style>
        .bang-tuy-chinh {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto 0 auto;
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
        <h2>TRANG QUẢN LÍ NGƯỜI DÙNG</h2>
        <a class="them-moi" href="trangAdmin.php?page_layout=themNguoiDung">
            <i class="fa-solid fa-plus"></i> Thêm người dùng
        </a>
    </div>

    <table class="bang-tuy-chinh">
        <thead>
            <tr>
                <th>STT</th>
                <th>TÊN ĐĂNG NHẬP</th>
                <th>HỌ TÊN</th>
                <th>EMAIL</th>
                <th>SỐ ĐIỆN THOẠI</th>
                <th>ĐỊA CHỈ</th>
                <th>VAI TRÒ</th>
                <th>CHỨC NĂNG</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $sql = "SELECT * FROM `nguoi_dung`";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["ten_dang_nhap"] ?></td>
                <td><?php echo $row["ho_ten"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td><?php echo $row["so_dien_thoai"] ?></td>
                <td><?php echo $row["dia_chi"] ?></td>
                <td><?php echo $row["vai_tro"] ?></td>
                <td>
                    <a class="nut-bam sua" href="trangAdmin.php?page_layout=capNhatNguoiDung&id=<?php echo $row["id"]?>">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <a class="nut-bam xoa" href="./trang_nguoi_dung/xoaNguoiDung.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>