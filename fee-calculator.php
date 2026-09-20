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
    <title>KursusKu - Fee Calculator</title>
</head>

<body>

    <h1>Fee Calculator KursusKu</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Keterangan</th>
            <th>Nilai</th>
        </tr>

        <tr>
            <td>Nama Kursus</td>
            <td><?= $courseName ?></td>
        </tr>

        <tr>
            <td>Biaya Kursus</td>
            <td><?= rupiah($fee) ?></td>
        </tr>

        <tr>
            <td>Jumlah Peserta</td>
            <td><?= $participantCount ?></td>
        </tr>

        <tr>
            <td>Subtotal</td>
            <td><?= rupiah($subtotal) ?></td>
        </tr>

        <tr>
            <td>Diskon</td>
            <td><?= rupiah($discount) ?></td>
        </tr>

        <tr>
            <td>Biaya Admin</td>
            <td><?= rupiah($adminFee) ?></td>
        </tr>

        <tr>
            <td><strong>Total</strong></td>
            <td><strong><?= rupiah($total) ?></strong></td>
        </tr>
    </table>

</body>
</html>