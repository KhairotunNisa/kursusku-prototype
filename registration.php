<?php

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';


// =====================================================
// CEK REQUEST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}


// =====================================================
// AMBIL DATA DARI FORM
// =====================================================

$name = trim($_POST['name'] ?? '');

$email = trim($_POST['email'] ?? '');

$phone = trim($_POST['phone'] ?? '');

$studyProgram = trim($_POST['study_program'] ?? '');

$courseCode = trim($_POST['course_code'] ?? '');

$participantType = trim($_POST['participant_type'] ?? '');

$interests = $_POST['interests'] ?? [];

$learningMode = trim($_POST['learning_mode'] ?? '');

$packageCount = (int) ($_POST['package_count'] ?? 1);

$notes = trim($_POST['notes'] ?? '');


// =====================================================
// VALIDASI DATA
// =====================================================

if (
    $name === '' ||
    $email === '' ||
    $phone === '' ||
    $studyProgram === '' ||
    $courseCode === '' ||
    $participantType === '' ||
    $learningMode === '' ||
    $packageCount < 1
) {
    header('Location: register.php');
    exit;
}


// =====================================================
// CARI DATA KURSUS
// =====================================================

$selectedCourse = null;

foreach ($courses as $course) {

    if ($course['code'] === $courseCode) {

        $selectedCourse = $course;

        break;
    }
}


// =====================================================
// JIKA KURSUS TIDAK DITEMUKAN
// =====================================================

if ($selectedCourse === null) {

    die('
        <div style="
            font-family: Arial, sans-serif;
            padding: 40px;
            text-align: center;
        ">

            <h2>Kursus tidak ditemukan</h2>

            <p>
                Silakan kembali ke halaman pendaftaran.
            </p>

            <a href="register.php">
                Kembali ke Pendaftaran
            </a>

        </div>
    ');
}


// =====================================================
// DATA KURSUS
// =====================================================

$courseName = $selectedCourse['name'];

$courseFee = (int) $selectedCourse['fee'];


// =====================================================
// HITUNG BIAYA
// =====================================================

// Subtotal
$subtotal = $courseFee * $packageCount;


// Diskon berdasarkan jumlah paket
$discountPercent = 0;

if ($packageCount >= 3) {

    $discountPercent = 15;

} elseif ($packageCount == 2) {

    $discountPercent = 10;

}


// Nilai diskon
$discount = calculateDiscount(
    $subtotal,
    $discountPercent
);


// Biaya admin
$adminFee = 25000;


// Total
$total = $subtotal - $discount + $adminFee;


// =====================================================
// FORMAT DATA
// =====================================================

$interestText = 'Tidak ada';

if (!empty($interests)) {

    $interestLabels = [];

    foreach ($interests as $interestKey) {

        if (isset($interestOptions[$interestKey])) {

            $interestLabels[] = $interestOptions[$interestKey];

        } else {

            $interestLabels[] = $interestKey;

        }
    }

    $interestText = implode(', ', $interestLabels);
}


// =====================================================
// FORMAT METODE BELAJAR
// =====================================================

$learningModeLabels = [

    'offline' => 'Tatap Muka',

    'online' => 'Online',

    'hybrid' => 'Hybrid'

];

$learningModeText =
    $learningModeLabels[$learningMode]
    ?? $learningMode;


// =====================================================
// FORMAT TIPE PESERTA
// =====================================================

$participantLabels = [

    'mahasiswa' => 'Mahasiswa',

    'guru' => 'Guru',

    'umum' => 'Umum'

];

$participantText =
    $participantLabels[$participantType]
    ?? $participantType;


// =====================================================
// TANGGAL PENDAFTARAN
// =====================================================

$registrationDate = date('d-m-Y');

$registrationTime = date('H:i');

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Hasil Pendaftaran - KursusKu
    </title>


    <style>

        /* =================================================
           RESET
           ================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =================================================
           BODY
           ================================================= */

        body {

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background:
                #f4f7f8;

            color:
                #14213d;

            min-height:
                100vh;

        }


        /* =================================================
           HEADER
           ================================================= */

        .site-header {

            background:
                #ffffff;

            border-bottom:
                1px solid #e5e5e5;

            padding:
                18px 0;

        }


        .container {

            width:
                min(1180px, 92%);

            margin:
                0 auto;

        }


        .nav-container {

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                center;

        }


        /* =================================================
           BRAND
           ================================================= */

        .brand {

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            text-decoration:
                none;

            color:
                #111111;

            font-size:
                23px;

            font-weight:
                800;

        }


        .brand-icon {

            width:
                40px;

            height:
                40px;

            border-radius:
                12px;

            background:
                #ffd21f;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            font-weight:
                900;

            color:
                #111111;

        }


        .brand-name span {

            color:
                #f2bd00;

        }


        /* =================================================
           NAVIGATION
           ================================================= */

        .nav-links {

            display:
                flex;

            gap:
                30px;

        }


        .nav-links a {

            text-decoration:
                none;

            color:
                #17233d;

            font-weight:
                700;

        }


        .nav-links a:hover {

            color:
                #e6ad00;

        }


        /* =================================================
           MAIN
           ================================================= */

        main {

            padding:
                55px 0 80px;

        }


        /* =================================================
           RESULT CARD
           ================================================= */

        .result-card {

            background:
                #ffffff;

            border-radius:
                28px;

            overflow:
                hidden;

            box-shadow:
                0 18px 45px rgba(0, 0, 0, 0.10);

            display:
                grid;

            grid-template-columns:
                1.45fr 0.75fr;

            max-width:
                1150px;

            margin:
                0 auto;

        }


        /* =================================================
           LEFT
           ================================================= */

        .result-content {

            padding:
                50px;

        }


        .page-label {

            display:
                inline-block;

            background:
                #fff4bd;

            color:
                #9a7200;

            border:
                1px solid #f1c928;

            border-radius:
                30px;

            padding:
                9px 17px;

            font-size:
                13px;

            font-weight:
                800;

            letter-spacing:
                .5px;

            margin-bottom:
                20px;

        }


        .result-content h1 {

            font-size:
                42px;

            line-height:
                1.1;

            margin-bottom:
                15px;

        }


        .result-content h1 span {

            color:
                #f0bd00;

        }


        .success-message {

            color:
                #5d6675;

            font-size:
                16px;

            line-height:
                1.7;

            margin-bottom:
                35px;

        }


        /* =================================================
           DATA PESERTA
           ================================================= */

        .data-title {

            font-size:
                24px;

            margin-bottom:
                18px;

        }


        .data-list {

            display:
                grid;

            grid-template-columns:
                1fr 1fr;

            gap:
                14px;

        }


        .data-item {

            background:
                #f7f9fa;

            border-radius:
                13px;

            padding:
                16px 18px;

            border-left:
                4px solid #ffd21f;

        }


        .data-item.full {

            grid-column:
                1 / -1;

        }


        .data-label {

            display:
                block;

            font-size:
                12px;

            font-weight:
                700;

            color:
                #737b88;

            margin-bottom:
                6px;

            text-transform:
                uppercase;

        }


        .data-value {

            font-size:
                16px;

            font-weight:
                700;

            color:
                #17233d;

            word-break:
                break-word;

        }


        /* =================================================
           CATATAN
           ================================================= */

        .notes-box {

            margin-top:
                25px;

        }


        .notes-box h3 {

            margin-bottom:
                10px;

            font-size:
                20px;

        }


        .notes-content {

            background:
                #f7f9fa;

            border-left:
                5px solid #ffd21f;

            padding:
                18px;

            border-radius:
                12px;

            color:
                #3e4652;

            line-height:
                1.6;

        }


        /* =================================================
           RIGHT / BIAYA
           ================================================= */

        .payment-panel {

            background:
                #ffd21f;

            padding:
                45px 35px;

            display:
                flex;

            flex-direction:
                column;

            justify-content:
                space-between;

        }


        .payment-top h2 {

            font-size:
                27px;

            margin-bottom:
                8px;

            color:
                #111111;

        }


        .payment-top p {

            color:
                #4b4100;

            line-height:
                1.6;

            margin-bottom:
                30px;

        }


        .price-box {

            background:
                rgba(255, 255, 255, .62);

            border-radius:
                18px;

            padding:
                22px;

        }


        .price-row {

            display:
                flex;

            justify-content:
                space-between;

            gap:
                15px;

            padding:
                10px 0;

            color:
                #282300;

        }


        .price-row.discount {

            color:
                #08733c;

            font-weight:
                700;

        }


        .price-row.total {

            border-top:
                2px solid rgba(0, 0, 0, .15);

            margin-top:
                10px;

            padding-top:
                18px;

            font-size:
                21px;

            font-weight:
                900;

            color:
                #111111;

        }


        .registration-info-box {

            margin-top:
                25px;

            background:
                rgba(255, 255, 255, .58);

            padding:
                17px;

            border-radius:
                14px;

            line-height:
                1.7;

            font-size:
                14px;

        }


        /* =================================================
           BUTTON AREA
           ================================================= */

        .result-actions {

            display:
                flex;

            flex-wrap:
                wrap;

            gap:
                12px;

            margin-top:
                30px;

        }


        .result-actions a {

            text-decoration:
                none;

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            min-height:
                58px;

            padding:
                0 24px;

            border-radius:
                14px;

            font-weight:
                800;

            font-size:
                15px;

            transition:
                all .2s ease;

        }


        /* DAFTAR LAGI */

        .btn-primary {

            background:
                #111111;

            color:
                #ffd21f;

            border:
                2px solid #111111;

        }


        .btn-primary:hover {

            background:
                #ffd21f;

            color:
                #111111;

            transform:
                translateY(-2px);

        }


        /* BUTTON LAIN */

        .btn-secondary {

            background:
                #ffffff;

            color:
                #111111;

            border:
                2px solid #111111;

        }


        .btn-secondary:hover {

            background:
                #ffd21f;

            transform:
                translateY(-2px);

        }


        /* =================================================
           FOOTER
           ================================================= */

        footer {

            text-align:
                center;

            padding:
                25px;

            color:
                #68717d;

            font-size:
                14px;

        }


        /* =================================================
           RESPONSIVE
           ================================================= */

        @media (max-width: 900px) {

            .result-card {

                grid-template-columns:
                    1fr;

            }


            .payment-panel {

                min-height:
                    450px;

            }

        }


        @media (max-width: 650px) {

            .nav-container {

                flex-direction:
                    column;

                gap:
                    15px;

            }


            .nav-links {

                gap:
                    18px;

            }


            main {

                padding-top:
                    30px;

            }


            .result-content {

                padding:
                    30px 22px;

            }


            .payment-panel {

                padding:
                    30px 22px;

            }


            .result-content h1 {

                font-size:
                    32px;

            }


            .data-list {

                grid-template-columns:
                    1fr;

            }


            .data-item.full {

                grid-column:
                    auto;

            }


            .result-actions {

                flex-direction:
                    column;

            }


            .result-actions a {

                width:
                    100%;

            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     HEADER
     ===================================================== -->

<header class="site-header">

    <div class="container nav-container">


        <a
            href="index.php"
            class="brand"
        >

            <span class="brand-icon">
                K
            </span>

            <span class="brand-name">
                Kursus<span>Ku</span>
            </span>

        </a>


        <nav class="nav-links">

            <a href="index.php">
                Beranda
            </a>

            <a href="index.php#kursus">
                Katalog
            </a>

        </nav>

    </div>

</header>



<!-- =====================================================
     MAIN
     ===================================================== -->

<main>

    <div class="container">


        <div class="result-card">


            <!-- =================================================
                 BAGIAN KIRI
                 ================================================= -->

            <section class="result-content">


                <span class="page-label">
                    PENDAFTARAN BERHASIL
                </span>


                <h1>

                    Selamat,

                    <span>
                        <?= e($name) ?>!
                    </span>

                </h1>


                <p class="success-message">

                    Data pendaftaran kamu sudah berhasil
                    diterima oleh sistem KursusKu.
                    Berikut adalah ringkasan data yang kamu masukkan.

                </p>



                <!-- =================================================
                     DATA PESERTA
                     ================================================= -->

                <h2 class="data-title">
                    Data Peserta
                </h2>


                <div class="data-list">


                    <!-- NAMA -->

                    <div class="data-item">

                        <span class="data-label">
                            Nama Lengkap
                        </span>

                        <span class="data-value">
                            <?= e($name) ?>
                        </span>

                    </div>


                    <!-- EMAIL -->

                    <div class="data-item">

                        <span class="data-label">
                            Email
                        </span>

                        <span class="data-value">
                            <?= e($email) ?>
                        </span>

                    </div>


                    <!-- NOMOR HP -->

                    <div class="data-item">

                        <span class="data-label">
                            Nomor HP
                        </span>

                        <span class="data-value">
                            <?= e($phone) ?>
                        </span>

                    </div>


                    <!-- PROGRAM STUDI -->

                    <div class="data-item">

                        <span class="data-label">
                            Program Studi
                        </span>

                        <span class="data-value">
                            <?= e($studyProgram) ?>
                        </span>

                    </div>


                    <!-- KURSUS -->

                    <div class="data-item full">

                        <span class="data-label">
                            Kursus
                        </span>

                        <span class="data-value">
                            <?= e($courseName) ?>
                        </span>

                    </div>


                    <!-- TIPE -->

                    <div class="data-item">

                        <span class="data-label">
                            Tipe Peserta
                        </span>

                        <span class="data-value">
                            <?= e($participantText) ?>
                        </span>

                    </div>


                    <!-- METODE -->

                    <div class="data-item">

                        <span class="data-label">
                            Metode Belajar
                        </span>

                        <span class="data-value">
                            <?= e($learningModeText) ?>
                        </span>

                    </div>


                    <!-- PAKET -->

                    <div class="data-item">

                        <span class="data-label">
                            Jumlah Paket
                        </span>

                        <span class="data-value">
                            <?= e($packageCount) ?> Paket
                        </span>

                    </div>


                    <!-- MINAT -->

                    <div class="data-item">

                        <span class="data-label">
                            Minat Belajar
                        </span>

                        <span class="data-value">
                            <?= e($interestText) ?>
                        </span>

                    </div>

                </div>



                <!-- =================================================
                     CATATAN
                     ================================================= -->

                <div class="notes-box">

                    <h3>
                        Catatan
                    </h3>


                    <div class="notes-content">

                        <?php if ($notes !== ''): ?>

                            <?= nl2br(e($notes)) ?>

                        <?php else: ?>

                            Tidak ada catatan.

                        <?php endif; ?>

                    </div>

                </div>



                <!-- =================================================
                     TOMBOL
                     ================================================= -->

                <div class="result-actions">


                    <!-- DAFTAR LAGI -->

                    <a
                        href="register.php"
                        class="btn-primary"
                    >
                        Daftar Lagi
                    </a>


                    <!-- HISTORY DUMMY -->

                    <a
                        href="history.php"
                        class="btn-secondary"
                    >
                        Lihat History Dummy
                    </a>


                    <!-- LOOP LAB -->

                    <a
                        href="loop-lab.php"
                        class="btn-secondary"
                    >
                        Loop Lab
                    </a>


                    <!-- BERANDA -->

                    <a
                        href="index.php"
                        class="btn-secondary"
                    >
                        Beranda
                    </a>


                </div>


            </section>



            <!-- =================================================
                 BAGIAN KANAN
                 ================================================= -->

            <aside class="payment-panel">


                <div class="payment-top">


                    <h2>
                        Ringkasan Biaya
                    </h2>


                    <p>
                        Berikut rincian biaya pendaftaran
                        kursus yang kamu pilih.
                    </p>



                    <div class="price-box">


                        <!-- BIAYA KURSUS -->

                        <div class="price-row">

                            <span>
                                Biaya Kursus
                            </span>

                            <strong>
                                <?= rupiah($courseFee) ?>
                            </strong>

                        </div>


                        <!-- JUMLAH PAKET -->

                        <div class="price-row">

                            <span>
                                Jumlah Paket
                            </span>

                            <strong>
                                <?= $packageCount ?>x
                            </strong>

                        </div>


                        <!-- SUBTOTAL -->

                        <div class="price-row">

                            <span>
                                Subtotal
                            </span>

                            <strong>
                                <?= rupiah($subtotal) ?>
                            </strong>

                        </div>


                        <!-- DISKON -->

                        <div class="price-row discount">

                            <span>
                                Diskon <?= $discountPercent ?>%
                            </span>

                            <strong>
                                - <?= rupiah($discount) ?>
                            </strong>

                        </div>


                        <!-- ADMIN -->

                        <div class="price-row">

                            <span>
                                Biaya Admin
                            </span>

                            <strong>
                                <?= rupiah($adminFee) ?>
                            </strong>

                        </div>


                        <!-- TOTAL -->

                        <div class="price-row total">

                            <span>
                                Total
                            </span>

                            <strong>
                                <?= rupiah($total) ?>
                            </strong>

                        </div>


                    </div>



                    <!-- INFO PENDAFTARAN -->

                    <div class="registration-info-box">

                        <strong>
                            Tanggal Pendaftaran
                        </strong>

                        <br>

                        <?= e($registrationDate) ?>

                        pukul

                        <?= e($registrationTime) ?>

                        <br><br>

                        <strong>
                            Status
                        </strong>

                        <br>

                        <span>
                            ✓ Pendaftaran diterima
                        </span>

                    </div>


                </div>


            </aside>


        </div>

    </div>

</main>



<!-- =====================================================
     FOOTER
     ===================================================== -->

<footer>

    © 2026 KursusKu — Belajar Skill Digital

</footer>


</body>

</html>