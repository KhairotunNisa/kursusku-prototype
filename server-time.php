<?php
$serverTime = date('Y-m-d H:i:s');

echo 'Waktu server: ' . $serverTime;
?>
    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waktu Server - KursusKu</title>

    <style>
        /* WARNA TEMA KUNING */
        :root {
            --kuning: #FFD54F;
            --kuning-muda: #FFF8E1;
            --kuning-tua: #F9A825;
            --oranye: #EF6C00;
            --cokelat: #5D4037;
            --putih: #FFFFFF;
        }

        /* PENGATURAN DASAR */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #FFF8E1, #FFE082);
            color: var(--cokelat);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* KARTU UTAMA */
        .container {
            width: 100%;
            max-width: 600px;
            background: var(--putih);
            padding: 40px 25px;
            border-radius: 20px;
            text-align: center;
            border-top: 8px solid var(--kuning-tua);
            box-shadow: 0 10px 30px rgba(93, 64, 55, 0.15);
        }

        /* JUDUL */
        h1 {
            color: var(--cokelat);
            font-size: 30px;
            margin-bottom: 15px;
        }

        .deskripsi {
            color: #756B5D;
            font-size: 16px;
            margin-bottom: 25px;
        }

        /* TAMPILAN WAKTU */
        .waktu {
            background: var(--kuning-muda);
            border: 2px solid var(--kuning);
            padding: 22px 15px;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .label {
            color: var(--oranye);
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .jam {
            color: var(--cokelat);
            font-size: clamp(20px, 4vw, 30px);
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        /* TOMBOL */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: var(--kuning);
            color: var(--cokelat);
            text-decoration: none;
            font-weight: bold;
            border-radius: 10px;
            transition: 0.2s;
        }

        .btn:hover {
            background: var(--oranye);
            color: var(--putih);
        }

        /* FOOTER */
        .footer {
            margin-top: 25px;
            color: #8D8175;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>KursusKu</h1>

        <p class="deskripsi">
            Halaman pengecekan waktu server
        </p>

        <div class="waktu">
            <p class="label">WAKTU SERVER</p>

            <div class="jam">
                <?php
                date_default_timezone_set('Asia/Jakarta');
                echo date('Y-m-d H:i:s');
                ?>
            </div>
        </div>

        <a href="index.php" class="btn">
            Kembali ke Beranda
        </a>

        <p class="footer">
            &copy; 2026 KursusKu
        </p>
    </div>

</body>
</html>
