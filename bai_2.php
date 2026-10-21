
<?php
$diem = "";
$thongBao = "";
$xepLoai = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diem = trim($_POST["diem"] ?? "");

    // Kiểm tra dữ liệu đầu vào
    if ($diem === "" || !is_numeric($diem)
        || $diem < 0 || $diem > 10) {
        $thongBao = "Điểm không hợp lệ! Hãy nhập điểm từ 0 đến 10.";
    } else {
        // Xếp loại từ cao xuống thấp
        if ($diem >= 8) {
            $xepLoai = "Giỏi";
        } elseif ($diem >= 6.5) {
            $xepLoai = "Khá";
        } elseif ($diem >= 5) {
            $xepLoai = "Trung bình";
        } else {
            $xepLoai = "Chưa đạt";
        }

        $thongBao = "Điểm " . $diem
                  . " được xếp loại: " . $xepLoai;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2: Xếp Loại Điểm</title>

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
            padding: 20px;
            color: #263445;
        }

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

        .container {
            width: 100%;
            max-width: 700px;
            background: white;
            padding: 28px 30px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(31, 68, 110, 0.14);
        }

        h1 {
            margin: 0 0 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid #dce7f2;
            text-align: center;
            color: #243b53;
            font-size: 34px;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-size: 18px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 16px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 18px;
        }

        button {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 7px;
            background: #287bd1;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1768ba;
        }

        .result {
            margin-top: 18px;
            padding: 16px;
            border-radius: 7px;
            text-align: center;
            font-size: 17px;
            line-height: 1.5;
        }

        .success {
            background: #d8eee5;
            color: #28664f;
        }

        .error {
            background: #fde2e2;
            color: #a12626;
        }

        .back {
            margin-top: 22px;
            text-align: center;
            color: #64748b;
            font-size: 15px;
        }

        @media (max-width: 600px) {
            .menu-bai {
                top: 10px;
                left: 10px;
                gap: 10px;
            }

            .menu-bai a {
                font-size: 13px;
            }

            .container {
                padding: 22px 18px;
                margin-top: 35px;
            }

            h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>
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
        <h1>Bài 2: Xếp Loại Điểm</h1>

        <form method="post">
            <label for="diem">
                Nhập điểm của bạn (từ 0 đến 10):
            </label>

            <input
                type="number"
                id="diem"
                name="diem"
                min="0"
                max="10"
                step="any"
                placeholder="Ví dụ: 7.5"
                value="<?php echo htmlspecialchars($diem, ENT_QUOTES, 'UTF-8'); ?>"
                required
            >

            <button type="submit">Kiểm Tra Xếp Loại</button>
        </form>

        <?php if ($thongBao !== ""): ?>
            <div class="result <?php echo ($xepLoai !== "") ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($thongBao, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <div class="back">
            Bài thực hành PHP: Điều kiện và vòng lặp
        </div>
    </main>
</body>
</html>
