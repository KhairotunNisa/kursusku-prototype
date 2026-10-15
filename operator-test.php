
<?php
$fee = 350000;
$participants = 2;
$subtotal = $fee * $participants;

$comparisonPositive = $fee > 0;
$comparisonStrict = $fee === 350000;

$message = 'Biaya: Rp ' . $fee;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Test | KursusKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #fff9df, #ffed99);
            color: #292929;
            min-height: 100vh;
            padding: 30px 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 850px;
        }

        .header {
            background: #202020;
            color: white;
            padding: 28px 32px;
            border-radius: 20px 20px 0 0;
            border-bottom: 5px solid #f5c400;
        }

        .brand {
            color: #ffd42a;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .header h1 {
            font-size: 29px;
            margin-bottom: 9px;
        }

        .header p {
            color: #d6d6d6;
            line-height: 1.7;
            font-size: 14px;
        }

        .content {
            background: white;
            padding: 30px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 15px 40px rgba(75, 58, 0, 0.12);
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 18px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #fff9e7;
            border: 1px solid #f3e3a1;
            padding: 20px 16px;
            border-radius: 15px;
        }

        .stat-label {
            color: #777;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .stat-note {
            color: #777;
            font-size: 12px;
            margin-top: 7px;
        }

        .results {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 28px;
        }

        .result-card {
            border: 1px solid #e8e8e8;
            border-radius: 15px;
            padding: 20px;
            background: #fff;
        }

        .result-heading {
            font-size: 14px;
            font-weight: 750;
            margin-bottom: 12px;
        }

        .result-description {
            font-size: 13px;
            color: #777;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .result-value {
            display: inline-block;
            background: #e5f8ec;
            color: #176b43;
            padding: 8px 13px;
            border-radius: 9px;
            font-family: Consolas, monospace;
            font-size: 15px;
            font-weight: 800;
        }

        .output-box {
            background: #202020;
            color: #f4f4f4;
            border-radius: 15px;
            padding: 22px;
            margin-bottom: 25px;
        }

        .output-title {
            color: #ffd42a;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .output-list {
            list-style: none;
        }

        .output-list li {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid #414141;
            font-size: 14px;
        }

        .output-list li:last-child {
            border-bottom: none;
        }

        .output-label {
            color: #cfcfcf;
        }

        .output-value {
            color: #ffdf55;
            font-weight: 750;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .explanation {
            background: #fff9e7;
            border-left: 4px solid #f5c400;
            border-radius: 9px;
            padding: 18px;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .explanation strong {
            display: block;
            margin-bottom: 5px;
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
            padding: 13px 19px;
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
            border: 1px solid #ddd;
            color: #333;
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

        @media (max-width: 600px) {
            .header,
            .content {
                padding: 22px 18px;
            }

            .header h1 {
                font-size: 24px;
            }

            .stats,
            .results {
                grid-template-columns: 1fr;
            }

            .output-list li {
                flex-direction: column;
                gap: 6px;
            }

            .output-value {
                text-align: left;
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
            <h1>Operator PHP</h1>
            <p>
                Pengujian operator aritmatika, perbandingan,
                strict comparison, dan penggabungan string.
            </p>
        </header>

        <section class="content">

            <h2 class="section-title">Ringkasan Perhitungan</h2>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-label">Biaya per Peserta</div>
                    <div class="stat-value">
                        Rp <?= number_format($fee, 0, ',', '.') ?>
                    </div>
                    <div class="stat-note">Nilai variabel $fee</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Jumlah Peserta</div>
                    <div class="stat-value"><?= $participants ?></div>
                    <div class="stat-note">Nilai variabel $participants</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Subtotal</div>
                    <div class="stat-value">
                        Rp <?= number_format($subtotal, 0, ',', '.') ?>
                    </div>
                    <div class="stat-note">Hasil perkalian biaya</div>
                </div>
            </div>

            <h2 class="section-title">Hasil Pengujian Operator</h2>

            <div class="results">
                <div class="result-card">
                    <div class="result-heading">Comparison &gt; 0</div>
                    <div class="result-description">
                        Memeriksa apakah biaya lebih besar dari nol.
                    </div>
                    <span class="result-value">
                        <?= $comparisonPositive ? 'true' : 'false' ?>
                    </span>
                </div>

                <div class="result-card">
                    <div class="result-heading">Strict Comparison ===</div>
                    <div class="result-description">
                        Membandingkan nilai sekaligus tipe data.
                    </div>
                    <span class="result-value">
                        <?= $comparisonStrict ? 'true' : 'false' ?>
                    </span>
                </div>
            </div>

            <div class="output-box">
                <div class="output-title">HASIL OUTPUT</div>

                <ul class="output-list">
                    <li>
                        <span class="output-label">Perkalian</span>
                        <span class="output-value">
                            <?= number_format($subtotal, 0, ',', '.') ?>
                        </span>
                    </li>

                    <li>
                        <span class="output-label">Comparison &gt; 0</span>
                        <span class="output-value">
                            <?= $comparisonPositive ? 'true' : 'false' ?>
                        </span>
                    </li>

                    <li>
                        <span class="output-label">Strict ===</span>
                        <span class="output-value">
                            <?= $comparisonStrict ? 'true' : 'false' ?>
                        </span>
                    </li>

                    <li>
                        <span class="output-label">Concatenation</span>
                        <span class="output-value">
                            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </li>
                </ul>
            </div>

            <div class="explanation">
                <strong>Kesimpulan Pengujian</strong>
                Biaya sebesar Rp 350.000 dikalikan 2 peserta menghasilkan
                subtotal Rp 700.000. Perbandingan biaya terhadap nol
                menghasilkan <code>true</code>. Operator <code>===</code>
                juga menghasilkan <code>true</code> karena kedua nilai
                sama-sama bertipe integer dan bernilai 350000.
            </div>

            <div class="actions">
                <a href="fee-calculator.php" class="btn btn-primary">
                    ← Kembali ke Kalkulator
                </a>

                <a href="operator-test.php" class="btn btn-secondary">
                    Ulangi Pengujian
                </a>
            </div>

        </section>

        <footer class="footer">
            KursusKu &copy; <?= date('Y') ?> · Operator Test
        </footer>

    </main>
</body>
</html>
