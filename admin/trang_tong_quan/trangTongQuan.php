<?php
// 1. Tạo mảng 12 tháng mặc định bằng 0
$doanhThuThang = array_fill(1, 12, 0);

// 2. Lấy năm hiện tại
$year = date('Y');

// 3. Truy vấn: JOIN bảng thanh_toan với don_dat_phong để lấy ngày nhận phòng làm mốc thời gian
$sqlChart = "SELECT MONTH(d.ngay_nhan) as thang, SUM(t.tong_tien) as tong_tien 
             FROM thanh_toan t
             JOIN don_dat_phong d ON t.don_dat_phong_id = d.id
             WHERE YEAR(d.ngay_nhan) = $year 
             AND t.trang_thai = 'da thanh toan' 
             GROUP BY MONTH(d.ngay_nhan)";

$resultChart = mysqli_query($conn, $sqlChart);

if ($resultChart) {
    while ($row = mysqli_fetch_assoc($resultChart)) {
        $doanhThuThang[$row['thang']] = $row['tong_tien'];
    }
}

// 4. Ép dữ liệu sang JSON để ném vào JavaScript
$dataChartJS = json_encode(array_values($doanhThuThang));
?>

<style>
    /* Khung chứa bảng khách hàng ẩn/hiện */
    #khungKhachHang, #khungPhong {
        display: none; 
        width: 90%; 
        margin: 30px auto; 
        background: #fff; 
        padding: 20px; 
        border-radius: 8px; 
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .bang-mini {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .bang-mini th, .bang-mini td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .bang-mini thead {
        background-color: #293b5f;
        color: white;
    }

    .vung-the { padding: 20px 30px; }
    .bang-dieu-khien { display: flex; gap: 1.5rem; }

    .the-thong-ke {
        background-color: #f5f5f5;
        padding: 20px 25px;
        color: #000;
        border-radius: 5px;
        transition: .4s;
        cursor: pointer;
        width: 320px;
    }

    .ten-the { text-align: center; margin: 10px 0; font-size: 25px; }
    .thong-so { font-weight: 400; font-size: 25px; margin: 5px 0 10px 0; display: flex; justify-content: flex-end; }
    .the-thong-ke:hover { background-color: #293b5f; color: #FFF; transform: translateY(-5px); }
    .van-ban { font-size: 15px; border-radius: 5px; }
    .tieu-de-trang { width: 100%; text-align: center; }
    .hinh-anh-tong-quan { text-align: center; }
    .hinh-anh-cuoi { margin-top: 7px; }
</style>

<div class="tieu-de-trang">
    <h2>TRANG TỔNG QUAN QUẢN LÝ</h2>
</div>

<div class="vung-the">
    <div class="bang-dieu-khien">
        <div class="the-thong-ke" id="theKhachHang" onclick="batTatKhachHang()" title="Bấm để xem danh sách khách hàng">
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
                <span class="van-ban">Bấm vào đây để xem danh sách chi tiết tất cả khách hàng đang hoạt động.</span>
            </div>
        </div>

        <div class="the-thong-ke" onclick="batTatPhong()" title="Bấm để xem danh sách phòng">
            <?php
            // Đếm số lượng phòng
            $sqlP = "SELECT COUNT(*) AS so_phong FROM phong";
            $resultP = mysqli_query($conn, $sqlP);
            $rowP = mysqli_fetch_assoc($resultP);
            ?>
            <h6 class="thong-so"><?php echo $rowP["so_phong"] ?? 0 ?></h6>
            <div class="hinh-anh-tong-quan">
                <img src="./img/anh4.png" alt="" width="52%">
            </div>
            <h6 class="ten-the">Số phòng</h6>
            <div class="the-nhan">
                <span class="van-ban">Tổng số lượng phòng đang được quản lý trên hệ thống, bao gồm nhiều hạng phòng và các trạng thái khác nhau.</span>
            </div>
        </div>

        <div class="the-thong-ke" id="theDoanhThu" onclick="batTatBieuDo()" title="Bấm để xem biểu đồ chi tiết">
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
                <span class="van-ban">Bấm vào để xem biểu đồ tăng trưởng doanh thu chi tiết theo từng tháng trong năm.</span>
            </div>
        </div>
    </div>
</div>

<div id="khungBieuDo" style="display: none; width: 80%; margin: 30px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0;">Biểu Đồ Doanh Thu Năm <?php echo $year; ?></h3>
        <button onclick="batTatBieuDo()" style="background: #ff4d4d; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">Đóng</button>
    </div>
    <canvas id="myChart"></canvas>
</div>

<div id="khungKhachHang">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0;">DANH SÁCH KHÁCH HÀNG</h3>
        <button onclick="batTatKhachHang()" style="background: #ff4d4d; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">Đóng</button>
    </div>
    <table class="bang-mini">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sqlListKH = "SELECT * FROM nguoi_dung WHERE vai_tro = 'khach hang'";
            $resListKH = mysqli_query($conn, $sqlListKH);
            $stt = 1;
            while($row = mysqli_fetch_assoc($resListKH)){
            ?>
            <tr>
                <td><?php echo $stt++; ?></td>
                <td><?php echo $row['ten_dang_nhap']; ?></td>
                <td><?php echo $row['ho_ten']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['so_dien_thoai']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="khungPhong">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0;">DANH SÁCH PHÒNG</h3>
        <button onclick="batTatPhong()" style="background: #ff4d4d; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">Đóng</button>
    </div>
    <table class="bang-mini">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Phòng</th>
                <th>Giá Phòng</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sqlListP = "SELECT * FROM phong "; 
            $resListP = mysqli_query($conn, $sqlListP);
            $sttP = 1;
            while($rowP = mysqli_fetch_assoc($resListP)){
            ?>
            <tr>
                <td><?php echo $sttP++; ?></td>
                <td><?php echo $rowP['so_phong']; ?></td>
                <td><?php echo number_format($rowP['gia_phong'], 0, ',', '.'); ?> đ</td>
                <td><?php echo $rowP['trang_thai']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function batTatBieuDo() {
        var khung = document.getElementById("khungBieuDo");
        document.getElementById("khungKhachHang").style.display = "none";
        document.getElementById("khungPhong").style.display = "none";
        if (khung.style.display === "none") {
            khung.style.display = "block";
            khung.scrollIntoView({behavior: "smooth"});
        } else {
            khung.style.display = "none";
        }
    }

    function batTatKhachHang() {
        var khung = document.getElementById("khungKhachHang");
        document.getElementById("khungBieuDo").style.display = "none";
        document.getElementById("khungPhong").style.display = "none";
        if (khung.style.display === "none" || khung.style.display === "") {
            khung.style.display = "block";
            khung.scrollIntoView({behavior: "smooth"});
        } else {
            khung.style.display = "none";
        }
    }

    function batTatPhong() {
        var khung = document.getElementById("khungPhong");
        document.getElementById("khungBieuDo").style.display = "none";
        document.getElementById("khungKhachHang").style.display = "none";
        if (khung.style.display === "none" || khung.style.display === "") {
            khung.style.display = "block";
            khung.scrollIntoView({behavior: "smooth"});
        } else {
            khung.style.display = "none";
        }
    }

    // Vẽ biểu đồ
    const dataDoanhThu = <?php echo $dataChartJS; ?>; 
    const ctx = document.getElementById('myChart');
    let myChartStatus = Chart.getChart("myChart"); 
    if (myChartStatus != undefined) { myChartStatus.destroy(); }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Tổng Tiền (VND)',
                data: dataDoanhThu,
                backgroundColor: 'rgba(41, 59, 95, 0.7)',
                borderColor: 'rgba(41, 59, 95, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return value.toLocaleString('vi-VN') + ' đ'; }
                    }
                }
            }
        }
    });
</script>