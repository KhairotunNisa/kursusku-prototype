<?php

/*
|--------------------------------------------------------------------------
| PROCESS REGISTRATION
|--------------------------------------------------------------------------
|
| File ini menerima:
|
| POST = tombol "Daftar Sekarang"
|
| GET  = tombol "Tes GET"
|
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| CEK METHOD
|--------------------------------------------------------------------------
*/

$method = $_SERVER['REQUEST_METHOD'];


/*
|--------------------------------------------------------------------------
| VARIABEL
|--------------------------------------------------------------------------
*/

$name = '';
$email = '';
$phone = '';

$study_program = '';
$course = '';
$participant_type = '';

$interests = [];

$note = '';
$source = '';

$errors = [];


/*
|--------------------------------------------------------------------------
| POST
|--------------------------------------------------------------------------
|
| Bagian ini dijalankan ketika tombol
| "Daftar Sekarang" ditekan.
|
*/

if ($method === 'POST') {


    $name = trim(
        $_POST['name'] ?? ''
    );


    $email = trim(
        $_POST['email'] ?? ''
    );


    $phone = trim(
        $_POST['phone'] ?? ''
    );


    $study_program = trim(
        $_POST['study_program'] ?? ''
    );


    $course = trim(
        $_POST['course'] ?? ''
    );


    $participant_type = trim(
        $_POST['participant_type'] ?? ''
    );


    $interests = $_POST['interests'] ?? [];


    $note = trim(
        $_POST['note'] ?? ''
    );


    $source = trim(
        $_POST['source'] ?? ''
    );


    /*
    |--------------------------------------------------------------------------
    | Pastikan interests berupa array
    |--------------------------------------------------------------------------
    */

    if (!is_array($interests)) {

        $interests = [$interests];

    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */

    if ($name === '') {

        $errors[] =
            'Nama Lengkap belum diisi.';

    }


    if ($email === '') {

        $errors[] =
            'Email belum diisi.';

    }
    elseif (
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $errors[] =
            'Format email tidak valid.';

    }


    if ($phone === '') {

        $errors[] =
            'Nomor HP belum diisi.';

    }


    if ($study_program === '') {

        $errors[] =
            'Program Studi belum dipilih.';

    }


    if ($course === '') {

        $errors[] =
            'Kursus belum dipilih.';

    }


    if ($participant_type === '') {

        $errors[] =
            'Jenis Peserta belum dipilih.';

    }


    /*
    |--------------------------------------------------------------------------
    | JIKA ERROR
    |--------------------------------------------------------------------------
    */

    if (!empty($errors)) {

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
                Data Tidak Lengkap - KursusKu
            </title>

            <link
                rel="stylesheet"
                href="assets/css/style.css"
            >

        </head>


        <body>

        <main class="container">

            <section class="page-intro">

                <p class="eyebrow">
                    Pendaftaran
                </p>

                <h1>
                    Data Tidak Lengkap
                </h1>

            </section>


            <section class="summary-card">

                <div class="alert alert-danger">

                    <strong>
                        Terdapat kesalahan:
                    </strong>


                    <ul>

                        <?php foreach ($errors as $error): ?>

                            <li>
                                <?= htmlspecialchars($error) ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>


                <div class="form-actions">

                    <a
                        href="registration.php"
                        class="btn-primary"
                    >
                        Kembali ke Form
                    </a>

                </div>

            </section>

        </main>

        </body>

        </html>

        <?php

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | POST BERHASIL
    |--------------------------------------------------------------------------
    */

    $pageTitle =
        'Pendaftaran Berhasil';

    $pageMessage =
        'Data pendaftaran berhasil dikirim menggunakan method POST.';

    $alertTitle =
        'Pendaftaran Diterima untuk Diproses';

    $isGet = false;

}


/*
|--------------------------------------------------------------------------
| GET
|--------------------------------------------------------------------------
|
| ==============================================================
| INI BAGIAN GET
| ==============================================================
|
| Data GET dibaca menggunakan $_GET.
|
|--------------------------------------------------------------------------
*/

elseif ($method === 'GET') {


    /*
    |--------------------------------------------------------------
    | AMBIL DATA GET
    |--------------------------------------------------------------
    */

    $name = trim(
        $_GET['name'] ?? 'Tes GET'
    );


    $email = trim(
        $_GET['email'] ?? 'test@kursusku.com'
    );


    $phone = trim(
        $_GET['phone'] ?? '08123456789'
    );


    $study_program = trim(
        $_GET['study_program'] ?? 'PTIK'
    );


    $course = trim(
        $_GET['course'] ?? 'web-dasar'
    );


    $participant_type = trim(
        $_GET['participant_type'] ?? 'mahasiswa'
    );


    $interests = $_GET['interests'] ?? [];


    $note = trim(
        $_GET['note'] ?? 'Percobaan GET'
    );


    $source = trim(
        $_GET['source'] ?? 'week-05'
    );


    /*
    |--------------------------------------------------------------
    | Pastikan interests array
    |--------------------------------------------------------------
    */

    if (!is_array($interests)) {

        $interests = [$interests];

    }


    /*
    |--------------------------------------------------------------
    | GET BERHASIL
    |--------------------------------------------------------------
    */

    $pageTitle =
        'GET - Data GET Berhasil Diterima';

    $pageMessage =
        'Perhatikan address bar browser. Data formulir terlihat setelah tanda ?';

    $alertTitle =
        'GET - Data GET berhasil diterima';

    $isGet = true;

}


/*
|--------------------------------------------------------------------------
| METHOD TIDAK DIIZINKAN
|--------------------------------------------------------------------------
*/

else {

    http_response_code(405);

    echo 'Method tidak diizinkan.';

    exit;

}


/*
|--------------------------------------------------------------------------
| GABUNGKAN MINAT
|--------------------------------------------------------------------------
*/

$interestText = !empty($interests)
    ? implode(', ', $interests)
    : 'Tidak ada';

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

        <?= htmlspecialchars($pageTitle) ?>

        - KursusKu

    </title>


    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body>


<header class="site-header">

    <div class="container nav-wrap">

        <a
            href="index.php"
            class="brand"
        >
            KursusKu
        </a>


        <nav class="nav-links">

            <a href="index.php">
                Katalog
            </a>

            <a href="registration.php">
                Daftar Kursus
            </a>

        </nav>

    </div>

</header>



<main class="container">


    <!-- =====================================================
         JUDUL
         ===================================================== -->

    <section class="page-intro">

        <p class="eyebrow">

            <?php

            if ($isGet) {

                echo 'Testing GET';

            } else {

                echo 'Pendaftaran';

            }

            ?>

        </p>


        <h1>

            <?= htmlspecialchars($pageTitle) ?>

        </h1>


        <p>

            <?= htmlspecialchars($pageMessage) ?>

        </p>

    </section>



    <!-- =====================================================
         PESAN BERHASIL
         ===================================================== -->

    <div class="alert alert-success">

        <strong>

            <?= htmlspecialchars($alertTitle) ?>

        </strong>

    </div>



    <!-- =====================================================
         DATA PENDAFTARAN
         ===================================================== -->

    <section class="summary-card">

        <h2>
            Data yang Diterima
        </h2>


        <div class="summary">


            <div class="summary-item">

                <strong>
                    Nama Lengkap
                </strong>

                <span>
                    <?= htmlspecialchars($name) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Email
                </strong>

                <span>
                    <?= htmlspecialchars($email) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Nomor HP
                </strong>

                <span>
                    <?= htmlspecialchars($phone) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Program Studi
                </strong>

                <span>
                    <?= htmlspecialchars($study_program) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Kursus
                </strong>

                <span>
                    <?= htmlspecialchars($course) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Jenis Peserta
                </strong>

                <span>
                    <?= htmlspecialchars($participant_type) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Minat Belajar
                </strong>

                <span>
                    <?= htmlspecialchars($interestText) ?>
                </span>

            </div>


            <div class="summary-item">

                <strong>
                    Source
                </strong>

                <span>
                    <?= htmlspecialchars($source) ?>
                </span>

            </div>


        </div>



        <!-- CATATAN -->

        <div class="note">

            <strong>
                Catatan
            </strong>

            <p>

                <?= nl2br(
                    htmlspecialchars(
                        $note !== ''
                            ? $note
                            : '-'
                    )
                ) ?>

            </p>

        </div>



        <!-- TOMBOL -->

        <div class="form-actions">

            <a
                href="registration.php"
                class="btn-primary"
            >
                ← Daftar Lagi
            </a>


            <a
                href="index.php"
                class="btn-secondary"
            >
                Kembali ke Beranda
            </a>

        </div>

    </section>



    <!-- =====================================================
         INFORMASI KHUSUS GET
         ===================================================== -->

    <?php if ($isGet): ?>

        <section class="summary-card">

            <h2>
                GET - Data GET Berhasil Diterima
            </h2>


            <p>
                Perhatikan address bar browser.
            </p>


            <p>
                Data formulir terlihat setelah tanda
                <strong>?</strong>
            </p>


            <p>
                Contoh URL:
            </p>


            <code>
                process-registration.php?method=get&name=Tes+GET&email=test%40kursusku.com
            </code>

        </section>

    <?php endif; ?>


</main>



<footer>

    <div class="container">

        <p>
            &copy; 2026 KursusKu
        </p>

    </div>

</footer>


</body>

</html>