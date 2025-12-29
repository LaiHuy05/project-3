<?php
    include "../../includes/connect.php";
    $id=$_GET["id"];
    $sql="DELETE FROM `anh_khach_san` WHERE id='$id'";
    mysqli_query($conn,$sql);
    header("location: ../trangAdmin.php?page_layout=trangAnh");
?>