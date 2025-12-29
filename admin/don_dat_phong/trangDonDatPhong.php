<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn đặt phòng</title>
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

        .chi-tiet {
            background-color: #e5e5e5;
            color: #000;
        }

        .dau-trang {
            width: 90%;
            display: flex;
            justify-content: space-between;
            margin: 20px auto 0 auto;
        }

        h2 {
            margin: 0 auto;
            text-align: center;
        }

        .trang-thai {
            background-color: #e3fcef;
            color: #00875a;
            padding: 5px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="dau-trang">
        <h2>TRANG QUẢN LÍ ĐƠN ĐẶT PHÒNG</h2>
    </div>

    <table class="bang-tuy-chinh">
        <thead>
            <tr>
                <th>STT</th>
                <th>NGƯỜI DÙNG</th>
                <th>NGÀY NHẬN</th>
                <th>NGÀY TRẢ</th>
                <th>TRẠNG THÁI</th>
                <th>CHỨC NĂNG</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT ddp.*, nd.ho_ten FROM `don_dat_phong` ddp JOIN `nguoi_dung` nd ON ddp.nguoi_dung_id = nd.id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["ho_ten"] ?></td>
                    <td><?php echo $row["ngay_nhan"] ?></td>
                    <td><?php echo $row["ngay_tra"] ?></td>
                    <td>
                        <p class="trang-thai"><?php echo $row["trang_thai"] ?></p>
                    </td>
                    <td>
                        <a class="nut-bam chi-tiet" href="trangAdmin.php?page_layout=chiTietDonDatPhong&id=<?php echo $row["id"] ?>">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>