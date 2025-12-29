<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách khách sạn</title>
</head>

<style>
    .khung-danh-sach {
        max-width: 1000px;
        margin: 20px auto 0;
    }

    .o-khach-san {
        display: flex;
        align-items: flex-start;
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .vung-hinh-anh {
        width: 150px;
        margin-right: 16px;
    }

    .anh-chinh {
        width: 150px;
        height: 110px;
        object-fit: cover;
        border-radius: 10px;
    }

    .bo-suu-tap {
        display: flex;
        gap: 6px;
        margin-top: 6px;
    }

    .anh-phu {
        width: 45px;
        height: 32px;
        object-fit: cover;
        border-radius: 6px;
    }

    .noi-dung-khach-san {
        flex: 1;
    }

    .noi-dung-khach-san h3 {
        margin: 0 0 8px;
        font-size: 18px;
    }

    .noi-dung-khach-san p {
        margin: 0 0 10px;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
        margin-right: 50px;
    }

    .nhan-thong-tin {
        display: inline-block;
        padding: 4px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 13px;
        color: #666;
        margin-bottom: 4px;
    }

    .dau-trang {
        width: 80%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 10%;
    }

    .nut-them {
        padding: 15px 20px;
        border-radius: 10px;
        background-color: #293b5f;
        text-decoration: none;
        color: white;
    }

    .nut-bam {
        padding: 13px 15px;
        cursor: pointer;
        border: 1px solid gainsboro;
        border-radius: 60px;
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

    .nhom-nut-bam {
        margin-top: 40px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }
</style>

<body>

    <div class="dau-trang">
        <h2>TRANG QUẢN LÍ KHÁCH SẠN</h2>
        <a class="nut-them" href="trangAdmin.php?page_layout=themKhachSan">
            <i class="fa-solid fa-plus"></i> Thêm khách sạn
        </a>
    </div>

    <?php
    

    $sql = "SELECT ks.*, dd.ten_dia_diem, GROUP_CONCAT(ksa.path ORDER BY ksa.id SEPARATOR ',') AS danh_sach_anh
            FROM khach_san ks
            JOIN dia_diem dd ON ks.dia_diem_id = dd.id 
            LEFT JOIN anh_khach_san ksa ON ks.id = ksa.khach_san_id
            GROUP BY ks.id";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $dsAnh = [];
        if (!empty($row['danh_sach_anh'])) {
            $dsAnh = explode(',', $row['danh_sach_anh']);
        }
        $anhChinh = $dsAnh[0] ?? '';
    ?>
        <div class="khung-danh-sach">
            <div class="o-khach-san">

                <div class="vung-hinh-anh">
                    <img src="<?php echo $anhChinh ?>" class="anh-chinh">
                    
                </div>

                <div class="noi-dung-khach-san">
                    <h3><?php echo $row["ten_khach_san"] ?></h3>
                    <p><?php echo $row["mo_ta"] ?></p>
                    <span class="nhan-thong-tin"><?php echo $row["ten_dia_diem"] ?></span>
                    <span class="nhan-thong-tin"><?php echo $row["so_dien_thoai"] ?></span>
                    <span class="nhan-thong-tin"><?php echo $row["email"] ?></span>
                </div>

                <div class="thao-tac-khach-san">
                    <div class="nhom-nut-bam">
                        <a class="nut-bam sua" href="trangAdmin.php?page_layout=capNhatKhachSan&id=<?php echo $row["id"] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a class="nut-bam xoa" href="./khach_san/xoaKhachSan.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa khách sạn này?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

</body>

</html>