<?php

$name = trim($_GET['name'] ?? '');
$email = trim($_GET['email'] ?? '');
$phone = trim($_GET['phone'] ?? '');

$study_program = trim($_GET['study_program'] ?? '');
$course = trim($_GET['course'] ?? '');

$participant_type = trim(
    $_GET['participant_type'] ?? ''
);

$interests = $_GET['interests'] ?? [];

$note = trim($_GET['note'] ?? '');

$source = trim($_GET['source'] ?? '');


if (!is_array($interests)) {
    $interests = [$interests];
}


$errors = [];


if ($name === '') {
    $errors[] = 'Nama lengkap wajib diisi.';
}

if ($email === '') {
    $errors[] = 'Email wajib diisi.';
}

if ($phone === '') {
    $errors[] = 'Nomor HP wajib diisi.';
}

if ($study_program === '') {
    $errors[] = 'Program studi wajib dipilih.';
}

if ($course === '') {
    $errors[] = 'Kursus wajib dipilih.';
}

if ($participant_type === '') {
    $errors[] = 'Tipe peserta wajib dipilih.';
}


function e($value)
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES,
        'UTF-8'
    );
}


$course_names = [

    'web-dasar' =>
        'Web Development Dasar',

    'ui-ux' =>
        'UI/UX Design',

    'python' =>
        'Python untuk Pemula'
];


$course_prices = [

    'web-dasar' =>
        'Rp149.000',

    'ui-ux' =>
        'Rp179.000',

    'python' =>
        'Rp199.000'
];


$course_name =
    $course_names[$course]
    ?? $course;


$course_price =
    $course_prices[$course]
    ?? '-';

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
        Data Pendaftaran - KursusKu
    </title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body>

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


<main class="result-page">

    <div class="container result-container">

        <?php if (!empty($errors)): ?>

            <div class="result-card error-card">

                <span class="result-icon">
                    !
                </span>

                <h1>
                    Data Belum Lengkap
                </h1>

                <p>
                    Silakan periksa kembali data
                    pendaftaran kamu.
                </p>

                <ul class="error-list">

                    <?php foreach ($errors as $error): ?>

                        <li>
                            <?= e($error) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

                <a
                    href="registration.php"
                    class="btn btn-yellow"
                >
                    ← Kembali ke Form
                </a>

            </div>

        <?php else: ?>

            <div class="success-header">

                <div class="success-icon">
                    ✓
                </div>

                <span>
                    GET — DATA BERHASIL DITERIMA
                </span>

                <h1>
                    Pendaftaran berhasil!
                </h1>

                <p>
                    Data kamu berhasil dikirim menggunakan
                    metode GET.
                </p>

            </div>


            <div class="result-grid">


                <div class="result-card">

                    <div class="result-card-heading">

                        <span>
                            DATA PESERTA
                        </span>

                        <h2>
                            Informasi Pendaftar
                        </h2>

                    </div>


                    <div class="data-list">

                        <div class="data-item">

                            <span>
                                Nama Lengkap
                            </span>

                            <strong>
                                <?= e($name) ?>
                            </strong>

                        </div>


                        <div class="data-item">

                            <span>
                                Email
                            </span>

                            <strong>
                                <?= e($email) ?>
                            </strong>

                        </div>


                        <div class="data-item">

                            <span>
                                Nomor HP
                            </span>

                            <strong>
                                <?= e($phone) ?>
                            </strong>

                        </div>


                        <div class="data-item">

                            <span>
                                Program Studi
                            </span>

                            <strong>
                                <?= e($study_program) ?>
                            </strong>

                        </div>


                        <div class="data-item">

                            <span>
                                Tipe Peserta
                            </span>

                            <strong>
                                <?= e($participant_type) ?>
                            </strong>

                        </div>


                        <div class="data-item">

                            <span>
                                Minat
                            </span>

                            <strong>

                                <?php if (!empty($interests)): ?>

                                    <?= e(
                                        implode(
                                            ', ',
                                            $interests
                                        )
                                    ) ?>

                                <?php else: ?>

                                    Tidak ada

                                <?php endif; ?>

                            </strong>

                        </div>

                    </div>

                </div>


                <div class="result-card selected-course">

                    <span class="result-card-label">
                        KURSUS PILIHAN
                    </span>

                    <h2>
                        <?= e($course_name) ?>
                    </h2>

                    <div class="selected-price">
                        <?= e($course_price) ?>
                    </div>

                    <p>
                        Kursus pilihan berhasil
                        ditambahkan ke pendaftaran.
                    </p>

                    <div class="source-box">

                        <span>
                            Source
                        </span>

                        <strong>
                            <?= e($source ?: '-') ?>
                        </strong>

                    </div>

                </div>


            </div>


            <div class="result-card note-card">

                <span>
                    CATATAN
                </span>

                <p>
                    <?= $note !== ''
                        ? e($note)
                        : 'Tidak ada catatan.' ?>
                </p>

            </div>


            <div class="result-actions">

                <a
                    href="registration.php"
                    class="btn btn-yellow"
                >
                    ← Daftar Lagi
                </a>

                <a
                    href="index.php"
                    class="btn btn-light"
                >
                    Kembali ke Beranda
                </a>

            </div>

        <?php endif; ?>

    </div>

</main>


<footer>

    <div class="copyright">
        © 2026 KursusKu
    </div>

</footer>

</body>

</html>