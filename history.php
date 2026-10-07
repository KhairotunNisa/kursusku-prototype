<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/helpers.php';


/*
|--------------------------------------------------------------------------
| DATA HISTORY DUMMY
|--------------------------------------------------------------------------
*/

$dummyHistory = [

    [
        'name'   => 'Eja',
        'course' => 'Web Dasar',
        'total'  => 240000
    ],

    [
        'name'   => 'Aliya',
        'course' => 'PHP Dasar',
        'total'  => 340000
    ],

    [
        'name'   => 'Aiza',
        'course' => 'Laravel Dasar',
        'total'  => 500000
    ],

    [
        'name'   => 'Nurdini',
        'course' => 'Web Dasar',
        'total'  => 240000
    ],

    [
        'name'   => 'Weli',
        'course' => 'Laravel Dasar',
        'total'  => 480000
    ]

];


/*
|--------------------------------------------------------------------------
| AMBIL DATA PENDAFTARAN DARI SESSION
|--------------------------------------------------------------------------
|
| process-registration.php menyimpan data ke:
| $_SESSION['history']
|
*/

$registrationHistory = $_SESSION['history'] ?? [];


/*
|--------------------------------------------------------------------------
| PASTIKAN DATA BERUPA ARRAY
|--------------------------------------------------------------------------
*/

if (!is_array($registrationHistory)) {

    $registrationHistory = [];

}


/*
|--------------------------------------------------------------------------
| DATA PENDAFTARAN TERBARU + DATA DUMMY
|--------------------------------------------------------------------------
|
| Pendaftar baru berada di paling atas.
|
*/

$history = array_merge(
    array_reverse($registrationHistory),
    $dummyHistory
);


/*
|--------------------------------------------------------------------------
| JUMLAH PENDAFTAR BARU
|--------------------------------------------------------------------------
*/

$newRegistrationCount = count($registrationHistory);

?>

<!DOCTYPE html>

<html lang="id">

<head>
    <style>

    /* =========================================
       NAMA + BADGE NEW
       ========================================= */

    .history-name {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .history-name strong {
        display: inline-block;
        margin: 0;
    }

    .new-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 5px 9px;

        background: #ffd229;
        color: #111111;

        border: 1px solid #111111;
        border-radius: 6px;

        font-size: 10px;
        font-weight: 900;

        line-height: 1;
        letter-spacing: 0.5px;

        white-space: nowrap;
    }

</style>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        History Pendaftaran - KursusKu
    </title>

    <link
        rel="stylesheet"
        href="assets/css/style.css?v=6"
    >

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

            <span>
                Kursus<span>Ku</span>
            </span>

        </a>

    </div>

</header>


<!-- =====================================================
     MAIN
     ===================================================== -->

<main class="result-page">

    <div class="container result-container">


        <!-- =================================================
             HISTORY CARD
             ================================================= -->

        <div class="result-card">


            <!-- =================================================
                 JUDUL
                 ================================================= -->

            <div class="result-card-heading">

                <span>
                    DATA HISTORY
                </span>

                <h1>
                    History Pendaftaran
                </h1>

                <p>
                    Menampilkan data pendaftaran terbaru dan
                    data history dummy.
                </p>

            </div>


            <!-- =================================================
                 DATA
                 ================================================= -->

            <div class="data-list">


                <?php if (empty($history)): ?>


                    <div class="data-item">

                        <span
                            style="
                                grid-column: 1 / -1;
                                text-align: center;
                            "
                        >

                            Belum ada data pendaftaran.

                        </span>

                    </div>


                <?php else: ?>


                    <?php foreach ($history as $index => $item): ?>


                        <div class="data-item">


                            <!-- NOMOR -->

                            <span class="history-number">

                                <?= $index + 1 ?>

                            </span>
                            <!-- NAMA -->

<div class="history-name">

    <strong>
        <?= e($item['name'] ?? '-') ?>
    </strong>

    <?php if ($index < $newRegistrationCount): ?>

        <span class="new-badge">
            NEW
        </span>

    <?php endif; ?>

</div>


                           

                            </strong>


                            <!-- KURSUS -->

                            <span>

                                <?= e(
                                    $item['course'] ?? '-'
                                ) ?>

                            </span>


                            <!-- TOTAL -->

                            <strong>

                                <?= formatRupiah(
                                    (int) (
                                        $item['total'] ?? 0
                                    )
                                ) ?>

                            </strong>


                        </div>


                    <?php endforeach; ?>


                <?php endif; ?>


            </div>


        </div>


        <!-- =================================================
             BUTTON
             ================================================= -->

        <div class="result-actions">


            <a
                href="index.php"
                class="btn btn-light"
            >

                ← Kembali ke Beranda

            </a>


            <a
                href="registration.php"
                class="btn btn-yellow"
            >

                Daftar Kursus

            </a>


            <a
                href="loop-lab.php"
                class="btn btn-light"
            >

                ∞ Loop Lab

            </a>


        </div>


    </div>

</main>


<!-- =====================================================
     FOOTER
     ===================================================== -->

<footer>

    <div class="copyright">

        © 2026 KursusKu

    </div>

</footer>


</body>

</html>