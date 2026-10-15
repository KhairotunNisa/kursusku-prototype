
<?php
$READ = 1;
$WRITE = 2;
$DELETE = 4;

$permission = $READ | $WRITE;

$canRead = ($permission & $READ) === $READ;
$canWrite = ($permission & $WRITE) === $WRITE;
$canDelete = ($permission & $DELETE) === $DELETE;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KursusKu - Bitwise Permission Test</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #FFF8E1, #FFE082);
            color: #4E4035;
            min-height: 100vh;
            padding: 30px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .utility-card {
            width: 100%;
            max-width: 760px;
            background: #FFFFFF;
            border-radius: 22px;
            border-top: 8px solid #FFB300;
            padding: 32px;
            box-shadow: 0 12px 35px rgba(93, 64, 55, 0.13);
        }

        .brand {
            color: #EF6C00;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        h1 {
            color: #5D4037;
            font-size: clamp(25px, 4vw, 34px);
            margin-bottom: 10px;
        }

        .description {
            color: #817466;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .permission-summary {
            background: #FFF8E1;
            border: 1px solid #FFE082;
            padding: 18px 20px;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .summary-label {
            color: #8D8175;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .summary-value {
            color: #8D5A00;
            font-size: 24px;
            font-weight: bold;
        }

        .section-title {
            font-size: 18px;
            color: #5D4037;
            margin-bottom: 15px;
        }

        .permission-list {
            display: grid;
            gap: 12px;
            margin-bottom: 25px;
        }

        .permission-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px;
            background: #FFFCF2;
            border: 1px solid #F3E5AB;
            border-radius: 12px;
        }

        .permission-name {
            color: #5D4037;
            font-weight: bold;
            font-size: 15px;
        }

        .permission-detail {
            color: #8D8175;
            font-size: 12px;
            margin-top: 5px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .allowed {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .denied {
            background: #FDECEA;
            color: #C62828;
        }

        .output-box {
            background: #3E342D;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 25px;
            overflow-x: auto;
        }

        .output-label {
            color: #FFE082;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        pre {
            color: #FFFFFF;
            font-family: Consolas, monospace;
            font-size: 15px;
            line-height: 1.9;
            white-space: pre-wrap;
        }

        .explanation {
            background: #FFF8E1;
            border-left: 5px solid #FFB300;
            padding: 16px;
            border-radius: 8px;
            color: #6D5A43;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .back-button {
            display: inline-block;
            background: #FFCA28;
            color: #4E342E;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            padding: 13px 22px;
            border-radius: 10px;
            transition: 0.2s ease;
        }

        .back-button:hover {
            background: #EF6C00;
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            color: #9A8D7E;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 480px) {
            .utility-card {
                padding: 23px 17px;
            }

            .permission-item {
                padding: 14px;
            }

            .summary-value {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

<main class="utility-card">

    <div class="brand">KURSUSKU</div>

    <h1>Bitwise Permission Test</h1>

    <p class="description">
        Halaman pengujian operator bitwise PHP untuk memeriksa
        hak akses membaca, menulis, dan menghapus.
    </p>

    <section class="permission-summary">
        <div class="summary-label">NILAI PERMISSION</div>
        <div class="summary-value">
            <?= $permission ?>
        </div>
    </section>

    <h2 class="section-title">🔐 Status Hak Akses</h2>

    <section class="permission-list">

        <div class="permission-item">
            <div>
                <div class="permission-name">READ</div>
                <div class="permission-detail">Izin membaca data · Nilai 1</div>
            </div>

            <span class="status <?= $canRead ? 'allowed' : 'denied' ?>">
                <?= $canRead ? '✓ Diizinkan' : '✕ Ditolak' ?>
            </span>
        </div>

        <div class="permission-item">
            <div>
                <div class="permission-name">WRITE</div>
                <div class="permission-detail">Izin menulis data · Nilai 2</div>
            </div>

            <span class="status <?= $canWrite ? 'allowed' : 'denied' ?>">
                <?= $canWrite ? '✓ Diizinkan' : '✕ Ditolak' ?>
            </span>
        </div>

        <div class="permission-item">
            <div>
                <div class="permission-name">DELETE</div>
                <div class="permission-detail">Izin menghapus data · Nilai 4</div>
            </div>

            <span class="status <?= $canDelete ? 'allowed' : 'denied' ?>">
                <?= $canDelete ? '✓ Diizinkan' : '✕ Ditolak' ?>
            </span>
        </div>

    </section>

    <h2 class="section-title">💻 Hasil Output PHP</h2>

    <div class="output-box">
        <div class="output-label">VAR_DUMP RESULT</div>
        <pre><?php var_dump($canRead, $canWrite, $canDelete); ?></pre>
    </div>

    <div class="explanation">
        <strong>Kesimpulan:</strong>
        READ dan WRITE diizinkan karena kedua flag digabungkan.
        DELETE ditolak karena flag DELETE tidak disertakan dalam
        nilai <code>$permission</code>.
    </div>

    <a href="index.php" class="back-button">
        ← Kembali ke Beranda
    </a>

    <div class="footer">
        &copy; 2026 KursusKu · Bitwise Permission Test
    </div>

</main>

</body>
</html>
