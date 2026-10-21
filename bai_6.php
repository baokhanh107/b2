<?php
// Hàm định dạng tiền tệ (ví dụ: 150000 -> 150.000 đ)
function money(float $value): string {
    return number_format($value, 0, ',', '.') . ' đ';
}

$name = "";
$qty = 0;
$price = 0.0;
$total = 0.0;

// Xử lý dữ liệu khi form được submit bằng POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $qty = (int)($_POST['qty'] ?? 0);
    $price = (float)($_POST['price'] ?? 0);
    $total = $qty * $price;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 6: Hóa đơn học liệu</title>

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
            padding: 30px;
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
            margin: 12px 0 6px;
            font-weight: bold;
            font-size: 14px;
            color: #243b53;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #1768ba;
            box-shadow: 0 0 0 3px rgba(23, 104, 186, 0.15);
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

        /* Khung hiển thị kết quả tổng tiền (dùng màu xanh nền #d8eee5 giống Bài 4) */
        .total {
            margin-top: 22px;
            padding: 20px;
            border-radius: 8px;
            background: #d8eee5;
            color: #28664f;
            text-align: center;
        }

        .total h2 {
            margin: 0 0 8px;
            font-size: 18px;
        }

        .score {
            font-size: 26px;
            font-weight: bold;
        }

        .back {
            margin-top: 22px;
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
        <h1>Bài 6: Hóa đơn học liệu</h1>

        <!-- Form nhập liệu -->
        <form method="post" action="">
            <label>Tên tài liệu:</label>
            <input type="text" name="name" placeholder="Nhập tên tài liệu" value="<?= htmlspecialchars($name) ?>" required>

            <label>Số lượng:</label>
            <input type="number" name="qty" min="1" placeholder="Nhập số lượng" value="<?= $qty > 0 ? $qty : '' ?>" required>

            <label>Đơn giá:</label>
            <input type="number" name="price" min="0" step="1000" placeholder="Nhập đơn giá" value="<?= $price > 0 ? $price : '' ?>" required>

            <button type="submit">Tính thành tiền</button>
        </form>

        <!-- Hiển thị kết quả nếu đã submit form -->
        <?php if ($total > 0): ?>
            <div class="total">
                <h2>Kết quả hóa đơn</h2>
                <div class="score">
                    <?= htmlspecialchars($name) ?>: <?= money($total) ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="back">
            Bài thực hành PHP: Định dạng tiền, đọc POST và mã hóa output
        </div>
    </main>

</body>
</html>