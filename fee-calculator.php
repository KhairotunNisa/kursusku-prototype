
<?php

$courseName = 'Laravel Fundamental';
$fee = 2500000;
$participantCount = 3;
$discountPercent = 10;
$adminFee = 50000;
$isActive = true;

// Perhitungan
$subtotal = $fee * $participantCount;
$discount = intdiv($subtotal * $discountPercent, 100);
$total = $subtotal - $discount + $adminFee;

// Format Rupiah
function rupiah(int $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KursusKu - Fee Calculator</title>

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
            padding: 35px 18px;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #FFD54F, #FFB300);
            padding: 30px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            box-shadow: 0 8px 24px rgba(93, 64, 55, 0.12);
            margin-bottom: 25px;
        }

        .brand {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #795548;
            margin-bottom: 8px;
        }

        h1 {
            font-size: clamp(26px, 4vw, 36px);
            color: #4E342E;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6D4C41;
            font-size: 14px;
            line-height: 1.6;
        }

        .header-icon {
            background: rgba(255, 255, 255, 0.55);
            width: 72px;
            height: 72px;
            flex-shrink: 0;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
        }

        /* Kartu */
        .card {
            background: #FFFFFF;
            padding: 27px;
            border-radius: 20px;
            box-shadow: 0 7px 22px rgba(93, 64, 55, 0.08);
            margin-bottom: 22px;
        }

        .section-title {
            font-size: 20px;
            color: #5D4037;
            margin-bottom: 20px;
        }

        /* Informasi kursus */
        .course-box {
            background: #FFF8E1;
            border: 1px solid #FFE082;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .course-icon {
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            border-radius: 15px;
            background: #FFD54F;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .small-label {
            font-size: 12px;
            color: #8D8175;
            margin-bottom: 6px;
        }

        .course-name {
            font-size: 18px;
            font-weight: bold;
            color: #5D4037;
            overflow-wrap: anywhere;
        }

        .course-price {
            color: #EF6C00;
            font-weight: bold;
            margin-top: 7px;
        }

        .status {
            display: inline-block;
            margin-top: 12px;
            background: #E8F5E9;
            color: #2E7D32;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status.inactive {
            background: #FDECEA;
            color: #B71C1C;
        }

        /* Tabel rincian */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #FFF0B3;
        }

        th {
            padding: 15px;
            color: #5D4037;
            font-size: 14px;
            text-align: left;
        }

        td {
            padding: 16px 15px;
            border-bottom: 1px solid #F2EBDD;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #FFFCF2;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        th:last-child,
        td:last-child {
            text-align: right;
            white-space: nowrap;
        }

        .discount {
            color: #2E7D32;
            font-weight: bold;
        }

        /* Total pembayaran */
        .total-card {
            background: linear-gradient(135deg, #5D4037, #795548);
            color: #FFFFFF;
            padding: 28px;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(93, 64, 55, 0.15);
        }

        .total-label {
            color: #FFE082;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .total-amount {
            font-size: clamp(30px, 5vw, 42px);
            font-weight: bold;
            overflow-wrap: anywhere;
            margin-bottom: 12px;
        }

        .total-description {
            color: #F5E7D5;
            font-size: 13px;
            line-height: 1.7;
        }

        .total-tag {
            display: inline-block;
            margin-top: 18px;
            background: #E8F5E9;
            color: #2E7D32;
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 24px 10px 5px;
            color: #786B5D;
            font-size: 12px;
        }

        /* Tampilan HP */
        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .header {
                padding: 23px 18px;
            }

            .header-icon {
                width: 52px;
                height: 52px;
                font-size: 27px;
                border-radius: 14px;
            }

            .card {
                padding: 20px 15px;
            }

            .course-box {
                padding: 15px;
            }

            th, td {
                padding: 13px 9px;
                font-size: 13px;
            }

            .total-card {
                padding: 23px 19px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <header class="header">
        <div>
            <div class="brand">KURSUSKU</div>
            <h1>Fee Calculator</h1>
            <p class="subtitle">
                Hitung dan lihat rincian biaya kursus dengan mudah.
            </p>
        </div>

        <div class="header-icon">🧮</div>
    </header>

    <!-- INFORMASI KURSUS -->
    <section class="card">
        <h2 class="section-title">📚 Informasi Kursus</h2>

        <div class="course-box">
            <div class="course-icon">💻</div>

            <div>
                <div class="small-label">Program pembelajaran</div>

                <div class="course-name">
                    <?= htmlspecialchars($courseName, ENT_QUOTES, 'UTF-8') ?>
                </div>

                <div class="course-price">
                    <?= rupiah($fee) ?> / peserta
                </div>

                <span class="status <?= $isActive ? '' : 'inactive' ?>">
                    <?= $isActive ? '✓ Kursus Aktif' : 'Kursus Tidak Aktif' ?>
                </span>
            </div>
        </div>
    </section>

    <!-- RINCIAN BIAYA -->
    <section class="card">
        <h2 class="section-title">🧾 Rincian Pembayaran</h2>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Nilai</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Nama Kursus</td>
                        <td>
                            <?= htmlspecialchars($courseName, ENT_QUOTES, 'UTF-8') ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Biaya Kursus</td>
                        <td><?= rupiah($fee) ?></td>
                    </tr>

                    <tr>
                        <td>Jumlah Peserta</td>
                        <td><?= $participantCount ?> orang</td>
                    </tr>

                    <tr>
                        <td>Subtotal</td>
                        <td><?= rupiah($subtotal) ?></td>
                    </tr>

                    <tr>
                        <td>Diskon (<?= $discountPercent ?>%)</td>
                        <td class="discount">− <?= rupiah($discount) ?></td>
                    </tr>

                    <tr>
                        <td>Biaya Admin</td>
                        <td><?= rupiah($adminFee) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- TOTAL PEMBAYARAN -->
    <section class="total-card">
        <div class="total-label">TOTAL PEMBAYARAN</div>

        <div class="total-amount">
            <?= rupiah($total) ?>
        </div>

        <p class="total-description">
            Total biaya untuk <?= $participantCount ?> peserta,
            setelah pengurangan diskon dan penambahan biaya administrasi.
        </p>

        <span class="total-tag">✓ Perhitungan selesai</span>
    </section>

    <!-- FOOTER -->
    <footer>
        &copy; 2026 KursusKu — Sistem Informasi Kursus
    </footer>

</div>

</body>
</html>
