
<?php
$quota = 30;
$registered = 18;

$isFull = $registered >= $quota;
$hasSeat = $registered < $quota;

$remaining = $quota - $registered;
$percentage = ($registered / $quota) * 100;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logic Test | KursusKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #fff9db, #fff0a6);
            min-height: 100vh;
            color: #292929;
            padding: 30px 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 760px;
        }

        .header {
            background: #202020;
            color: white;
            padding: 25px 30px;
            border-radius: 20px 20px 0 0;
            border-bottom: 5px solid #f5c400;
        }

        .brand {
            color: #ffd42a;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #d5d5d5;
            font-size: 14px;
            line-height: 1.6;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 15px 40px rgba(70, 54, 0, 0.12);
        }

        .section-title {
            font-size: 18px;
            font-weight: 750;
            margin-bottom: 18px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 25px;
        }

        .stat {
            background: #fff9e6;
            border: 1px solid #f5e5a2;
            border-radius: 14px;
            padding: 18px 12px;
        }

        .stat span {
            display: block;
            color: #777;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .stat strong {
            font-size: 25px;
            color: #242424;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .progress-track {
            width: 100%;
            height: 11px;
            background: #eeeeee;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 27px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #f5c400, #ffdf55);
            border-radius: 20px;
        }

        .result-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .result {
            padding: 20px;
            border-radius: 14px;
            border: 1px solid #e6e6e6;
            background: #fafafa;
        }

        .result-label {
            font-size: 13px;
            color: #777;
            margin-bottom: 12px;
        }

        .boolean {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 8px;
            font-family: Consolas, monospace;
            font-size: 17px;
            font-weight: 800;
        }

        .false {
            color: #a33a24;
            background: #ffebe5;
        }

        .true {
            color: #176b43;
            background: #e1f7eb;
        }

        .code-box {
            background: #202020;
            color: #f6f6f6;
            padding: 20px;
            border-radius: 14px;
            margin-bottom: 25px;
            overflow-x: auto;
        }

        .code-box h3 {
            color: #ffd42a;
            font-size: 14px;
            margin-bottom: 12px;
        }

        pre {
            font-family: Consolas, monospace;
            font-size: 14px;
            line-height: 1.9;
            white-space: pre-wrap;
        }

        .explanation {
            background: #fff9e6;
            border-left: 4px solid #f5c400;
            padding: 17px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            text-align: center;
            padding: 13px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 750;
            transition: 0.2s;
        }

        .btn-primary {
            background: #f5c400;
            color: #202020;
        }

        .btn-primary:hover {
            background: #e5b600;
            transform: translateY(-2px);
        }

        .btn-secondary {
            border: 1px solid #dddddd;
            color: #333333;
            background: white;
        }

        .btn-secondary:hover {
            background: #f5f5f5;
        }

        .footer {
            text-align: center;
            color: #777;
            font-size: 12px;
            margin-top: 22px;
        }

        @media (max-width: 560px) {
            .header, .card {
                padding: 22px 18px;
            }

            .header h1 {
                font-size: 23px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .stat {
                padding: 14px;
            }

            .result-grid {
                grid-template-columns: 1fr;
            }

            .actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="container">

        <header class="header">
            <div class="brand">KURSUSKU / DEVELOPER TOOLS</div>
            <h1>Logic Test</h1>
            <p>
                Pengujian logika kuota untuk memeriksa status penuh
                dan ketersediaan tempat kursus.
            </p>
        </header>

        <section class="card">

            <h2 class="section-title">Ringkasan Kuota</h2>

            <div class="stats">
                <div class="stat">
                    <span>Total Kuota</span>
                    <strong><?= $quota ?></strong>
                </div>

                <div class="stat">
                    <span>Peserta Terdaftar</span>
                    <strong><?= $registered ?></strong>
                </div>

                <div class="stat">
                    <span>Sisa Tempat</span>
                    <strong><?= $remaining ?></strong>
                </div>
            </div>

            <div class="progress-info">
                <span>Penggunaan kuota</span>
                <strong><?= number_format($percentage, 0) ?>%</strong>
            </div>

            <div class="progress-track">
                <div class="progress-bar"
                     style="width: <?= $percentage ?>%">
                </div>
            </div>

            <h2 class="section-title">Hasil Pengujian Boolean</h2>

            <div class="result-grid">
                <div class="result">
                    <div class="result-label">
                        <code>$isFull</code> — Apakah kuota penuh?
                    </div>

                    <span class="boolean <?= $isFull ? 'true' : 'false' ?>">
                        <?= $isFull ? 'bool(true)' : 'bool(false)' ?>
                    </span>
                </div>

                <div class="result">
                    <div class="result-label">
                        <code>$hasSeat</code> — Apakah tempat tersedia?
                    </div>

                    <span class="boolean <?= $hasSeat ? 'true' : 'false' ?>">
                        <?= $hasSeat ? 'bool(true)' : 'bool(false)' ?>
                    </span>
                </div>
            </div>

            <div class="code-box">
                <h3>OUTPUT var_dump()</h3>
                <pre><?php var_dump($isFull); var_dump($hasSeat); ?></pre>
            </div>

            <div class="explanation">
                <strong>Kesimpulan pengujian</strong><br>
                Kuota belum penuh karena <?= $registered ?> peserta masih
                di bawah batas <?= $quota ?> peserta.
                Masih tersedia <?= $remaining ?> tempat kursus.
                Karena itu, <code>$isFull</code> bernilai
                <strong>false</strong> dan <code>$hasSeat</code>
                bernilai <strong>true</strong>.
            </div>

            <div class="actions">
                <a href="index.php" class="btn btn-primary">
                    ← Kembali ke Beranda
                </a>

                <a href="logic-test.php" class="btn btn-secondary">
                    Ulangi Pengujian
                </a>
            </div>

        </section>

        <footer class="footer">
            KursusKu &copy; <?= date('Y') ?> · Logic Test
        </footer>

    </main>
</body>
</html>
