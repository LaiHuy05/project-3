<?php
$id = $_GET['id'];

// Xử lý cập nhật trạng thái đơn hàng (giữ nguyên logic cũ của mày)
if (isset($_POST['btn_capnhat'])) {
    $trang_thai_moi = $_POST['trang_thai'];
    $sql_update = "UPDATE don_dat_phong SET trang_thai = '$trang_thai_moi' WHERE id = $id";
    mysqli_query($conn, $sql_update);
    echo "<script>alert('Cập nhật thành công!');</script>";
}

// 1. Lấy thông tin đơn đặt phòng và khách hàng
$sql_don = "SELECT ddp.*, nd.ho_ten FROM don_dat_phong ddp 
            JOIN nguoi_dung nd ON ddp.nguoi_dung_id = nd.id 
            WHERE ddp.id = $id";
$res_don = mysqli_query($conn, $sql_don);
$don = mysqli_fetch_assoc($res_don);

// 2. Lấy thông tin thanh toán (để xem cọc hay full)
$sql_tt = "SELECT * FROM thanh_toan WHERE don_dat_phong_id = $id LIMIT 1";
$res_tt = mysqli_query($conn, $sql_tt);
$thanh_toan = mysqli_fetch_assoc($res_tt);

// 3. Tính tổng số phòng khách đã đặt trong đơn này
$sql_sl = "SELECT SUM(so_luong) as tong_phong FROM chi_tiet_dat_phong WHERE don_dat_phong_id = $id";
$res_sl = mysqli_query($conn, $sql_sl);
$row_sl = mysqli_fetch_assoc($res_sl);
$tong_phong = $row_sl['tong_phong'] ? $row_sl['tong_phong'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #293b5f;
            margin-bottom: 20px;
        }
        .row {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        /* Style riêng cho phần thông tin quan trọng */
        .highlight-info input {
            background-color: #e8f0fe;
            color: #1a73e8;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #293b5f;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            text-align: center;
        }
        .btn {
            background: #293b5f;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 4px;
            font-size: 16px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #1e2b46;
        }
        .btn-back {
            display: block;
            margin-top: 15px;
            text-align: center;
            background: #e0e0e0;
            color: #333;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-back:hover {
            background: #d0d0d0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>CHI TIẾT ĐƠN #<?php echo $id; ?></h2>

    <form method="POST">
        <div class="row">
            <label>Khách hàng:</label>
            <input type="text" value="<?php echo $don['ho_ten']; ?>" disabled>
        </div>

        <div class="row highlight-info">
            <label>Tổng số lượng phòng đã đặt:</label>
            <input type="text" value="<?php echo $tong_phong; ?> phòng" disabled>
        </div>

        <div class="row highlight-info">
            <label>Trạng thái thanh toán:</label>
            <?php 
                $thong_tin_tt = "Chưa có thông tin";
                if ($thanh_toan) {
                    // Hiển thị phương thức và trạng thái (ví dụ: Chuyển khoản - Đã thanh toán)
                    // Nếu trong db lưu "30%" hay gì đó thì nó sẽ hiện ra đây
                    $thong_tin_tt = $thanh_toan['phuong_thuc'] . " - " . $thanh_toan['trang_thai'];
                    
                    // Thêm hiển thị số tiền đã thanh toán cho rõ
                    $thong_tin_tt .= " (" . number_format($thanh_toan['tong_tien'], 0, ',', '.') . " VNĐ)";
                }
            ?>
            <input type="text" value="<?php echo $thong_tin_tt; ?>" disabled>
        </div>

        <div class="row">
            <label>Trạng thái đơn hàng:</label>
            <select name="trang_thai">
                <option value="cho xac nhan" <?php if($don['trang_thai'] == 'cho xac nhan') echo 'selected'; ?>>Chờ xác nhận</option>
                <option value="xac nhan" <?php if($don['trang_thai'] == 'xac nhan') echo 'selected'; ?>>Đã xác nhận</option>
                <option value="huy" <?php if($don['trang_thai'] == 'huy') echo 'selected'; ?>>Hủy bỏ</option>
            </select>
        </div>

        <input type="submit" name="btn_capnhat" value="CẬP NHẬT TRẠNG THÁI" class="btn">
    </form>

    <table>
        <thead>
            <tr>
                <th>Mã phòng</th>
                <th>Giá phòng</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_ct = "SELECT * FROM chi_tiet_dat_phong WHERE don_dat_phong_id = $id";
            $res_ct = mysqli_query($conn, $sql_ct);
            while ($item = mysqli_fetch_array($res_ct)) {
            ?>
            <tr>
                <td><?php echo $item['phong_id']; ?></td>
                <td><?php echo number_format($item['gia_phong'], 0, ',', '.'); ?> đ</td>
                <td><?php echo $item['so_luong']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="trangAdmin.php?page_layout=trangDonDatPhong" class="btn-back">QUAY LẠI DANH SÁCH</a>
</div>

</body>
</html>