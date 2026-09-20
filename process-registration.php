<?php

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$studyProgram = trim($_POST['study_program'] ?? '');

$course = $_POST['course'] ?? '';
$participantType = $_POST['participant_type'] ?? '';

$interests = $_POST['interests'] ?? [];

$note = trim($_POST['note'] ?? '');
$source = $_POST['source'] ?? '';

$interestText = implode(', ', $interests);


function e($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
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

    <title>Hasil Pendaftaran - KursusKu</title>

    <link
        rel="stylesheet"
        <link rel="stylesheet" href="assets/css/style.css?v=2">
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

        <div class="nav-links">

            <a href="index.php">
                Katalog
            </a>

            <a href="registration.php">
                Daftar Kursus
            </a>

        </div>

    </div>

</header>


<main class="container">

    <div class="alert-success">

        <h1>
            Pendaftaran Berhasil!
        </h1>

        <p>
            Data pendaftaran kamu sudah berhasil diterima.
        </p>

    </div>


    <section class="summary-card">

        <h2>
            Ringkasan Pendaftaran
        </h2>


        <dl class="summary-list">

            <dt>
                Nama
            </dt>

            <dd>
                <?= e($name) ?>
            </dd>


            <dt>
                Email
            </dt>

            <dd>
                <?= e($email) ?>
            </dd>


            <dt>
                Nomor HP
            </dt>

            <dd>
                <?= e($phone) ?>
            </dd>


            <dt>
                Program Studi
            </dt>

            <dd>
                <?= e($studyProgram) ?>
            </dd>


            <dt>
                Kursus
            </dt>

            <dd>
                <?= e($course) ?>
            </dd>


            <dt>
                Jenis Peserta
            </dt>

            <dd>
                <?= e($participantType) ?>
            </dd>


            <dt>
                Minat
            </dt>

            <dd>
                <?= e($interestText) ?>
            </dd>


            <dt>
                Catatan
            </dt>

            <dd>
                <?= e($note) ?>
            </dd>


            <dt>
                Sumber
            </dt>

            <dd>
                <?= e($source) ?>
            </dd>

        </dl>


        <br>


        <a
            href="registration.php"
            class="btn-link"
        >
            Kembali ke Formulir
        </a>

    </section>

</main>

</body>

</html>