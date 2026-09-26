<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar Kursus - KursusKu</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body>

<header class="site-header">

    <div class="container nav-container">

        <a href="index.php" class="brand">

            <span class="brand-icon">K</span>

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


<main>

<section class="registration-page">

    <div class="container registration-grid">


        <!-- INFORMASI -->

        <div class="registration-info">

            <span class="page-label">
                PENDAFTARAN KURSUS
            </span>

            <h1>
                Mulai perjalanan
                <span>belajarmu.</span>
            </h1>

            <p>
                Isi data di bawah untuk mendaftarkan diri
                ke kursus pilihanmu.
            </p>


            <div class="registration-benefits">

                <div>
                    <span>✓</span>
                    <div>
                        <strong>Materi Terstruktur</strong>
                        <small>
                            Materi dibuat bertahap dan mudah diikuti.
                        </small>
                    </div>
                </div>

                <div>
                    <span>✓</span>
                    <div>
                        <strong>Belajar Fleksibel</strong>
                        <small>
                            Belajar kapan saja sesuai waktumu.
                        </small>
                    </div>
                </div>

                <div>
                    <span>✓</span>
                    <div>
                        <strong>Project Praktik</strong>
                        <small>
                            Belajar melalui latihan dan project.
                        </small>
                    </div>
                </div>

            </div>

        </div>


        <!-- FORM -->

        <div class="form-card">

            <div class="form-card-header">

                <span>
                    FORM PENDAFTARAN
                </span>

                <h2>
                    Data Peserta
                </h2>

                <p>
                    Lengkapi data berikut dengan benar.
                </p>

            </div>


            <form
                action="process-registration.php"
                method="GET"
                class="registration-form"
            >

                <input
                    type="hidden"
                    name="source"
                    value="week-05"
                >


                <div class="form-group">

                    <label for="name">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                </div>


                <div class="form-grid-2">

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@email.com"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="phone">
                            Nomor HP
                        </label>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="08xxxxxxxxxx"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="study_program">
                        Program Studi
                    </label>

                    <select
                        id="study_program"
                        name="study_program"
                        required
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


                <div class="form-group">

                    <label for="course">
                        Pilih Kursus
                    </label>

                    <select
                        id="course"
                        name="course"
                        required
                    >

                        <option value="">
                            -- Pilih Kursus --
                        </option>

                        <option value="web-dasar">
                            Web Development Dasar — Rp149.000
                        </option>

                        <option value="ui-ux">
                            UI/UX Design — Rp179.000
                        </option>

                        <option value="python">
                            Python untuk Pemula — Rp199.000
                        </option>

                    </select>

                </div>


                <fieldset>

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
                                value="umum"
                            >

                            <span>
                                Umum
                            </span>

                        </label>

                    </div>

                </fieldset>


                <fieldset>

                    <legend>
                        Minat Belajar
                    </legend>

                    <div class="choice-grid">

                        <label class="choice">

                            <input
                                type="checkbox"
                                name="interests[]"
                                value="web-development"
                            >

                            <span>
                                Web Development
                            </span>

                        </label>


                        <label class="choice">

                            <input
                                type="checkbox"
                                name="interests[]"
                                value="ui-ux"
                            >

                            <span>
                                UI/UX
                            </span>

                        </label>


                        <label class="choice">

                            <input
                                type="checkbox"
                                name="interests[]"
                                value="programming"
                            >

                            <span>
                                Programming
                            </span>

                        </label>


                        <label class="choice">

                            <input
                                type="checkbox"
                                name="interests[]"
                                value="digital"
                            >

                            <span>
                                Digital
                            </span>

                        </label>

                    </div>

                </fieldset>


                <div class="form-group">

                    <label for="note">
                        Catatan
                    </label>

                    <textarea
                        id="note"
                        name="note"
                        rows="4"
                        placeholder="Tulis catatan jika ada..."
                    ></textarea>

                </div>


                <div class="form-actions">

    <a
        href="index.php"
        class="btn btn-light"
    >
        ← Kembali
    </a>

    <a
        href="process-registration.php?source=week-05&name=Tes+GET&email=test%40kursusku.com&phone=08123456789&study_program=PTIK&course=web-dasar&participant_type=mahasiswa&interests%5B%5D=web-development&note=Percobaan+GET"
        class="btn btn-dark"
    >
        ↗ Tes GET
    </a>

    <button
        type="submit"
        class="btn btn-yellow"
    >
        ✓ Daftar Sekarang
    </button>

</div>
            </form>

        </div>

    </div>

</section>

</main>


<footer>

    <div class="copyright">
        © 2026 KursusKu
    </div>

</footer>

</body>

</html>