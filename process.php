<?php 
 
declare(strict_types=1); 
 
require __DIR__ . '/data.php'; 
require __DIR__ . '/helpers.php'; 
?> 

<!doctype html> 
<html lang="id"> 

<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <title>Daftar Kursus - KursusKu</title> 

    <link rel="stylesheet" href="assets/css/style.css"> 
</head> 

<body class="utility-page">

<main class="utility-card form-card">

    <span class="registration-label">
    PENDAFTARAN KURSUS
</span> 

    <h1>
        Daftar Kursus
    </h1>

    <p>
        Alur: landing page → form → proses PHP → ringkasan.
        Belum memakai database.
    </p>


    <form
        method="POST"
        action="process-registration.php"
        class="stack-form"
    >


        <!-- ==============================
             NAMA DAN EMAIL
             ============================== -->

        <div class="form-grid">

            <div class="field">

                <label for="name">
                    Nama lengkap
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    required
                    minlength="3"
                    maxlength="80"
                >

            </div>


            <div class="field">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    maxlength="120"
                >

            </div>

        </div>


        <!-- ==============================
             PILIH KURSUS
             ============================== -->

        <div class="field">

            <label for="course_code">
                Pilih kursus
            </label>

            <select
                id="course_code"
                name="course_code"
                required
            >

                <option value="">
                    -- Pilih kursus --
                </option>

                <?php foreach ($courses as $course): ?>

                    <option
                        value="<?= e($course['code']) ?>"
                    >

                        <?= e($course['name']) ?>
                        -
                        <?= formatRupiah($course['fee']) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- ==============================
             TIPE PESERTA
             ============================== -->

        <fieldset class="field">

            <legend>
                Tipe peserta
            </legend>

            <div class="choice-row">

                <label>
                    <input
                        type="radio"
                        name="participant_type"
                        value="mahasiswa"
                        required
                    >

                    Mahasiswa
                </label>


                <label>
                    <input
                        type="radio"
                        name="participant_type"
                        value="guru"
                    >

                    Guru
                </label>


                <label>
                    <input
                        type="radio"
                        name="participant_type"
                        value="umum"
                    >

                    Umum
                </label>

            </div>

        </fieldset>


        <!-- ==============================
             METODE BELAJAR
             ============================== -->

        <div class="form-grid">

            <div class="field">

                <label for="learning_mode">
                    Metode belajar
                </label>

                <select
                    id="learning_mode"
                    name="learning_mode"
                    required
                >

                    <option value="">
                        -- Pilih metode --
                    </option>

                    <option value="offline">
                        Tatap muka
                    </option>

                    <option value="online">
                        Online
                    </option>

                    <option value="hybrid">
                        Hybrid
                    </option>

                </select>

            </div>


            <!-- ==============================
                 JUMLAH PAKET
                 ============================== -->

            <div class="field">

                <label for="package_count">
                    Jumlah paket
                </label>

                <select
                    id="package_count"
                    name="package_count"
                    required
                >

                    <option value="">
                        -- Pilih jumlah paket --
                    </option>

                    <?php for ($i = 1; $i <= 3; $i++): ?>

                        <option value="<?= $i ?>">
                            <?= $i ?> paket
                        </option>

                    <?php endfor; ?>

                </select>

            </div>

        </div>


        <!-- ==============================
             CATATAN
             ============================== -->

        <div class="field">

            <label for="notes">
                Catatan tambahan
            </label>

            <textarea
                id="notes"
                name="notes"
                rows="4"
                maxlength="300"
            ></textarea>

        </div>


        <!-- ==============================
             BUTTON
             ============================== -->

        <div class="button-row">

            <button
                class="button"
                type="submit"
            >
                Proses Pendaftaran
            </button>


            <a
                class="button button-secondary"
                href="history.php"
            >
                History Dummy
            </a>


            <a
                class="button button-secondary"
                href="loop-lab.php"
            >
                Loop Lab
            </a>

        </div>

    </form>


    <!-- ==============================
         FASILITAS
         ============================== -->

    <section class="formula-box">

        <strong>
            Fasilitas
        </strong>

        <ul>

            <?php foreach ($facilities as $facility): ?>

                <li>
                    <?= e($facility) ?>
                </li>

            <?php endforeach; ?>

        </ul>

    </section>

</main>

</body>
</html>
