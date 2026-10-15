
<?php
session_start();

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran - KursusKu</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            color: #17233d;
        }

        .form-card {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px #00000012;
        }

        h1 { margin-top: 0; }

        label, .field-title {
            display: block;
            margin: 16px 0 8px;
            font-weight: bold;
        }

        input:not([type="checkbox"]),
        select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd2da;
            border-radius: 9px;
            font: inherit;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 10px 0;
            font-weight: normal;
        }

        .checkbox-option input {
            width: auto;
        }

        button {
            margin-top: 22px;
            padding: 13px 22px;
            border: 0;
            border-radius: 10px;
            background: #ffd21f;
            color: #111;
            font-weight: bold;
            cursor: pointer;
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            color: #17233d;
        }
    </style>
</head>
<body>

<div class="form-card">
    <h1>Form Pendaftaran KursusKu</h1>
    <p>Lengkapi data berikut untuk mendaftar kursus.</p>

    <form action="process-registration.php" method="POST">
        <input type="hidden" name="source" value="week-06">

        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Nomor HP</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="study_program">Program Studi</label>
        <input type="text" id="study_program" name="study_program">

        <label for="course_code">Pilih Kursus</label>
        <select id="course_code" name="course_code" required>
            <option value="">-- Pilih Kursus --</option>
            <?php foreach ($courses as $course): ?>
                <option value="<?= e($course['code']) ?>">
                    <?= e($course['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="participant_type">Tipe Peserta</label>
        <select id="participant_type" name="participant_type" required>
            <option value="">-- Pilih Tipe Peserta --</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="guru">Guru</option>
            <option value="umum">Umum</option>
        </select>

        <span class="field-title">Minat Belajar</span>

        <?php foreach ($interestOptions as $key => $label): ?>
            <label class="checkbox-option">
                <input
                    type="checkbox"
                    name="interests[]"
                    value="<?= e($key) ?>"
                >
                <?= e($label) ?>
            </label>
        <?php endforeach; ?>

        <label for="learning_mode">Metode Belajar</label>
        <select id="learning_mode" name="learning_mode" required>
            <option value="">-- Pilih Metode --</option>
            <option value="offline">Tatap Muka</option>
            <option value="online">Online</option>
            <option value="hybrid">Hybrid</option>
        </select>

        <label for="package_count">Jumlah Paket</label>
        <select id="package_count" name="package_count" required>
            <option value="1">1 Paket</option>
            <option value="2">2 Paket</option>
            <option value="3">3 Paket</option>
        </select>

        <label for="notes">Catatan (opsional)</label>
        <textarea id="notes" name="notes" rows="4"></textarea>

        <button type="submit">Kirim Pendaftaran</button>
    </form>

    <a class="back-link" href="index.php">Kembali ke Beranda</a>
</div>

</body>
</html>
