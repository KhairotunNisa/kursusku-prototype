<?php

require __DIR__ . '/helpers.php';

$testCases = [
    [
        'no' => 1,
        'scenario' => 'Pendaftaran mahasiswa',
        'data' => 'Mahasiswa, Web Dasar, 1 peserta',
        'expected' => 'Total Rp240.000',
    ],
    [
        'no' => 2,
        'scenario' => 'Pendaftaran guru',
        'data' => 'Guru, PHP Dasar, 1 peserta',
        'expected' => 'Total Rp340.000',
    ],
    [
        'no' => 3,
        'scenario' => 'Pendaftaran umum',
        'data' => 'Umum, Laravel Dasar, 1 peserta',
        'expected' => 'Total Rp500.000',
    ],
    [
        'no' => 4,
        'scenario' => 'Pendaftaran mahasiswa 2 peserta',
        'data' => 'Mahasiswa, Web Dasar, 2 peserta',
        'expected' => 'Total Rp480.000',
    ],
    [
        'no' => 5,
        'scenario' => 'Nama dikosongkan',
        'data' => 'Nama kosong',
        'expected' => 'Pesan nama wajib diisi',
    ],
    [
        'no' => 6,
        'scenario' => 'Email tidak valid',
        'data' => 'Email dengan format salah',
        'expected' => 'Pesan email tidak valid',
    ],
    [
        'no' => 7,
        'scenario' => 'Tidak memilih minat',
        'data' => 'Tidak ada checkbox dipilih',
        'expected' => 'Belum memilih minat',
    ],
    [
        'no' => 8,
        'scenario' => 'Memilih beberapa minat',
        'data' => 'Web Development, UI/UX, Python',
        'expected' => 'Semua minat tampil',
    ],
    [
        'no' => 9,
        'scenario' => 'Metode offline',
        'data' => 'Mode belajar offline',
        'expected' => 'Tatap Muka',
    ],
    [
        'no' => 10,
        'scenario' => 'Metode hybrid',
        'data' => 'Mode belajar hybrid',
        'expected' => 'Hybrid',
    ],
    [
        'no' => 11,
        'scenario' => 'Akses process tanpa POST',
        'data' => 'GET process-registration.php',
        'expected' => 'Redirect ke registration.php',
    ],
    [
        'no' => 12,
        'scenario' => 'Menampilkan fasilitas',
        'data' => 'Data fasilitas tersedia',
        'expected' => 'Semua fasilitas tampil',
    ],
];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Test Matrix - KursusKu</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body class="test-case-page">

<main class="test-case-container">

    <div class="test-case-card">

        <h1>
            Test Matrix Pertemuan 6
        </h1>

        <div class="test-table-wrapper">

            <table class="test-case-table">

                <thead>

                    <tr>
                        <th>No.</th>
                        <th>Skenario Pengujian</th>
                        <th>Data Uji</th>
                        <th>Hasil yang Diharapkan</th>
                        <th>Hasil Aktual</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($testCases as $index => $test): ?>

                        <tr>

                            <td>
                                <?= e((string) $test['no']) ?>
                            </td>

                            <td>
                                <?= e($test['scenario']) ?>
                            </td>

                            <td>
                                <?= e($test['data']) ?>
                            </td>

                            <td>
                                <?= e($test['expected']) ?>
                            </td>

                            <td>

                                <input
                                    type="text"
                                    class="actual-input"
                                    placeholder="Isi hasil aktual"
                                >

                            </td>

                            <td>

                                <select class="status-select">

                                    <option value="belum-diuji">
                                        Belum diuji
                                    </option>

                                    <option
                                        value="pass"
                                        <?= $index === 0 ? 'selected' : '' ?>
                                    >
                                        PASS
                                    </option>

                                    <option value="fail">
                                        FAIL
                                    </option>

                                </select>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</main>

</body>

</html>