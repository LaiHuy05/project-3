<style>
    .vung-the {
        padding: 20px 30px;
    }

    .bang-dieu-khien {
        display: flex;
        gap: 1.5rem;
    }

    .the-thong-ke {
        background-color: #f5f5f5;
        padding: 20px 25px;
        color: #000;
        border-radius: 5px;
        transition: .4s;
        cursor: pointer;
        width: 320px;
    }

    .ten-the {
        text-align: center;
        margin: 10px 0;
        font-size: 25px;
    }

    .thong-so {
        font-weight: 400;
        font-size: 25px;
        margin: 5px 0 10px 0;
        display: flex;
        justify-content: flex-end;
    }

    .the-thong-ke:hover {
        background-color: #293b5f;
        color: #FFF;
        transform: translateY(-5px);
    }

    .van-ban {
        font-size: 15px;
        border-radius: 5px;
    }

    .tieu-de-trang {
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }

    .hinh-anh-tong-quan {
        text-align: center;
    }

    .hinh-anh-cuoi {
        margin-top: 7px;
    }
</style>

<div class="tieu-de-trang">
    <h2>TRANG QUẢN LÍ ĐƠN ĐẶT PHÒNG</h2>
</div>

<div class="vung-the">
    <div class="bang-dieu-khien">

        <div class="the-thong-ke">
            <?php
            
            $sqlKH = "SELECT COUNT(*) AS so_khach_hang FROM nguoi_dung WHERE vai_tro = 'khach hang'";
            $resultKH = mysqli_query($conn, $sqlKH);
            $rowKH = mysqli_fetch_assoc($resultKH);
            ?>
            <h6 class="thong-so"><?php echo $rowKH["so_khach_hang"] ?? 0 ?></h6>
            <div class="hinh-anh-tong-quan">
                <img src="./img/khach_hang.png" alt="" width="50%">
            </div>
            <h6 class="ten-the">Khách hàng</h6>
            <div class="the-nhan">
                <span class="van-ban">Khách hàng là những người sử dụng dịch vụ đặt phòng khách sạn thông qua hệ thống. Họ có thể tìm kiếm, lựa chọn phòng phù hợp, thực hiện đặt phòng và thanh toán trực tuyến một cách nhanh chóng, tiện lợi.</span>
            </div>
        </div>

        <div class="the-thong-ke">
            <?php
            $sqlKS = "SELECT COUNT(*) AS so_khach_san FROM khach_san";
            $resultKS = mysqli_query($conn, $sqlKS);
            $rowKS = mysqli_fetch_assoc($resultKS);
            ?>
            <h6 class="thong-so"><?php echo $rowKS["so_khach_san"] ?? 0 ?></h6>
            <div class="hinh-anh-tong-quan">
                <img src="./img/khach_san.png" alt="" width="52%">
            </div>
            <h6 class="ten-the">Khách sạn</h6>
            <div class="the-nhan">
                <span class="van-ban">Khách sạn là các cơ sở lưu trú được quản lý trong hệ thống, cung cấp nhiều loại phòng và dịch vụ khác nhau nhằm đáp ứng nhu cầu nghỉ dưỡng, công tác và du lịch của khách hàng.</span>
            </div>
        </div>

        <div class="the-thong-ke">
            <?php
            $sqlDoanhThu = "SELECT SUM(tong_tien) AS doanh_thu FROM thanh_toan WHERE trang_thai = 'da thanh toan'";
            $resultDoanhThu = mysqli_query($conn, $sqlDoanhThu);
            $rowDoanhThu = mysqli_fetch_assoc($resultDoanhThu);
            ?>
            <h6 class="thong-so"><?php echo number_format($rowDoanhThu["doanh_thu"] ?? 0, 0, ',', '.') ?> VND</h6>
            <div class="hinh-anh-tong-quan">
                <img class="hinh-anh-cuoi" src="./img/doanh_thu.png" alt="" width="55%">
            </div>
            <h6 class="ten-the">Doanh thu</h6>
            <div class="the-nhan">
                <span class="van-ban">Doanh thu là tổng số tiền khách sạn thu được từ các đơn đặt phòng đã thanh toán, phản ánh hiệu quả kinh doanh và mức độ sử dụng dịch vụ của khách hàng trong từng thời kỳ.</span>
            </div>
        </div>

    </div>
</div>