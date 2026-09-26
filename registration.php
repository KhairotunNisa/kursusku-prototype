<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Daftar Kursus - KursusKu
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
            Pendaftaran Kursus
        </p>

        <h1>
            Daftar Kursus
        </h1>

        <p>
            Isi data berikut untuk melakukan pendaftaran.
        </p>

    </section>



    <!-- =====================================================
         FORM
         ===================================================== -->

    <section class="form-card">


        <!-- =================================================
             INI ADALAH FORM POST
             =================================================

             Perhatikan:

             method="POST"

             Jadi Daftar Sekarang menggunakan POST.

             ================================================= -->

        <form
            action="process-registration.php"
            method="POST"
            class="registration-form"
        >


            <!-- SOURCE -->

            <input
                type="hidden"
                name="source"
                value="week-05"
            >



            <div class="form-grid">


                <!-- NAMA -->

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



                <!-- EMAIL -->

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="contoh@email.com"
                        required
                    >

                </div>



                <!-- NOMOR HP -->

                <div class="form-group">

                    <label for="phone">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="08xxxxxxxxxx"
                        required
                    >

                </div>



                <!-- PROGRAM STUDI -->

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



                <!-- KURSUS -->

                <div class="form-group">

                    <label for="course">
                        Kursus
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
                            Web Dasar
                        </option>

                        <option value="php">
                            PHP
                        </option>

                        <option value="mysql">
                            MySQL
                        </option>

                        <option value="ui-ux">
                            UI/UX Design
                        </option>

                    </select>

                </div>



                <!-- JENIS PESERTA -->

                <div class="form-group">

                    <label>
                        Jenis Peserta
                    </label>


                    <div class="choice-group">


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
                                value="pelajar"
                            >

                            <span>
                                Pelajar
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

                </div>



                <!-- MINAT BELAJAR -->

                <div class="form-group">

                    <label>
                        Minat Belajar
                    </label>


                    <div class="choice-group">


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
                                value="database"
                            >

                            <span>
                                Database
                            </span>

                        </label>


                    </div>

                </div>



                <!-- CATATAN -->

                <div class="form-group full-width">

                    <label for="note">
                        Catatan
                    </label>

                    <textarea
                        id="note"
                        name="note"
                        rows="5"
                        placeholder="Tulis catatan jika ada..."
                    ></textarea>

                </div>


            </div>



            <!-- =================================================
                 TOMBOL
                 ================================================= -->

            <div class="form-actions">


                <!-- KEMBALI -->

                <a
                    href="index.php"
                    class="btn-secondary"
                >
                    Kembali
                </a>



                <!-- POST -->

                <button
                    type="submit"
                    class="btn-primary"
                >
                    ✓ Daftar Sekarang
                </button>



                <!-- =================================================
                     GET
                     =================================================

                     INI TOMBOL GET.

                     Klik tombol ini untuk menguji GET.

                     ================================================= -->

                <a
                    href="process-registration.php?method=get&name=Tes+GET&email=test%40kursusku.com&phone=08123456789&study_program=PTIK&course=web-dasar&participant_type=mahasiswa&interests%5B%5D=web-development&note=Percobaan+GET&source=week-05"
                    class="btn-secondary"
                >
                    ↗ Tes GET
                </a>


            </div>


        </form>

    </section>


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