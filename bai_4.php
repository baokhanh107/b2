
<?php
// Hàm tính điểm tổng kết
function finalScore(float $cc, float $mid, float $final): float
{
    return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
}

// Điểm ví dụ của sinh viên
$cc = 8;
$mid = 7;
$final = 9;

// Gọi hàm để tính điểm tổng kết
$total = finalScore($cc, $mid, $final);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4: Hàm Tính Điểm</title>

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
            max-width: 650px;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(31, 68, 110, 0.14);
        }

        h1 {
            text-align: center;
            color: #243b53;
            font-size: 30px;
            padding-bottom: 16px;
            border-bottom: 2px solid #dce7f2;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 17px;
        }

        .value {
            font-weight: bold;
            color: #1768ba;
        }

        .total {
            margin-top: 22px;
            padding: 20px;
            border-radius: 8px;
            background: #287bd1;
            color: #f9fcff;
            text-align: center;
        }

        .total h2 {
            margin: 0 0 8px;
            font-size: 20px;
        }

        .score {
            font-size: 32px;
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
        <h1>Bài 4: Hàm Tính Điểm Tổng Kết</h1>

        <div class="item">
            <span>Điểm chuyên cần (10%)</span>
            <span class="value"><?php echo $cc; ?></span>
        </div>

        <div class="item">
            <span>Điểm giữa kỳ (30%)</span>
            <span class="value"><?php echo $mid; ?></span>
        </div>

        <div class="item">
            <span>Điểm cuối kỳ (60%)</span>
            <span class="value"><?php echo $final; ?></span>
        </div>

        <div class="total">
            <h2>Điểm tổng kết</h2>
            <div class="score">
                <?php echo number_format($total, 2); ?>
            </div>
        </div>

        <div class="back">
            Bài thực hành PHP: Xây dựng và sử dụng hàm
        </div>
    </main>
</body>
</html>
