<?php

declare(strict_types=1);

require __DIR__ . '/helpers.php';


// =====================================================
// LOOP FOR
// =====================================================

$forItems = [];

for ($i = 1; $i <= 3; $i++) {
    $forItems[] = "Paket ke-$i";
}


// =====================================================
// LOOP WHILE
// =====================================================

$whileItems = [];

$i = 1;

while ($i <= 3) {
    $whileItems[] = "While ke-$i";
    $i++;
}


// =====================================================
// LOOP DO WHILE
// =====================================================

$doWhileItems = [];

$i = 1;

do {
    $doWhileItems[] = "Percobaan ke-$i";
    $i++;
} while ($i <= 3);

?>

<!doctype html>

<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Loop Lab - KursusKu
    </title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body class="utility-page">


<main class="utility-card">


    <!-- =================================================
         JUDUL
         ================================================= -->

    <span class="eyebrow">
        MILESTONE 6 · LOOPING
    </span>


    <h1>
        Loop Lab
    </h1>


    <p>
        Halaman latihan untuk memahami
        perulangan <strong>for</strong>,
        <strong>while</strong>,
        dan <strong>do-while</strong>
        pada PHP.
    </p>



    <!-- =================================================
         HASIL LOOPING
         ================================================= -->

    <div class="feature-grid">


        <!-- =========================
             FOR
             ========================= -->

        <article class="feature-card">

            <h2>
                for
            </h2>

            <p>

                <?php foreach ($forItems as $item): ?>

                    <?= e($item) ?><br>

                <?php endforeach; ?>

            </p>

        </article>



        <!-- =========================
             WHILE
             ========================= -->

        <article class="feature-card">

            <h2>
                while
            </h2>

            <p>

                <?php foreach ($whileItems as $item): ?>

                    <?= e($item) ?><br>

                <?php endforeach; ?>

            </p>

        </article>



        <!-- =========================
             DO WHILE
             ========================= -->

        <article class="feature-card">

            <h2>
                do-while
            </h2>

            <p>

                <?php foreach ($doWhileItems as $item): ?>

                    <?= e($item) ?><br>

                <?php endforeach; ?>

            </p>

        </article>


    </div>



    <!-- =================================================
         TOMBOL KEMBALI
         ================================================= -->

    <p>

        <a
            class="button"
            href="registration.php"
        >
            Kembali
        </a>

    </p>


</main>


</body>

</html>