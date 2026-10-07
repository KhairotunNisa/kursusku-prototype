<?php

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar Kursus - KursusKu</title>


    <style>

        /* =====================================================
           RESET
           ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================================
           BODY
           ===================================================== */

        body {

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f5f7f8;

            color: #14213d;

            min-height: 100vh;

        }


        /* =====================================================
           HEADER
           ===================================================== */

        .site-header {

            background: #ffffff;

            border-bottom: 1px solid #e5e5e5;

            padding: 16px 0;

        }


        .container {

            width: min(1200px, 92%);

            margin: 0 auto;

        }


        .nav-container {

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        /* =====================================================
           LOGO
           ===================================================== */

        .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            text-decoration: none;

            color: #111111;

            font-size: 22px;

            font-weight: 800;

        }


        .brand-icon {

            width: 40px;

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffd21f;

            border-radius: 12px;

            color: #111111;

            font-weight: 900;

        }


        .brand-name span {

            color: #e9b800;

        }


        /* =====================================================
           NAVIGASI
           ===================================================== */

        .nav-links {

            display: flex;

            align-items: center;

            gap: 28px;

        }


        .nav-links a {

            text-decoration: none;

            color: #17233d;

            font-weight: 700;

            transition: .2s;

        }


        .nav-links a:hover {

            color: #eab900;

        }


        /* =====================================================
           AREA PENDAFTARAN
           ===================================================== */

        .registration-section {

            padding: 55px 0 70px;

            background:
                linear-gradient(
                    90deg,
                    #fffdf5 0%,
                    #fff9df 100%
                );

        }


        .registration-layout {

            display: grid;

            grid-template-columns:
                0.85fr 1.15fr;

            gap: 45px;

            align-items: start;

        }


        /* =====================================================
           BAGIAN KIRI
           ===================================================== */

        .registration-info {

            padding-top: 30px;

        }


        .page-label {

            display: inline-block;

            padding: 9px 16px;

            border-radius: 30px;

            background: #fff0a6;

            border: 1px solid #f0c51c;

            color: #765900;

            font-size: 13px;

            font-weight: 800;

            letter-spacing: .5px;

            margin-bottom: 22px;

        }


        .registration-info h1 {

            font-size: 46px;

            line-height: 1.08;

            color: #111827;

            margin-bottom: 20px;

        }


        .registration-info h1 span {

            color: #efb900;

            display: block;

        }


        .intro-text {

            color: #667085;

            font-size: 17px;

            line-height: 1.7;

            max-width: 480px;

            margin-bottom: 38px;

        }


        /* =====================================================
           BENEFIT
           ===================================================== */

        .registration-benefits {

            display: flex;

            flex-direction: column;

            gap: 25px;

        }


        .benefit-item {

            display: flex;

            align-items: flex-start;

            gap: 16px;

        }


        .benefit-icon {

            width: 45px;

            height: 45px;

            min-width: 45px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #ffd21f;

            color: #111111;

            font-size: 20px;

            font-weight: 900;

        }


        .benefit-item strong {

            display: block;

            color: #111111;

            font-size: 18px;

            margin-bottom: 7px;

        }


        .benefit-item small {

            display: block;

            color: #737b88;

            font-size: 15px;

            line-height: 1.5;

        }


        /* =====================================================
           CARD FORM
           ===================================================== */

        .registration-card {

            background: #ffffff;

            border-radius: 25px;

            padding: 38px;

            box-shadow:
                0 15px 45px
                rgba(0, 0, 0, .08);

            border: 1px solid #eee8cf;

        }


        .registration-card-header {

            margin-bottom: 30px;

        }


        .card-label {

            display: inline-block;

            color: #8a6800;

            font-size: 12px;

            font-weight: 800;

            letter-spacing: .7px;

            margin-bottom: 9px;

        }


        .registration-card-header h2 {

            font-size: 30px;

            color: #111827;

            margin-bottom: 8px;

        }


        .registration-card-header p {

            color: #737b88;

            font-size: 15px;

        }


        /* =====================================================
           FORM
           ===================================================== */

        .registration-form {

            display: flex;

            flex-direction: column;

            gap: 20px;

        }


        .form-group {

            display: flex;

            flex-direction: column;

            gap: 8px;

        }


        .form-group label {

            font-size: 15px;

            font-weight: 800;

            color: #111827;

        }


        .form-group input,
        .form-group select,
        .form-group textarea {

            width: 100%;

            border: 1px solid #d9dce1;

            border-radius: 12px;

            background: #ffffff;

            color: #17233d;

            font-family: inherit;

            font-size: 15px;

            outline: none;

            transition: .2s;

        }


        .form-group input,
        .form-group select {

            height: 56px;

            padding: 0 16px;

        }


        .form-group textarea {

            min-height: 145px;

            padding: 15px 16px;

            resize: vertical;

        }


        .form-group input::placeholder,
        .form-group textarea::placeholder {

            color: #a1a7b0;

        }


        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {

            border-color: #f0c000;

            box-shadow:
                0 0 0 3px
                rgba(255, 210, 31, .16);

        }


        /* =====================================================
           FIELDSET
           ===================================================== */

        .choice-field {

            border: none;

            padding: 0;

            margin: 0;

        }


        .choice-field legend {

            font-size: 15px;

            font-weight: 800;

            color: #111827;

            margin-bottom: 12px;

        }


        .choice-row {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

        }


        .choice-grid {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

        }


        .choice {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 11px 15px;

            background: #fffaf0;

            border: 1px solid #ead28a;

            border-radius: 30px;

            cursor: pointer;

            color: #493d10;

            font-weight: 700;

            transition: .2s;

        }


        .choice:hover {

            background: #fff0a6;

            border-color: #e9bd00;

        }


        .choice input {

            accent-color: #f2bd00;

        }


        /* =====================================================
           TOMBOL
           ===================================================== */

        .registration-actions {

            display: flex;

            align-items: center;

            gap: 10px;

            flex-wrap: wrap;

            margin-top: 8px;

        }


        .btn-reg {

            min-height: 58px;

            padding: 0 21px;

            border-radius: 13px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            text-decoration: none;

            font-family: inherit;

            font-size: 15px;

            font-weight: 800;

            cursor: pointer;

            transition: all .2s ease;

            white-space: nowrap;

        }


        /* =====================================================
           TOMBOL KEMBALI
           ===================================================== */

        .btn-back {

            background: #eeeeee;

            color: #111111;

            border: 2px solid #dddddd;

        }


        .btn-back:hover {

            background: #dddddd;

            transform: translateY(-2px);

        }


        /* =====================================================
           TOMBOL PROSES
           ===================================================== */

        .btn-yellow {

            background: #ffd21f;

            color: #111111;

            border: 2px solid #ffd21f;

        }


        .btn-yellow:hover {

            background: #111111;

            color: #ffd21f;

            border-color: #111111;

            transform: translateY(-2px);

        }


        /* =====================================================
           HISTORY DUMMY
           ===================================================== */

        .btn-history {

            background: #ffffff;

            color: #111111;

            border: 2px solid #111111;

        }


        .btn-history:hover {

            background: #ffd21f;

            border-color: #111111;

            transform: translateY(-2px);

        }


        /* =====================================================
           LOOP LAB
           ===================================================== */

        .btn-loop {

            background: #ffffff;

            color: #111111;

            border: 2px solid #111111;

        }


        .btn-loop:hover {

            background: #ffd21f;

            border-color: #111111;

            transform: translateY(-2px);

        }


        /* =====================================================
           FASILITAS
           ===================================================== */

        .course-facilities {

            background: #111111;

            color: #ffffff;

            border-radius: 18px;

            padding: 27px;

            margin-top: 10px;

        }


        .course-facilities h3 {

            color: #ffd21f;

            font-size: 20px;

            margin-bottom: 18px;

        }


        .course-facilities ul {

            list-style: none;

            display: flex;

            flex-direction: column;

            gap: 14px;

        }


        .course-facilities li {

            font-size: 15px;

            color: #ffffff;

        }


        .course-facilities li::before {

            content: "✓";

            color: #ffd21f;

            font-weight: 900;

            margin-right: 10px;

        }


        /* =====================================================
           FOOTER
           ===================================================== */

        .registration-footer {

            background: #ffffff;

            padding: 25px;

            text-align: center;

            color: #737b88;

            font-size: 14px;

            border-top: 1px solid #e5e5e5;

        }


        /* =====================================================
           RESPONSIVE
           ===================================================== */

        @media (max-width: 1050px) {

            .registration-layout {

                grid-template-columns: 1fr;

            }


            .registration-info {

                padding-top: 0;

            }


            .registration-info h1 {

                font-size: 40px;

            }

        }


        @media (max-width: 750px) {

            .nav-container {

                flex-direction: column;

                gap: 15px;

            }


            .nav-links {

                gap: 20px;

            }


            .registration-section {

                padding: 35px 0 50px;

            }


            .registration-card {

                padding: 25px 20px;

                border-radius: 20px;

            }


            .registration-info h1 {

                font-size: 35px;

            }


            .registration-actions {

                display: grid;

                grid-template-columns: 1fr 1fr;

            }


            .btn-reg {

                width: 100%;

                padding: 0 10px;

                font-size: 13px;

            }

        }


        @media (max-width: 480px) {

            .registration-actions {

                grid-template-columns: 1fr;

            }


            .btn-reg {

                width: 100%;

            }


            .registration-info h1 {

                font-size: 31px;

            }


            .registration-card-header h2 {

                font-size: 25px;

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


        <!-- LOGO -->

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


        <!-- NAVIGASI -->

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


<section class="registration-section">


    <div class="container registration-layout">


        <!-- =================================================
             BAGIAN KIRI
             ================================================= -->

        <div class="registration-info">


            <span class="page-label">
                PENDAFTARAN KURSUS
            </span>


            <h1>

                Mulai perjalanan

                <span>
                    belajarmu.
                </span>

            </h1>


            <p class="intro-text">

                Isi data di bawah untuk mendaftarkan diri
                ke kursus pilihanmu.

            </p>


            <!-- =================================================
                 BENEFIT
                 ================================================= -->

            <div class="registration-benefits">


                <!-- BENEFIT 1 -->

                <div class="benefit-item">

                    <span class="benefit-icon">
                        ✓
                    </span>

                    <div>

                        <strong>
                            Materi Terstruktur
                        </strong>

                        <small>
                            Materi dibuat bertahap dan mudah diikuti.
                        </small>

                    </div>

                </div>


                <!-- BENEFIT 2 -->

                <div class="benefit-item">

                    <span class="benefit-icon">
                        ✓
                    </span>

                    <div>

                        <strong>
                            Belajar Fleksibel
                        </strong>

                        <small>
                            Belajar kapan saja sesuai waktumu.
                        </small>

                    </div>

                </div>


                <!-- BENEFIT 3 -->

                <div class="benefit-item">

                    <span class="benefit-icon">
                        ✓
                    </span>

                    <div>

                        <strong>
                            Project Praktik
                        </strong>

                        <small>
                            Belajar melalui latihan dan project.
                        </small>

                    </div>

                </div>


            </div>


        </div>



        <!-- =================================================
             BAGIAN KANAN / FORM
             ================================================= -->

        <div class="registration-card">


            <!-- HEADER FORM -->

            <div class="registration-card-header">

                <span class="card-label">
                    FORM PENDAFTARAN
                </span>


                <h2>
                    Data Peserta
                </h2>


                <p>
                    Lengkapi informasi berikut dengan benar.
                </p>

            </div>



            <!-- =================================================
                 FORM
                 ================================================= -->

            <form
                action="process-registration.php"
                method="POST"
                class="registration-form"
            >


                <!-- FORM TYPE -->

                <input
                    type="hidden"
                    name="form_type"
                    value="form1"
                >


                <!-- SOURCE -->

                <input
                    type="hidden"
                    name="source"
                    value="week-05"
                >



                <!-- =================================================
                     NAMA
                     ================================================= -->

                <div class="form-group">

                    <label for="name_form1">
                        Nama Lengkap
                    </label>


                    <input
                        type="text"
                        id="name_form1"
                        name="name"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                </div>



                <!-- =================================================
                     EMAIL
                     ================================================= -->

                <div class="form-group">

                    <label for="email_form1">
                        Email
                    </label>


                    <input
                        type="email"
                        id="email_form1"
                        name="email"
                        placeholder="nama@email.com"
                        required
                    >

                </div>



                <!-- =================================================
                     NOMOR HP
                     ================================================= -->

                <div class="form-group">

                    <label for="phone_form1">
                        Nomor HP
                    </label>


                    <input
                        type="tel"
                        id="phone_form1"
                        name="phone"
                        placeholder="08xxxxxxxxxx"
                        required
                    >

                </div>



                <!-- =================================================
                     PROGRAM STUDI
                     ================================================= -->

                <div class="form-group">

                    <label for="study_program_form1">
                        Program Studi
                    </label>


                    <select
                        id="study_program_form1"
                        name="study_program"
                        
                    >

                        <option value="">
                            -- Pilih Program Studi --
                        </option>


                        <option value="PTIK">
                            PTIK
                        </option>


                        <option value="Informatika">
                            Informatika
                        </option>


                        <option value="Sistem Informasi">
                            Sistem Informasi
                        </option>


                        <option value="Manajemen">
                            Manajemen
                        </option>

                    </select>

                </div>



                <!-- =================================================
                     KURSUS
                     ================================================= -->

                <div class="form-group">

                    <label for="course_code_form1">
                        Pilih Kursus
                    </label>


                    <select
                        id="course_code_form1"
                        name="course_code"
                        required
                    >

                        <option value="">
                            -- Pilih Kursus --
                        </option>


                        <?php foreach ($courses as $course): ?>

                            <option
                                value="<?= e($course['code']) ?>"
                            >

                                <?= e($course['name']) ?>

                                —

                                <?= rupiah($course['fee']) ?>

                            </option>

                        <?php endforeach; ?>


                    </select>

                </div>



                <!-- =================================================
                     TIPE PESERTA
                     ================================================= -->

                <fieldset class="choice-field">

                    <legend>
                        Tipe Peserta
                    </legend>


                    <div class="choice-row">


                        <label class="choice">

                            <input
                                type="radio"
                                name="participant_type"
                                value="mahasiswa"
                                required
                            >

                            <span>
                                Mahasiswa
                            </span>

                        </label>


                        <label class="choice">

                            <input
                                type="radio"
                                name="participant_type"
                                value="guru"
                            >

                            <span>
                                Guru
                            </span>

                        </label>


                        <label class="choice">

                            <input
                                type="radio"
                                name="participant_type"
                                value="umum"
                            >

                            <span>
                                Umum
                            </span>

                        </label>


                    </div>

                </fieldset>



                <!-- =================================================
                     MINAT BELAJAR
                     ================================================= -->

                <fieldset class="choice-field">

                    <legend>
                        Minat Belajar
                    </legend>


                    <div class="choice-grid">


                        <?php foreach ($interestOptions as $key => $label): ?>

                            <label class="choice">

                                <input
                                    type="checkbox"
                                    name="interests[]"
                                    value="<?= e($key) ?>"
                                >

                                <span>
                                    <?= e($label) ?>
                                </span>

                            </label>

                        <?php endforeach; ?>


                    </div>

                </fieldset>



                <!-- =================================================
                     METODE BELAJAR
                     ================================================= -->

                <div class="form-group">

                    <label for="learning_mode_form1">
                        Metode Belajar
                    </label>


                    <select
                        id="learning_mode_form1"
                        name="learning_mode"
                        
                    >

                        <option value="">
                            -- Pilih Metode --
                        </option>


                        <option value="offline">
                            Tatap Muka
                        </option>


                        <option value="online">
                            Online
                        </option>


                        <option value="hybrid">
                            Hybrid
                        </option>


                    </select>

                </div>



                <!-- =================================================
                     JUMLAH PAKET
                     ================================================= -->

                <div class="form-group">

                    <label for="package_count_form1">
                        Jumlah Paket
                    </label>


                    <select
                        id="package_count_form1"
                        name="package_count"
                        required
                    >

                        <option value="">
                            -- Pilih Paket --
                        </option>


                        <option value="1">
                            1 Paket
                        </option>


                        <option value="2">
                            2 Paket
                        </option>


                        <option value="3">
                            3 Paket
                        </option>


                    </select>

                </div>



                <!-- =================================================
                     CATATAN
                     ================================================= -->

                <div class="form-group">

                    <label for="notes_form1">
                        Catatan Tambahan
                    </label>


                    <textarea
                        id="notes_form1"
                        name="notes"
                        maxlength="300"
                        placeholder="Tulis catatan jika ada..."
                    ></textarea>

                </div>



                <!-- =================================================
                     TOMBOL
                     ================================================= -->

                <div class="registration-actions">


                    <!-- KEMBALI -->

                    <a
                        href="index.php"
                        class="btn-reg btn-back"
                    >
                        ← Kembali
                    </a>



                    <!-- PROSES PENDAFTARAN -->

                    <button
                        type="submit"
                        class="btn-reg btn-yellow"
                    >
                        ✓ Proses Pendaftaran
                    </button>



                    <!-- HISTORY DUMMY -->

                    <a
                        href="history.php"
                        class="btn-reg btn-history"
                    >
                        🕘 History Dummy
                    </a>



                    <!-- LOOP LAB -->

                    <a
                        href="loop-lab.php"
                        class="btn-reg btn-loop"
                    >
                        ∞ Loop Lab
                    </a>


                </div>



                <!-- =================================================
                     FASILITAS
                     ================================================= -->

                <div class="course-facilities">


                    <h3>
                        Fasilitas Kursus
                    </h3>


                    <ul>

                        <li>
                            Modul digital
                        </li>

                        <li>
                            Sertifikat penyelesaian
                        </li>

                        <li>
                            Forum diskusi kelas
                        </li>

                    </ul>


                </div>


            </form>


        </div>


    </div>


</section>


</main>



<!-- =====================================================
     FOOTER
     ===================================================== -->

<footer class="registration-footer">

    <p>
        © 2026 KursusKu — Belajar Skill Digital
    </p>

</footer>


</body>

</html>