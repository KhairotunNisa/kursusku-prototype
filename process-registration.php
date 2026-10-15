
<?php
session_start();

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

/* 1. Pastikan request menggunakan POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registration.php');
    exit;
}

/* 2. Ambil data dari form */
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$studyProgram = trim($_POST['study_program'] ?? '');
$courseCode = trim($_POST['course_code'] ?? '');
$participantType = trim($_POST['participant_type'] ?? '');
$learningMode = trim($_POST['learning_mode'] ?? '');
$packageCount = (int) ($_POST['package_count'] ?? 1);
$notes = trim($_POST['notes'] ?? '');

$interests = $_POST['interests'] ?? [];

/* 3. Pastikan checkbox berupa array */
if (!is_array($interests)) {
    $interests = [];
}

/* 4. Validasi checkbox */
$allowedInterestKeys = array_keys($interestOptions);

$interests = array_values(
    array_intersect($interests, $allowedInterestKeys)
);

/* 5. Validasi data */
$errors = [];

if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

if ($phone === '') {
    $errors[] = 'Nomor HP wajib diisi.';
}

if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
    $errors[] = 'Tipe peserta tidak valid.';
}

if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
    $errors[] = 'Metode belajar tidak valid.';
}

if (!in_array($packageCount, [1, 2, 3], true)) {
    $errors[] = 'Jumlah paket tidak valid.';
}

/* Program studi boleh kosong */

/* 6. Cari kursus */
$course = findCourse($courses, $courseCode);

if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}

/* 7. Jika ada kesalahan, tampilkan pesan */
if (!empty($errors)) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran KursusKu</title>

    <link rel="stylesheet" href="style.css">
</head>
    </head>
    <body>
        <h1>Data belum dapat diproses</h1>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="registration.php">Kembali ke Form Pendaftaran</a>
    </body>
    </html>
    <?php
    exit;
}

/* 8. Hitung biaya */
$discountPercent = getDiscountPercent($participantType);
$subtotal = (int) $course['fee'] * $packageCount;

$discountAmount = intdiv(
    $subtotal * $discountPercent,
    100
);

$total = $subtotal - $discountAmount;

/* 9. Ubah kode menjadi label */
$participantLabels = [
    'mahasiswa' => 'Mahasiswa',
    'guru' => 'Guru',
    'umum' => 'Umum'
];

$learningModeLabels = [
    'offline' => 'Tatap Muka',
    'online' => 'Online',
    'hybrid' => 'Hybrid'
];

$participantLabel = $participantLabels[$participantType];
$learningModeLabel = $learningModeLabels[$learningMode];

/* 10. Ubah minat menjadi teks */
$interestLabels = [];

foreach ($interests as $interest) {
    $interestLabels[] = $interestOptions[$interest];
}

$interestText = $interestLabels
    ? implode(', ', $interestLabels)
    : 'Belum memilih minat';

/* 11. Simpan data ke history session */
if (!isset($_SESSION['registration_history'])) {
    $_SESSION['registration_history'] = [];
}

$registration = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'study_program' => $studyProgram,
    'course' => $course['name'],
    'course_code' => $courseCode,
    'participant_type' => $participantLabel,
    'learning_mode' => $learningModeLabel,
    'interests' => $interestLabels,
    'package_count' => $packageCount,
    'total' => $total,
    'notes' => $notes,
    'registered_at' => date('d-m-Y H:i')
];

$_SESSION['registration_history'][] = $registration;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran - KursusKu</title>
    <style>
       ```css
* {
    box-sizing: border-box;
}

:root {
    --yellow: #ffca05;
    --yellow-light: #fff3b0;
    --dark: #191919;
    --text: #283449;
    --muted: #788398;
}

body {
    margin: 0;
    padding: 35px 18px;
    font-family: "Segoe UI", Arial, sans-serif;
    color: var(--text);
    background: linear-gradient(
        135deg,
        #ffe879 0%,
        #fff9e8 48%,
        #ffda45 100%
    );
    background-attachment: fixed;
    min-height: 100vh;
}

/* Kartu utama */
.card {
    width: 100%;
    max-width: 850px;
    margin: 0 auto;
    padding: 32px 38px;
    background: #fff;
    border-radius: 22px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 15px 40px rgba(111, 82, 0, 0.12);
    position: relative;
    overflow: hidden;
}

.card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(
        90deg,
        #ffad00,
        #ffe66d,
        #ffca05
    );
}

/* Judul */
.card h1 {
    margin: 5px 0 10px;
    color: var(--dark);
    font-size: 30px;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.card > p:first-of-type {
    margin: 0 0 25px;
    color: var(--muted);
    font-size: 14px;
    line-height: 1.6;
}

.card h2 {
    margin: 24px 0 15px;
    color: var(--text);
    font-size: 21px;
    font-weight: 800;
}

.card h1 + p + h2 {
    display: flex;
    align-items: center;
    gap: 10px;
}

.card h1 + p + h2::before {
    content: "";
    width: 5px;
    height: 22px;
    border-radius: 5px;
    background: var(--yellow);
}

/* Data peserta */
.row {
    display: grid;
    grid-template-columns: 190px minmax(0, 1fr);
    align-items: center;
    gap: 12px;
    padding: 13px 15px;
    border-bottom: 1px solid #edf0f5;
    font-size: 14px;
    line-height: 1.6;
    overflow-wrap: anywhere;
    transition: background 0.2s ease;
}

.row:nth-of-type(even) {
    background: #fffaf0;
}

.row:hover {
    background: #fff3c4;
}

.label {
    color: var(--muted);
    font-size: 13px;
    font-weight: 700;
}

/* Ringkasan biaya */
.highlight {
    position: relative;
    margin: 25px 0 18px;
    padding: 23px 25px;
    background: linear-gradient(
        135deg,
        #fff5c5,
        #ffe577
    );
    border: 1px solid #ffe17a;
    border-radius: 17px;
    box-shadow: 0 7px 20px rgba(218, 166, 0, 0.10);
}

.highlight h2 {
    margin: 0 0 12px;
    font-size: 21px;
}

.highlight p {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 0;
    margin: 0;
    color: #55451c;
    font-size: 14px;
    line-height: 1.6;
    border-bottom: 1px dashed rgba(100, 75, 0, 0.18);
}

.highlight h2:last-child {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    margin: 16px 0 0;
    padding: 15px 17px;
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid #fff;
    border-radius: 11px;
    color: #191919;
    font-size: 22px;
}

/* Tanggal */
.card > p:not(:first-of-type) {
    color: var(--muted);
    font-size: 13px;
    line-height: 1.7;
}

/* Tombol */
.actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 22px;
}

.actions a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    min-height: 42px;
    padding: 11px 18px;
    border: 1px solid var(--yellow);
    border-radius: 10px;
    background: var(--yellow);
    color: #191919;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.2s ease;
}

.actions a:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(218, 166, 0, 0.2);
    background: #ffdb42;
}

.actions a:first-child {
    background: #191919;
    color: var(--yellow);
    border-color: #191919;
}

.actions a:last-child {
    background: #fff;
    color: var(--text);
    border-color: #e3e7ed;
}

/* Tablet dan HP */
@media (max-width: 600px) {
    body {
        padding: 18px 10px;
    }

    .card {
        padding: 27px 17px;
        border-radius: 17px;
    }

    .card h1 {
        font-size: 25px;
    }

    .card h2 {
        font-size: 19px;
    }

    .row {
        grid-template-columns: 1fr;
        gap: 3px;
        padding: 12px;
    }

    .highlight {
        padding: 19px 15px;
    }

    .highlight h2:last-child {
        font-size: 19px;
        padding: 13px;
    }

    .actions {
        flex-direction: column;
    }

    .actions a {
        width: 100%;
    }
}

    </style>
</head>
<body>

<div class="card">
    <h1>Pendaftaran Berhasil!</h1>
    <p>Data pendaftaran kamu berhasil diproses.</p>

    <h2>Data Peserta</h2>

    <div class="row">
        <span class="label">Nama Lengkap</span>
        <?= e($name) ?>
    </div>

    <div class="row">
        <span class="label">Email</span>
        <?= e($email) ?>
    </div>

    <div class="row">
        <span class="label">Nomor HP</span>
        <?= e($phone) ?>
    </div>

    <div class="row">
        <span class="label">Program Studi</span>
        <?= e($studyProgram !== '' ? $studyProgram : 'Tidak diisi') ?>
    </div>

    <div class="row">
        <span class="label">Kursus</span>
        <?= e($course['name']) ?>
    </div>

    <div class="row">
        <span class="label">Tipe Peserta</span>
        <?= e($participantLabel) ?>
    </div>

    <div class="row">
        <span class="label">Metode Belajar</span>
        <?= e($learningModeLabel) ?>
    </div>

    <div class="row">
        <span class="label">Jumlah Paket</span>
        <?= $packageCount ?> paket
    </div>

    <div class="row">
        <span class="label">Minat Belajar</span>
        <?= e($interestText) ?>
    </div>

    <div class="row">
        <span class="label">Catatan</span>
        <?= $notes !== '' ? nl2br(e($notes)) : 'Tidak ada catatan.' ?>
    </div>

    <div class="highlight">
        <h2>Ringkasan Biaya</h2>

        <p>Biaya per paket: <?= formatRupiah($course['fee']) ?></p>
        <p>Subtotal: <?= formatRupiah($subtotal) ?></p>
        <p>Diskon <?= $discountPercent ?>%:
            -<?= formatRupiah($discountAmount) ?></p>
        <h2>Total: <?= formatRupiah($total) ?></h2>
    </div>

    <p>
        Tanggal pendaftaran:
        <?= e($registration['registered_at']) ?>
    </p>

    <div class="actions">
        <a href="registration.php">Daftar Lagi</a>
        <a href="history.php">Lihat History</a>
        <a href="index.php">Beranda</a>
    </div>
</div>

</body>
</html>
