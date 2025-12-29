<?php


$id = $_GET["id"];

$sql = "SELECT * FROM anh_khach_san WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$khachSan = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    if (!empty($_POST['khach-san'])) {
        $tenKhachSan = $_POST['khach-san'];

        $target_dir = "img/";
        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $posterUpdate = ""; 

        if (!empty($file_name)) {
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check === false) {
                echo "<p class='canh-bao'>File không phải là ảnh.</p>";
                exit;
            }

            if ($_FILES["fileToUpload"]["size"] > 2000000) {
                echo "<p class='canh-bao'>File quá lớn!</p>";
                exit;
            }

            if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif", "webp"])) {
                echo "<p class='canh-bao'>Chỉ cho phép JPG, JPEG, PNG, GIF.</p>";
                exit;
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $posterUpdate = ", path = '$target_file'";
            } else {
                echo "Lỗi: Không thể upload file.";
                exit;
            }
        }

        $sql_update = "UPDATE anh_khach_san SET 
                           khach_san_id = '$tenKhachSan'
                           $posterUpdate
                           WHERE id = '$id'";

        if (mysqli_query($conn, $sql_update)) {
            header('Location: trangAdmin.php?page_layout=trangAnh');
            exit;
        } else {
            echo "<p class='canh-bao'>Lỗi SQL: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p class='canh-bao'>Vui lòng chọn khách sạn!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Ảnh</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .khung-ngoai {
            width: 60%;
            background-color: #f9fbfd;
            margin: 40px auto;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .noi-dung-trong {
            padding: 7%;
        }

        .tieu-de-trang {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .nhom-nhap-lieu {
            margin-bottom: 18px;
        }

        .nhan-nhap-lieu {
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
            display: block;
        }

        .o-lua-chon,
        .nut-bam {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .o-lua-chon {
            background-color: #fff;
        }

        .o-nhap-tep {
            margin-bottom: 20px;
            font-size: 15px;
        }

        .nut-bam {
            background-color: #293b5f;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .nut-bam:hover {
            background-color: #1f2a44;
        }

        .canh-bao {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=capNhatAnh&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <h3 class="tieu-de-trang">CẬP NHẬT ẢNH</h3>

                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Khách sạn</p>
                    <select name="khach-san" class="o-lua-chon">
                        <?php
                        $khach_san = mysqli_query($conn, "SELECT * FROM khach_san");
                        while ($row = mysqli_fetch_assoc($khach_san)) {
                            $selected = ($row['id'] == $khachSan['khach_san_id']) ? "selected" : "";
                            echo "<option value='{$row['id']}' $selected>{$row['ten_khach_san']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="nhom-nhap-lieu">
                    <p class="nhan-nhap-lieu">Đường dẫn ảnh</p>
                    <input class="o-nhap-tep" type="file" name="fileToUpload" />
                    <br>
                    <img src="<?php echo $khachSan['path']; ?>" width="150px" style="border-radius: 4px; border: 1px solid #ddd; margin-top: 10px;" />
                </div>

                <div class="nhom-nhap-lieu">
                    <button name="submit" type="submit" class="nut-bam">CẬP NHẬT</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>