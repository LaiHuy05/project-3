<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Ảnh</title>
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

        .o-chon-tep {
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
    </style>
</head>

<body>
    <?php
    
    if (isset($_POST['submit'])) {
        if (!empty($_POST['khach-san'])) {
            $khachSan = $_POST['khach-san'];
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File không phải là ảnh.";
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) {
                echo "File này đã tồn tại trên hệ thống";
                $uploadOk = 2;
            }

            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "File quá lớn";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Chỉ những file JPG, JPEG, PNG & GIF mới được chấp nhận.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "File của bạn chưa được tải lên";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO anh_khach_san (`path`,`khach_san_id`) VALUES ('$target_file','$khachSan')";
                    if (mysqli_query($conn, $sql)) {
                        header('Location: trangAdmin.php?page_layout=trangAnh');
                        exit;
                    } else {
                        echo "<p class='warning'>Lỗi SQL: " . mysqli_error($conn) . "</p>";
                    }
                }
            }
        }
    }
    ?>

    <div class="khung-ngoai">
        <div class="noi-dung-trong">
            <form action="trangAdmin.php?page_layout=themAnh" method="POST" enctype="multipart/form-data">
                <h3 class="tieu-de-trang">THÊM ẢNH</h3>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Khách sạn</label>
                    <select name="khach-san" class="o-lua-chon">
                        <?php
                        $sql = "SELECT * FROM khach_san";
                        $result = mysqli_query($conn, $sql);
                        while ($item = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $item['id']; ?>">
                                <?php echo $item['ten_khach_san']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="nhom-nhap-lieu">
                    <label class="nhan-nhap-lieu">Đường dẫn ảnh</label>
                    <input class="o-chon-tep" type="file" name="fileToUpload" />
                </div>

                <div class="nhom-nhap-lieu">
                    <button name="submit" type="submit" class="nut-bam">THÊM MỚI</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
