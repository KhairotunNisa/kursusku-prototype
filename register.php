```php
<?php

declare(strict_types=1);

session_start();

/*
|--------------------------------------------------------------------------
| DATA KURSUS
|--------------------------------------------------------------------------
*/

$courses = [
    'WEB' => [
        'name'  => 'Web Dasar',
        'price' => 300000
    ],
    'PHP' => [
        'name'  => 'PHP Dasar',
        'price' => 400000
    ],
    'LARAVEL' => [
        'name'  => 'Laravel Dasar',
        'price' => 500000
    ],
];

/*
|--------------------------------------------------------------------------
| DATA MINAT BELAJAR
|--------------------------------------------------------------------------
*/

$interestOptions = [
    'frontend' => 'Frontend',
    'backend'  => 'Backend',
    'uiux'     => 'UI/UX Design',
    'database' => 'Database',
];

/*
|--------------------------------------------------------------------------
| DATA FORM SEBELUMNYA
|--------------------------------------------------------------------------
|
| Data ini digunakan untuk mengisi ulang form apabila
| process-registration.php mengembalikan pengguna
| karena validasi gagal.
|
*/

$old = $_SESSION['old_registration'] ?? [];

if (!is_array($old)) {
    $old = [];
}

unset($_SESSION['old_registration']);

/*
|--------------------------------------------------------------------------
| FUNGSI ESCAPE OUTPUT
|--------------------------------------------------------------------------
*/

function registerEscape($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

/*
|--------------------------------------------------------------------------
| DATA MINAT YANG DIPILIH
|--------------------------------------------------------------------------
*/

$selectedInterests = $old['interests'] ?? [];

if (!is_array($selectedInterests)) {
    $selectedInterests = [];
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

    <title>Form Pendaftaran - KursusKu</title>

    <link rel="stylesheet" href="style.css">

    <style>
        /* =========================================
           STYLE TAMBAHAN REGISTER
        ========================================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #fffdf5;
            color: #171717;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            padding: 18px 6%;
            background: #171717;
            border-bottom: 5px solid #ffd229;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 21px;
            font-weight: 800;
            text-decoration: none;
        }

        .brand > span:last-child > span {
            color: #ffd229;
        }

        .brand-icon {
            display: flex;
            width: 38px;
            height: 38px;
            align-items: center;
            justify-content: center;
            background: #ffd229;
            border-radius: 10px;
            color: #171717;
            font-weight: 900;
        }

        .nav-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
        }

        .nav-links a {
            color: #fff;
            font-size: 13px;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: #ffd229;
        }

        .page-wrapper {
            width: 100%;
            padding: 42px 18px 55px;
        }

        .form-card {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
            padding: 32px;
            background: #fff;
            border: 1px solid #eee5c9;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .eyebrow {
            display: inline-block;
            padding: 8px 12px;
            margin-bottom: 13px;
            background: #fff1a8;
            border: 1px solid #171717;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.8px;
        }

        .form-heading h1 {
            margin: 0 0 10px;
            font-size: clamp(28px, 4vw, 38px);
        }

        .form-heading p {
            margin: 0;
            color: #6b6b6b;
            font-size: 14px;
            line-height: 1.7;
        }

        .alert-error {
            padding: 16px 18px;
            margin-bottom: 24px;
            background: #fff0ed;
            border: 1px solid #e9aaa0;
            border-radius: 10px;
            color: #8d2920;
            font-size: 14px;
        }

        .alert-error ul {
            margin-bottom: 0;
            padding-left: 22px;
            line-height: 1.8;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 21px 18px;
        }

        .form-group {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 9px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group > label,
        .interests-box legend {
            font-size: 13px;
            font-weight: 800;
        }

        .form-group input:not([type="checkbox"]),
        .form-group select,
        .form-group textarea {
            width: 100%;
            min-height: 46px;
            padding: 12px 13px;
            background: #fff;
            border: 1px solid #d9d5c8;
            border-radius: 8px;
            color: #171717;
            font: inherit;
            font-size: 14px;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: 2px solid #ffd229;
            border-color: #171717;
        }

        .interests-box {
            min-width: 0;
            padding: 17px;
            border: 1px solid #e1ddcf;
            border-radius: 10px;
        }

        .interests-box legend {
            padding: 0 7px;
        }

        .field-hint {
            margin: 0 0 12px;
            color: #777;
            font-size: 12px;
        }

        .checkbox-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px;
            background: #fffdf5;
            border: 1px solid #eee5c9;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
        }

        .checkbox-item input {
            width: 16px;
            height: 16px;
            accent-color: #d7a900;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            display: inline-flex;
            min-height: 46px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 19px;
            border: 1px solid #171717;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: #ffd229;
            color: #171717;
        }

        .btn-secondary {
            background: #fff;
            color: #171717;
        }

        .footer {
            padding: 23px 15px;
            border-top: 1px solid #eee5c9;
            color: #777;
            text-align: center;
            font-size: 13px;
        }

        @media (max-width: 650px) {
            .topbar {
                padding: 16px 5%;
            }

            .nav-links {
                gap: 12px;
            }

            .nav-links a {
                font-size: 12px;
            }

            .page-wrapper {
                padding: 25px 12px 35px;
            }

            .form-card {
                padding: 22px 17px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .checkbox-list {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->

    <header class="topbar">

        <a href="index.php" class="brand">
            <span class="brand-icon">K</span>
            <span>Kursus<span>Ku</span></span>
        </a>

        <nav class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="index.php#kursus">Katalog</a>
            <a href="history.php">History Dummy</a>
            <a href="loop-lab.php">Loop Lab</a>
        </nav>

    </header>

    <!-- FORM PENDAFTARAN -->

    <main class="page-wrapper">

        <section class="form-card">

            <div class="form-heading">

                <span class="eyebrow">
                    KURSUS ONLINE &amp; OFFLINE
                </span>

                <h1>Daftar Kursus</h1>

                <p>
                    Lengkapi data berikut untuk memulai perjalanan
                    belajar kamu bersama KursusKu.
                </p>

            </div>

            <!-- PESAN ERROR -->

            <?php if (!empty($_SESSION['form_errors'])
                && is_array($_SESSION['form_errors'])): ?>

                <div class="alert-error">

                    <strong>Periksa kembali data kamu:</strong>

                    <ul>
                        <?php foreach ($_SESSION['form_errors'] as $error): ?>
                            <li><?= registerEscape($error) ?></li>
                        <?php endforeach; ?>
                    </ul>

                </div>

                <?php unset($_SESSION['form_errors']); ?>

            <?php endif; ?>

            <!-- FORM -->

            <form
                action="process-registration.php"
                method="POST"
                class="registration-form"
            >

                <div class="form-grid">

                    <!-- NAMA -->

                    <div class="form-group">

                        <label for="name">Nama Lengkap</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Masukkan nama lengkap"
                            value="<?= registerEscape($old['name'] ?? '') ?>"
                            autocomplete="name"
                            required
                        >

                    </div>

                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">Email</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="contoh@email.com"
                            value="<?= registerEscape($old['email'] ?? '') ?>"
                            autocomplete="email"
                            required
                        >

                    </div>

                    <!-- NOMOR HP -->

                    <div class="form-group">

                        <label for="phone">Nomor HP</label>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="08xxxxxxxxxx"
                            value="<?= registerEscape($old['phone'] ?? '') ?>"
                            autocomplete="tel"
                            required
                        >

                    </div>

                    <!-- PROGRAM STUDI -->

                    <div class="form-group">

                        <label for="study_program">Program Studi</label>

                        <input
                            type="text"
                            id="study_program"
                            name="study_program"
                            placeholder="Contoh: PTIK"
                            value="<?= registerEscape($old['study_program'] ?? '') ?>"
                            required
                        >

                    </div>

                    <!-- PILIH KURSUS -->

                    <div class="form-group full-width">

                        <label for="course_code">Pilih Kursus</label>

                        <select
                            id="course_code"
                            name="course_code"
                            required
                        >

                            <option value="">-- Pilih Kursus --</option>

                            <?php foreach ($courses as $code => $course): ?>

                                <option
                                    value="<?= registerEscape($code) ?>"
                                    <?= (($old['course_code'] ?? '') === $code)
                                        ? 'selected'
                                        : '' ?>
                                >
                                    <?= registerEscape($course['name']) ?>
                                    — Rp<?= number_format(
                                        $course['price'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- TIPE PESERTA -->

                    <div class="form-group">

                        <label for="participant_type">Tipe Peserta</label>

                        <select
                            id="participant_type"
                            name="participant_type"
                            required
                        >

                            <option value="">-- Pilih Tipe --</option>

                            <option
                                value="mahasiswa"
                                <?= (($old['participant_type'] ?? '') === 'mahasiswa')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Mahasiswa (diskon 20%)
                            </option>

                            <option
                                value="guru"
                                <?= (($old['participant_type'] ?? '') === 'guru')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Guru (diskon 15%)
                            </option>

                            <option
                                value="umum"
                                <?= (($old['participant_type'] ?? '') === 'umum')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Umum (tanpa diskon)
                            </option>

                        </select>

                    </div>

                    <!-- METODE BELAJAR -->

                    <div class="form-group">

                        <label for="learning_mode">Metode Belajar</label>

                        <select
                            id="learning_mode"
                            name="learning_mode"
                            required
                        >

                            <option value="">-- Pilih Metode --</option>

                            <option
                                value="offline"
                                <?= (($old['learning_mode'] ?? '') === 'offline')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Tatap Muka
                            </option>

                            <option
                                value="online"
                                <?= (($old['learning_mode'] ?? '') === 'online')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Online
                            </option>

                            <option
                                value="hybrid"
                                <?= (($old['learning_mode'] ?? '') === 'hybrid')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Hybrid
                            </option>

                        </select>

                    </div>

                    <!-- JUMLAH PAKET -->

                    <div class="form-group full-width">

                        <label for="package_count">Jumlah Paket</label>

                        <select
                            id="package_count"
                            name="package_count"
                            required
                        >

                            <option value="">-- Pilih Jumlah Paket --</option>

                            <?php for ($i = 1; $i <= 3; $i++): ?>

                                <option
                                    value="<?= $i ?>"
                                    <?= ((string) ($old['package_count'] ?? '1') === (string) $i)
                                        ? 'selected'
                                        : '' ?>
                                >
                                    <?= $i ?> paket
                                </option>

                            <?php endfor; ?>

                        </select>

                    </div>

                    <!-- MINAT BELAJAR -->

                    <fieldset class="form-group full-width interests-box">

                        <legend>Minat Belajar</legend>

                        <p class="field-hint">
                            Kamu boleh memilih lebih dari satu minat.
                        </p>

                        <div class="checkbox-list">

                            <?php foreach ($interestOptions as $value => $label): ?>

                                <label class="checkbox-item">

                                    <input
                                        type="checkbox"
                                        name="interests[]"
                                        value="<?= registerEscape($value) ?>"
                                        <?= in_array(
                                            $value,
                                            $selectedInterests,
                                            true
                                        ) ? 'checked' : '' ?>
                                    >

                                    <span>
                                        <?= registerEscape($label) ?>
                                    </span>

                                </label>

                            <?php endforeach; ?>

                        </div>

                    </fieldset>

                    <!-- CATATAN -->

                    <div class="form-group full-width">

                        <label for="notes">Catatan (opsional)</label>

                        <textarea
                            id="notes"
                            name="notes"
                            rows="4"
                            placeholder="Tulis catatan jika ada..."
                        ><?= registerEscape($old['notes'] ?? '') ?></textarea>

                    </div>

                </div>

                <!-- TOMBOL -->

                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Daftar Sekarang <span>&rarr;</span>
                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </section>

    </main>

    <!-- FOOTER -->

    <footer class="footer">
        <p>
            &copy; <?= date('Y') ?> KursusKu.
            Belajar jadi lebih mudah.
        </p>
    </footer>

</body>
</html>
