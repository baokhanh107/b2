<?php
$thongBao = "";
$loaiThongBao = "";
$uploadedFileUrl = "";

// Xử lý khi form được submit qua POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiểm tra xem người dùng đã chọn file hay chưa và có lỗi upload không
    if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["avatar"]["tmp_name"];
        $fileName = $_FILES["avatar"]["name"];
        $fileSize = $_FILES["avatar"]["size"];
        
        // Lấy phần mở rộng của file và chuyển về chữ thường
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Các định dạng ảnh cho phép
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        
        // 1. Kiểm tra định dạng/phần mở rộng file
        if (!in_array($fileExtension, $allowedExtensions)) {
            $thongBao = "Lỗi: Chỉ cho phép upload các định dạng ảnh (jpg, jpeg, png, gif)!";
            $loaiThongBao = "loi";
        } 
        // 2. Kiểm tra kích thước file (Tối đa 2MB = 2 * 1024 * 1024 bytes)
        elseif ($fileSize > 2 * 1024 * 1024) {
            $thongBao = "Lỗi: Kích thước file quá lớn! Dung lượng tối đa cho phép là 2MB.";
            $loaiThongBao = "loi";
        } 
        else {
            // Thư mục lưu trữ file upload
            $uploadFileDir = "./uploads/";
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            
            // 3. Đổi tên file mới an toàn để tránh trùng lặp và ghi đè
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;
            
            // Di chuyển file từ thư mục tạm sang thư mục đích
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $thongBao = "Upload ảnh đại diện thành công!";
                $loaiThongBao = "thanhcong";
                $uploadedFileUrl = $dest_path;
            } else {
                $thongBao = "Lỗi: Không thể lưu file tải lên.";
                $loaiThongBao = "loi";
            }
        }
    } else {
        $thongBao = "Vui lòng chọn một file ảnh hợp lệ để upload!";
        $loaiThongBao = "loi";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 8: Upload file an toàn</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eaf4ff, #dceeff);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 80px 20px 30px;
            color: #263445;
        }

        /* Menu điều hướng cố định góc trên bên trái */
        .menu-bai {
            position: fixed;
            top: 20px;
            left: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            z-index: 1000;
        }

        .menu-bai a {
            color: #1768ba;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
        }

        .menu-bai a:hover {
            text-decoration: underline;
        }

        /* Khung nội dung chính */
        .container {
            width: 100%;
            max-width: 650px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(31, 68, 110, 0.14);
        }

        h1 {
            text-align: center;
            color: #243b53;
            font-size: 26px;
            padding-bottom: 16px;
            margin-top: 0;
            border-bottom: 2px solid #dce7f2;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: bold;
            font-size: 14px;
            color: #243b53;
        }

        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            background: #f8fafc;
        }

        button {
            margin-top: 18px;
            width: 100%;
            padding: 12px 20px;
            background: #1768ba;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #125192;
        }

        /* Thông báo */
        .thongbao {
            margin-top: 20px;
            padding: 14px;
            border-radius: 8px;
            background: #d8eee5;
            color: #28664f;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        .loi {
            background: #fde8e8;
            color: #9b2c2c;
        }

        /* Khu vực hiển thị kết quả ảnh upload */
        .preview-box {
            margin-top: 20px;
            text-align: center;
            padding: 15px;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            background: #f8fafc;
        }

        .preview-box img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .back {
            margin-top: 25px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Menu điều hướng -->
    <nav class="menu-bai">
        <a href="index.php">Bài 1</a>
        <a href="Bai_2.php">Bài 2</a>
        <a href="Bai_3.php">Bài 3</a>
        <a href="Bai_4.php">Bài 4</a>
        <a href="Bai_5.php">Bài 5</a>
        <a href="Bai_6.php">Bài 6</a>
        <a href="Bai_7.php">Bài 7</a>
        <a href="Bai_8.php">Bài 8</a>
        <a href="Bai_9.php">Bài 9</a>
        <a href="Bai_10.php">Bài 10</a>
    </nav>

    <main class="container">
        <h1>Bài 8: Upload file an toàn</h1>

        <!-- Form upload file với enctype bắt buộc -->
        <form method="post" action="" enctype="multipart/form-data">
            <label>Chọn ảnh đại diện (JPG, PNG, GIF - Tối đa 2MB):</label>
            <input type="file" name="avatar" required>
            <button type="submit">Tải lên file</button>
        </form>

        <!-- Hiển thị thông báo trạng thái -->
        <?php if ($thongBao !== ""): ?>
            <div class="thongbao <?= $loaiThongBao === 'loi' ? 'loi' : '' ?>">
                <?= htmlspecialchars($thongBao) ?>
            </div>
        <?php endif; ?>

        <!-- Hiển thị ảnh đã upload thành công -->
        <?php if ($uploadedFileUrl !== ""): ?>
            <div class="preview-box">
                <p style="margin: 0; font-weight: bold; color: #28664f;">Xem trước ảnh đại diện đã tải lên:</p>
                <img src="<?= htmlspecialchars($uploadedFileUrl) ?>" alt="Avatar Preview">
            </div>
        <?php endif; ?>

        <div class="back">
            Bài thực hành PHP: Xây dựng tính năng Upload File an toàn và bảo mật
        </div>
    </main>

</body>
</html>