<?php

require_once __DIR__ . '/helpers.php';

$courses = [
    [
        'code' => 'WEB-01',
        'name' => 'Web Dasar',
        'fee' => 200000,
        'quota' => 30,
        'registered' => 12,
        'start_date' => '2026-09-21'
    ],
    [
        'code' => 'PHP-01',
        'name' => 'PHP Dasar',
        'fee' => 250000,
        'quota' => 30,
        'registered' => 18,
        'start_date' => '2026-09-22'
    ],
    [
        'code' => 'PHP-02',
        'name' => 'PHP Lanjutan',
        'fee' => 300000,
        'quota' => 25,
        'registered' => 24,
        'start_date' => '2026-09-24'
    ],
    [
        'code' => 'LAR-01',
        'name' => 'Laravel Fundamental',
        'fee' => 350000,
        'quota' => 25,
        'registered' => 25,
        'start_date' => '2026-09-28'
    ],
    [
        'code' => 'DB-01',
        'name' => 'MySQL Dasar',
        'fee' => 275000,
        'quota' => 20,
        'registered' => 0,
        'start_date' => '2026-10-01'
    ],
    [
        'code' => 'UI-01',
        'name' => 'UI Web Dasar',
        'fee' => 225000,
        'quota' => 35,
        'registered' => 9,
        'start_date' => '2026-10-03'
    ],
];

?>

<!DOCTYPE html>
<html lang="id">

<head><link rel="stylesheet" href="assets/css/style.css">

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Katalog KursusKu</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head><link rel="stylesheet" href="assets/css/style.css">

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

    <section class="page-intro">

        <p class="eyebrow">
            Kursus Online
        </p>

        <h1>
            Katalog KursusKu
        </h1>

        <p>
            Pilih kursus yang sesuai dengan kebutuhan belajar kamu.
        </p>

        <a
            href="registration.php"
            class="btn-primary"
        >
            Daftar Kursus
        </a>

    </section>


    <section class="form-card">

        <h2>Daftar Kursus</h2>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Kode</th>
                        <th>Nama Kursus</th>
                        <th>Biaya</th>
                        <th>Tanggal Mulai</th>
                        <th>Sisa Kursi</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($courses as $course): ?>

                        <?php

                        $status = statusKursus(
                            $course['quota'],
                            $course['registered']
                        );

                        $statusClass = $status === 'Penuh'
                            ? 'badge-full'
                            : 'badge-available';

                        ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($course['code']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    trim($course['name'])
                                ) ?>
                            </td>

                            <td>
                                <?= rupiah($course['fee']) ?>
                            </td>

                            <td>
                                <?= formatTanggal(
                                    $course['start_date']
                                ) ?>
                            </td>

                            <td>
                                <?= sisaKursi(
                                    $course['quota'],
                                    $course['registered']
                                ) ?>
                            </td>

                            <td>

                                <span class="<?= $statusClass ?>">
                                    <?= htmlspecialchars($status) ?>
                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </section>

</main>

</body>

</html>