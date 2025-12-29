<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách ảnh khách sạn</title>
</head>

<style>
    .khung-danh-sach {
        max-width: 1000px;
        margin: 20px auto 0;
    }

    .o-anh-muc {
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

    .noi-dung-anh {
        flex: 1;
    }

    .noi-dung-anh h3 {
        margin: 0;
        font-size: 18px;
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
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 40px;
    }
</style>

<body>

    <div class="dau-trang">
        <h2>TRANG QUẢN LÍ ẢNH</h2>
        <a class="nut-them" href="trangAdmin.php?page_layout=themAnh">
            <i class="fa-solid fa-plus"></i> Thêm ảnh
        </a>
    </div>

    <?php
    

    $sql = "SELECT a.*, ks.ten_khach_san 
            FROM anh_khach_san a 
            JOIN khach_san ks ON a.khach_san_id = ks.id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="khung-danh-sach">
            <div class="o-anh-muc">

                <div class="vung-hinh-anh">
                    <img src="<?php echo $row["path"] ?>" class="anh-chinh">
                </div>

                <div class="noi-dung-anh">
                    <h3><?php echo $row["ten_khach_san"] ?></h3>
                </div>

                <div class="thao-tac-anh">
                    <div class="nhom-nut-bam">
                        <a class="nut-bam sua" href="trangAdmin.php?page_layout=capNhatAnh&id=<?php echo $row["id"] ?>">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a class="nut-bam xoa" href="./quan_li_anh/xoaAnh.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Bạn có chắc muốn xóa ảnh này?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

</body>

</html>