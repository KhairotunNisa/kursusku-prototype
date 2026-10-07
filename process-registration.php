<?php

session_start();

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

/*
|--------------------------------------------------------------------------
| PROSES HANYA MELALUI POST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registration.php');
    exit;
}



/*
|--------------------------------------------------------------------------
| AMBIL DATA FORM
|--------------------------------------------------------------------------
*/

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

$courseCode = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode = $_POST['learning_mode'] ?? '';

$packageCount = (int) ($_POST['package_count'] ?? 1);

$notes = trim($_POST['notes'] ?? '');

$interests = $_POST['interests'] ?? [];


/*
|--------------------------------------------------------------------------
| PASTIKAN INTERESTS BERUPA ARRAY
|--------------------------------------------------------------------------
*/

if (!is_array($interests)) {
    $interests = [];
}


/*
|--------------------------------------------------------------------------
| FILTER CHECKBOX YANG VALID
|--------------------------------------------------------------------------
*/

$allowedInterestKeys = array_keys($interestOptions);

$interests = array_values(
    array_intersect(
        $interests,
        $allowedInterestKeys
    )
);


/*
|--------------------------------------------------------------------------
| VALIDASI
|--------------------------------------------------------------------------
*/

$errors = [];


if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}


$course = findCourse(
    $courses,
    $courseCode
);


if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}


if (!in_array(
    $participantType,
    ['mahasiswa', 'guru', 'umum'],
    true
)) {
    $errors[] = 'Tipe peserta tidak valid.';
}


if (!in_array(
    $learningMode,
    ['offline', 'online', 'hybrid'],
    true
)) {
    $errors[] = 'Metode belajar tidak valid.';
}


if (!in_array(
    $packageCount,
    [1, 2, 3],
    true
)) {
    $errors[] = 'Jumlah paket tidak valid.';
}


/*
|--------------------------------------------------------------------------
| PERHITUNGAN BIAYA
|--------------------------------------------------------------------------
*/

$discountPercent = 0;
$grossTotal = 0;
$discountAmount = 0;
$finalTotal = 0;


if ($course !== null) {

    $discountPercent = getDiscountPercent(
        $participantType
    );

    $grossTotal =
        $course['fee'] * $packageCount;

    $discountAmount =
        intdiv(
            $grossTotal * $discountPercent,
            100
        );

    $finalTotal =
        $grossTotal - $discountAmount;
}


/*
|--------------------------------------------------------------------------
| LABEL METODE BELAJAR
|--------------------------------------------------------------------------
*/

if ($learningMode === 'offline') {

    $learningModeLabel = 'Tatap Muka';

} elseif ($learningMode === 'online') {

    $learningModeLabel = 'Online';

} elseif ($learningMode === 'hybrid') {

    $learningModeLabel = 'Hybrid';

} else {

    $learningModeLabel = 'Tidak diketahui';

}


/*
|--------------------------------------------------------------------------
| LABEL TIPE PESERTA
|--------------------------------------------------------------------------
*/

if ($participantType === 'mahasiswa') {

    $participantLabel = 'Mahasiswa';

} elseif ($participantType === 'guru') {

    $participantLabel = 'Guru';

} elseif ($participantType === 'umum') {

    $participantLabel = 'Umum';

} else {

    $participantLabel = '-';

}
/* 
|--------------------------------------------------------------------------
| SIMPAN PENDAFTARAN KE HISTORY
|--------------------------------------------------------------------------
*/

if (empty($errors) && $course !== null) {

    // Pastikan history sudah tersedia
    if (!isset($_SESSION['registration_history'])) {
        $_SESSION['history'] = [];
    }

    // Data pendaftaran yang akan disimpan
    $_SESSION['history'][] = [
        'name' => $name,
        'email' => $email,
        'course' => $course['name'],
        'course_code' => $courseCode,
        'participant_type' => $participantLabel,
        'learning_mode' => $learningModeLabel,
        'package_count' => $packageCount,
        'total' => $finalTotal,
        'notes' => $notes,
        'registered_at' => date('d-m-Y H:i')
    ];
}

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


    <!--
    ============================================================
    CSS KHUSUS HALAMAN PROCESS
    Tidak menggunakan warna hijau dari style.css lama.
    ============================================================
    -->

    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f7f8;

            color: #111827;

        }


        /*
        ========================================================
        HEADER
        ========================================================
        */

        .site-header {

            background: #111111;

            border-bottom:
                5px solid #f5c400;

            padding:
                22px 0;

        }


        .nav-container {

            max-width: 1180px;

            margin: 0 auto;

            padding:
                0 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        .brand {

            display: flex;

            align-items: center;

            gap: 12px;

            text-decoration: none;

            color: white;

            font-size: 30px;

            font-weight: 800;

        }


        .brand-icon {

            width: 50px;

            height: 50px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffd32a;

            color: #111111;

            border-radius: 15px;

            font-size: 28px;

            font-weight: 900;

        }


        .brand span span {

            color: #ffd32a;

        }


        .nav-links {

            display: flex;

            gap: 35px;

        }


        .nav-links a {

            color: white;

            text-decoration: none;

            font-weight: 700;

            font-size: 16px;

        }


        .nav-links a:hover {

            color: #ffd32a;

        }


        /*
        ========================================================
        HALAMAN
        ========================================================
        */

        .result-page {

            max-width: 1180px;

            margin:
                45px auto 70px;

            padding:
                0 25px;

        }


        /*
        ========================================================
        GRID UTAMA
        ========================================================
        */

        .result-grid {

            display: grid;

            grid-template-columns:
                1.35fr
                0.85fr;

            gap: 0;

            background: white;

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 15px 40px
                rgba(0, 0, 0, 0.08);

        }


        /*
        ========================================================
        BAGIAN KIRI
        ========================================================
        */

        .result-left {

            padding: 45px;

            background: #ffffff;

        }


        .page-label {

            display: inline-block;

            margin-bottom: 15px;

            color: #d6a900;

            font-size: 13px;

            font-weight: 800;

            letter-spacing: 2px;

        }


        .result-left h1 {

            margin:
                0 0 35px;

            font-size: 38px;

            line-height: 1.15;

            color: #111827;

        }


        /*
        ========================================================
        DATA PESERTA
        ========================================================
        */

        .section-title {

            margin:
                0 0 20px;

            font-size: 22px;

            color: #111827;

        }


        .data-list {

            border:
                1px solid #e5e7eb;

            border-radius: 16px;

            overflow: hidden;

            margin-bottom: 35px;

        }


        .data-row {

            display: grid;

            grid-template-columns:
                180px 1fr;

            padding:
                17px 20px;

            border-bottom:
                1px solid #e5e7eb;

            gap: 20px;

        }


        .data-row:last-child {

            border-bottom: none;

        }


        .data-label {

            color: #64748b;

            font-size: 15px;

        }


        .data-value {

            color: #111827;

            font-weight: 700;

            text-align: right;

        }


        /*
        ========================================================
        RINCIAN BIAYA
        ========================================================
        */

        .price-box {

            border:
                1px solid #e5e7eb;

            border-radius: 16px;

            overflow: hidden;

            margin-bottom: 35px;

        }


        .price-row {

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding:
                17px 20px;

            border-bottom:
                1px solid #e5e7eb;

            font-size: 15px;

        }


        .price-row:last-child {

            border-bottom: none;

        }


        .price-discount {

            color: #c0392b;

        }


        /*
        ========================================================
        TOTAL AKHIR - KUNING
        ========================================================
        */

        .price-total {

            background: #fff3b0;

            color: #111827;

            font-weight: 900;

            font-size: 18px;

        }


        .price-total span:last-child {

            color: #111111;

        }


        /*
        ========================================================
        MINAT
        ========================================================
        */

        .interest-section {

            margin-bottom: 35px;

        }


        .interest-list {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            padding: 0;

            margin: 0;

            list-style: none;

        }


        .interest-item {

            display: inline-block;

            background: #fff3b0;

            border:
                1px solid #f5c400;

            color: #5f4a00;

            padding:
                9px 15px;

            border-radius: 20px;

            font-weight: 700;

            font-size: 14px;

        }


        /*
        ========================================================
        FASILITAS
        ========================================================
        */

        .facility-section {

            margin-bottom: 35px;

        }


        .facility-list {

            margin: 0;

            padding-left: 22px;

        }


        .facility-list li {

            margin-bottom: 10px;

            color: #334155;

        }


        .facility-list li::marker {

            color: #d6a900;

        }


        /*
        ========================================================
        CATATAN
        ========================================================
        */

        .notes-section {

            margin-bottom: 35px;

        }


        .notes-box {

            background: #f8fafc;

            border-left:
                5px solid #f5c400;

            padding:
                18px 20px;

            border-radius: 10px;

            color: #334155;

            line-height: 1.6;

        }


        /*
        ========================================================
        BAGIAN KANAN - KUNING
        ========================================================
        */

        .result-right {

            background: #ffd42a;

            padding: 45px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            min-height: 650px;

        }


        .course-label {

            color: #735900;

            font-size: 13px;

            font-weight: 900;

            letter-spacing: 2px;

            margin-bottom: 15px;

        }


        .course-name {

            margin:
                0 0 25px;

            font-size: 40px;

            line-height: 1.1;

            color: #111111;

        }


        .course-price {

            margin:
                0 0 30px;

            font-size: 34px;

            font-weight: 900;

            color: #111111;

        }


        .course-description {

            color: #3f3500;

            font-size: 16px;

            line-height: 1.7;

        }


        /*
        ========================================================
        KOTAK INFO KUNING
        ========================================================
        */

        .course-info-box {

            margin-top: 35px;

            padding: 20px;

            background:
                rgba(255,255,255,0.45);

            border-radius: 15px;

        }


        .course-info-box p {

            margin:
                0 0 10px;

            color: #3f3500;

        }


        .course-info-box p:last-child {

            margin-bottom: 0;

        }


        .course-info-box strong {

            color: #111111;

        }


        /*
        ========================================================
        BUTTON
        ========================================================
        */

        .result-actions {

            display: flex;

            flex-wrap: wrap;

            gap: 12px;

            margin-top: 40px;

        }


        .btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 48px;

            padding:
                0 22px;

            border-radius: 9px;

            text-decoration: none;

            font-weight: 800;

            font-size: 14px;

        }


        .btn-primary {

            background: #111111;

            color: #ffd42a;

            border:
                2px solid #111111;

        }


        .btn-secondary {

            background: white;

            color: #111111;

            border:
                2px solid #111111;

        }


        .btn-primary:hover {

            background: #333333;

        }


        .btn-secondary:hover {

            background: #fff3b0;

        }


        /*
        ========================================================
        PESAN ERROR
        ========================================================
        */

        .error-card {

            background: white;

            border-radius: 20px;

            padding: 35px;

            box-shadow:
                0 15px 40px
                rgba(0,0,0,0.08);

        }


        .error-card h1 {

            margin-top: 0;

        }


        .error-card ul {

            line-height: 1.8;

        }


        /*
        ========================================================
        RESPONSIVE
        ========================================================
        */

        @media (max-width: 850px) {

            .result-grid {

                grid-template-columns: 1fr;

            }


            .result-right {

                min-height: auto;

            }


            .data-row {

                grid-template-columns: 1fr;

                gap: 7px;

            }


            .data-value {

                text-align: left;

            }


            .result-left,
            .result-right {

                padding: 30px;

            }


            .course-name {

                font-size: 32px;

            }

        }


        @media (max-width: 600px) {

            .nav-container {

                flex-direction: column;

                gap: 15px;

            }


            .nav-links {

                gap: 20px;

            }


            .result-page {

                margin-top: 25px;

            }


            .result-left,
            .result-right {

                padding: 25px;

            }


            .result-left h1 {

                font-size: 30px;

            }


            .result-actions {

                flex-direction: column;

            }


            .btn {

                width: 100%;

            }

        }

    </style>

</head>


<body>


<!-- ==========================================================
     HEADER
========================================================== -->

<header class="site-header">

    <div class="nav-container">

        <a
            href="index.php"
            class="brand"
        >

            <span class="brand-icon">
                K
            </span>

            <span>
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


<!-- ==========================================================
     HASIL PENDAFTARAN
========================================================== -->

<main class="result-page">


<?php if (!empty($errors)): ?>


    <!-- ======================================================
         ERROR
    ======================================================= -->

    <div class="error-card">

        <span class="page-label">
            PENDAFTARAN
        </span>

        <h1>
            Data belum dapat diproses
        </h1>

        <p>
            Silakan periksa kembali data berikut:
        </p>

        <ul>

            <?php foreach ($errors as $error): ?>

                <li>
                    <?= e($error) ?>
                </li>

            <?php endforeach; ?>

        </ul>


        <div class="result-actions">

            <a
                href="registration.php"
                class="btn btn-primary"
            >
                Kembali ke Form
            </a>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                Beranda
            </a>

        </div>

    </div>


<?php else: ?>


    <!-- ======================================================
         GRID HASIL
    ======================================================= -->

    <div class="result-grid">


        <!-- ==================================================
             BAGIAN KIRI
        =================================================== -->

        <section class="result-left">


            <span class="page-label">
                MILESTONE 6 · RINGKASAN
            </span>


            <h1>
                Pendaftaran Berhasil Diproses
            </h1>


            <!-- ==============================================
                 DATA PESERTA
            =============================================== -->

            <h2 class="section-title">
                Data Peserta
            </h2>


            <div class="data-list">


                <div class="data-row">

                    <span class="data-label">
                        Nama
                    </span>

                    <span class="data-value">
                        <?= e($name) ?>
                    </span>

                </div>


                <div class="data-row">

                    <span class="data-label">
                        Email
                    </span>

                    <span class="data-value">
                        <?= e($email) ?>
                    </span>

                </div>


                <div class="data-row">

                    <span class="data-label">
                        Tipe Peserta
                    </span>

                    <span class="data-value">
                        <?= e($participantLabel) ?>
                    </span>

                </div>


                <div class="data-row">

                    <span class="data-label">
                        Metode Belajar
                    </span>

                    <span class="data-value">
                        <?= e($learningModeLabel) ?>
                    </span>

                </div>


                <div class="data-row">

                    <span class="data-label">
                        Jumlah Paket
                    </span>

                    <span class="data-value">
                        <?= $packageCount ?> paket
                    </span>

                </div>


            </div>


            <!-- ==============================================
                 RINCIAN BIAYA
            =============================================== -->

            <h2 class="section-title">
                Rincian Biaya
            </h2>


            <div class="price-box">


                <div class="price-row">

                    <span>
                        Biaya satuan
                    </span>

                    <span>
                        <?= formatRupiah($course['fee']) ?>
                    </span>

                </div>


                <div class="price-row">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        <?= formatRupiah($grossTotal) ?>
                    </span>

                </div>


                <div class="price-row">

                    <span>
                        Diskon <?= $discountPercent ?>%
                    </span>

                    <span class="price-discount">

                        -<?= formatRupiah($discountAmount) ?>

                    </span>

                </div>


                <div class="price-row price-total">

                    <span>
                        TOTAL AKHIR
                    </span>

                    <span>
                        <?= formatRupiah($finalTotal) ?>
                    </span>

                </div>


            </div>


            <!-- ==============================================
                 MINAT
            =============================================== -->

            <div class="interest-section">

                <h2 class="section-title">
                    Minat Belajar
                </h2>


                <ul class="interest-list">

                    <?php if ($interests === []): ?>

                        <li class="interest-item">
                            Belum memilih minat
                        </li>

                    <?php else: ?>

                        <?php foreach ($interests as $interest): ?>

                            <li class="interest-item">

                                <?= e(
                                    $interestOptions[$interest]
                                    ?? $interest
                                ) ?>

                            </li>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </ul>

            </div>


            <!-- ==============================================
                 FASILITAS
            =============================================== -->

            <div class="facility-section">

                <h2 class="section-title">
                    Fasilitas
                </h2>


                <ul class="facility-list">

                    <?php foreach ($facilities as $facility): ?>

                        <li>
                            <?= e($facility) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>


            <!-- ==============================================
                 CATATAN
            =============================================== -->

            <div class="notes-section">

                <h2 class="section-title">
                    Catatan
                </h2>


                <div class="notes-box">

                    <?php if ($notes !== ''): ?>

                        <?= nl2br(e($notes)) ?>

                    <?php else: ?>

                        Tidak ada catatan.

                    <?php endif; ?>

                </div>

            </div>


        </section>


        <!-- ==================================================
             BAGIAN KANAN KUNING
        =================================================== -->

        <aside class="result-right">


            <div>


                <div class="course-label">
                    KURSUS PILIHAN
                </div>


                <h2 class="course-name">

                    <?= e($course['name']) ?>

                </h2>


                <div class="course-price">

                    <?= formatRupiah($course['fee']) ?>

                </div>


                <p class="course-description">

                    Kursus pilihan berhasil
                    ditambahkan ke pendaftaran.

                </p>


                <div class="course-info-box">


                    <p>

                        <strong>
                            Peserta:
                        </strong>

                        <?= e($participantLabel) ?>

                    </p>


                    <p>

                        <strong>
                            Metode:
                        </strong>

                        <?= e($learningModeLabel) ?>

                    </p>


                    <p>

                        <strong>
                            Paket:
                        </strong>

                        <?= $packageCount ?> paket

                    </p>


                    <p>

                        <strong>
                            Total:
                        </strong>

                        <?= formatRupiah($finalTotal) ?>

                    </p>


                </div>


            </div>


            <!-- ==============================================
                 BUTTON
            =============================================== -->

            <div class="result-actions">


                <a
                    href="registration.php"
                    class="btn btn-primary"
                >
                    Daftar Lagi
                </a>


                <a
                    href="history.php"
                    class="btn btn-secondary"
                >
                    Lihat History Dummy
                </a>


                <a
                    href="index.php"
                    class="btn btn-secondary"
                >
                    Beranda
                </a>


            </div>


        </aside>


    </div>


<?php endif; ?>


</main>


</body>

</html>