<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách phòng</title>
</head>

<style>
    .khung-danh-sach {
        max-width: 1000px;
        margin: 20px auto 0;
    }

    .o-phong {
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

    .anh-nho {
        width: 45px;
        height: 32px;
        object-fit: cover;
        border-radius: 6px;
    }

    .noi-dung-phong {
        flex: 1;
    }

    .noi-dung-phong h3 {
        margin: 0 0 8px;
        font-size: 18px;
    }

    .nhan-phu {
        display: inline-block;
        padding: 4px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 13px;
        color: #666;
    }

    .trang-thai-moi {
        margin-left: 50px;
        background-color: #e3fcef;
        color: #00875a;
        display: inline-block;
        padding: 4px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 13px;
        margin-top: 55px;
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
        margin-top: 20%;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .gia-phong {
        color: red;
        font-size: large;
    }
</style>

<body>

    <div class="dau-trang">
        <h2>TRANG QUẢN LÍ PHÒNG</h2>
        <a class="nut-them" href="trangAdmin.php?page_layout=themPhong">
            <i class="fa-solid fa-plus"></i> Thêm phòng
        </a>
    </div>

    <?php
    

    $sql = "SELECT p.*, ks.ten_khach_san, GROUP_CONCAT(ksa.path ORDER BY ksa.id SEPARATOR ',') AS danh_sach_anh
            FROM phong p
            JOIN khach_san ks ON p.khach_san_id = ks.id 
            LEFT JOIN anh_khach_san ksa ON ks.id = ksa.khach_san_id
            GROUP BY p.id";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $dsAnh = [];
        if (!empty($row['danh_sach_anh'])) {
            $dsAnh = explode(',', $row['danh_sach_anh']);
        }
        $anhChinh = $dsAnh[0] ?? '';
    ?>
        <div class="khung-danh-sach">
            <div class="o-phong">

                <div class="vung-hinh-anh">
                    <img src="<?php echo $anhChinh ?>" class="anh-chinh">
                    
                </div>

                <div class="noi-dung-phong">
                    <h3>Phòng <?php echo $row["so_phong"] ?></h3>
                    <span class="nhan-phu"><?php echo $row["ten_khach_san"] ?></span>
                    <span class="nhan-phu"><?php echo $row["loai_phong"] ?></span>
                    <div class="trang-thai-moi">Trạng thái: <?php echo $row["trang_thai"] ?></div>
                </div>

                <div class="thao-tac-phong">
                    <span class="gia-phong"><?php echo number_format($row["gia_phong"], 0, ',', '.') ?> VND</span>
                    <div class="nhom-nut-bam">
                        <a class="nut-bam sua" href="trangAdmin.php?page_layout=capNhatPhong&id=<?php echo $row["id"] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a class="nut-bam xoa" href="./phong/xoaPhong.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Xóa phòng này?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

</body>

</html>