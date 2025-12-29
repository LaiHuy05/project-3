<?php
$id = $_GET['id'];

if (isset($_POST['btn_capnhat'])) {
    $trang_thai_moi = $_POST['trang_thai'];
    $sql_update = "UPDATE don_dat_phong SET trang_thai = '$trang_thai_moi' WHERE id = $id";
    mysqli_query($conn, $sql_update);
    echo "<script>alert('Thành công');</script>";
}

$sql_don = "SELECT ddp.*, nd.ho_ten FROM don_dat_phong ddp 
            JOIN nguoi_dung nd ON ddp.nguoi_dung_id = nd.id 
            WHERE ddp.id = $id";
$res_don = mysqli_query($conn, $sql_don);
$don = mysqli_fetch_assoc($res_don);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }
        .container {
            width: 450px;
            margin: auto;
            border: 1px solid ;
            padding: 20px;
            border-radius: 8px;
        }
        .row {
            margin-bottom: 10px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        select, input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .btn {
            background: blue;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 4px;
        }
        .btn-back {
            display: block;
            margin-top: 10px;
            text-align: center;
            background: #e0e0e0;
            color: black;
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
    <h2 style="text-align: center;">CẬP NHẬT ĐƠN #<?php echo $id; ?></h2>

    <form method="POST">
        <div class="row">
            <label>Khách hàng:</label>
            <input type="text" value="<?php echo $don['ho_ten']; ?>" disabled>
        </div>

        <div class="row">
            <label>Trạng thái:</label>
            <select name="trang_thai">
                <option value="cho xac nhan" <?php if($don['trang_thai'] == 'cho xac nhan') echo 'selected'; ?>>Chờ xác nhận</option>
                <option value="xac nhan" <?php if($don['trang_thai'] == 'xac nhan') echo 'selected'; ?>>Xác nhận</option>
                <option value="huy" <?php if($don['trang_thai'] == 'huy') echo 'selected'; ?>>Hủy bỏ</option>
            </select>
        </div>

        <input type="submit" name="btn_capnhat" value="LƯU THAY ĐỔI" class="btn">
    </form>

    <table>
        <thead>
            <tr>
                <th>Mã phòng</th>
                <th>Giá</th>
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
                <td><?php echo $item['gia_phong']; ?></td>
                <td><?php echo $item['so_luong']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="trangAdmin.php?page_layout=trangDonDatPhong" class="btn-back">QUAY LẠI DANH SÁCH</a>
</div>

</body>
</html>