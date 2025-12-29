<?php
    include "../../includes/connect.php";
    $id=$_GET["id"];
    $sql="DELETE FROM `khach_san` WHERE id='$id'";
    mysqli_query($conn,$sql);
    header("location: ../trangAdmin.php?page_layout=trangKhachSan");
?>