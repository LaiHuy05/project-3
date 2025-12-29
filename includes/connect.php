<?php
    $conn = mysqli_connect("Localhost" , "root" ,"" ,"quan_ly_khach_san");
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error($conn));
    }

?>