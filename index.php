<?php
require_once 'helpers.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>KursusKu</title>

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

    <section class="page-intro">

        <p class="eyebrow">
            Kursus Online
        </p>

        <h1>
            Belajar Skill Baru Bersama KursusKu
        </h1>

        <p>
            Pilih kursus yang sesuai dan mulai belajar
            sekarang.
        </p>

    </section>


    <!-- =====================================================
         BAGIAN TOMBOL
         ===================================================== -->

    <section class="card">

        <h2>
            Pendaftaran Kursus
        </h2>

        <p>
            Silakan pilih salah satu tombol berikut.
        </p>


        <div class="form-actions">


            <!-- =================================================
                 TOMBOL DAFTAR SEKARANG
                 ================================================= -->

            <a
                href="registration.php"
                class="btn-primary"
            >
                ✓ Daftar Sekarang
            </a>


            <!-- =================================================
                 TOMBOL TES GET
                 =================================================

                 INI ADALAH BAGIAN GET.

                 Data dikirim melalui URL setelah tanda ?

                 ================================================= -->

            <a
                href="process-registration.php?method=get&name=Tes+GET&email=test%40kursusku.com&phone=08123456789&study_program=PTIK&course=web-dasar&participant_type=mahasiswa&interests%5B%5D=web-development&note=Percobaan+GET&source=week-05"
                class="btn-secondary"
            >
                ↗ Tes GET
            </a>


        </div>

    </section>


    <!-- =====================================================
         KATALOG
         ===================================================== -->

    <section class="content-card">

        <h2>
            Katalog Kursus
        </h2>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Kursus</th>
                        <th>Kategori</th>
                        <th>Level</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>Web Dasar</td>
                        <td>Web Development</td>
                        <td>Pemula</td>
                    </tr>

                    <tr>
                        <td>PHP</td>
                        <td>Programming</td>
                        <td>Menengah</td>
                    </tr>

                    <tr>
                        <td>MySQL</td>
                        <td>Database</td>
                        <td>Pemula</td>
                    </tr>

                    <tr>
                        <td>UI/UX Design</td>
                        <td>Design</td>
                        <td>Pemula</td>
                    </tr>

                </tbody>

            </table>

        </div>

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