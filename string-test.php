
<?php
$rawName = ' Laravel Fundamental ';
$cleanName = trim($rawName);
$upperName = strtoupper($cleanName);
$lowerName = strtolower($cleanName);
$length = strlen($cleanName);
$short = substr($cleanName, 0, 7);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KursusKu - String Function Test</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #FFF8E1, #FFE082);
            color: #4E4035;
            min-height: 100vh;
            padding: 30px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .utility-card {
            width: 100%;
            max-width: 720px;
            background: #FFFFFF;
            padding: 32px;
            border-radius: 22px;
            border-top: 8px solid #FFB300;
            box-shadow: 0 12px 35px rgba(93, 64, 55, 0.13);
        }

        .brand {
            color: #EF6C00;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        h1 {
            color: #5D4037;
            font-size: clamp(25px, 4vw, 34px);
            margin-bottom: 10px;
        }

        .description {
            color: #817466;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .name-box {
            background: #FFF8E1;
            border: 1px solid #FFE082;
            padding: 17px 20px;
            border-radius: 14px;
            margin-bottom: 22px;
        }

        .name-label {
            color: #8D8175;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .name-value {
            color: #5D4037;
            font-size: 19px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .result-title {
            color: #5D4037;
            font-size: 18px;
            margin-bottom: 14px;
        }

        ul {
            list-style: none;
            display: grid;
            gap: 12px;
            margin-bottom: 25px;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 15px 17px;
            background: #FFFCF2;
            border: 1px solid #F3E5AB;
            border-radius: 12px;
        }

        .function-name {
            color: #8D5A00;
            font-size: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .function-result {
            color: #4E4035;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .back-button {
            display: inline-block;
            background: #FFCA28;
            color: #4E342E;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            padding: 13px 22px;
            border-radius: 10px;
            transition: 0.2s ease;
        }

        .back-button:hover {
            background: #EF6C00;
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        .footer {
            color: #9A8D7E;
            font-size: 12px;
            text-align: center;
            margin-top: 25px;
        }

        @media (max-width: 480px) {
            .utility-card {
                padding: 23px 17px;
            }

            li {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }

            .function-result {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<main class="utility-card">

    <div class="brand">KURSUSKU</div>

    <h1>String Function Test</h1>

    <p class="description">
        Mengenal fungsi pengolahan teks PHP melalui contoh
        nama kursus Laravel Fundamental.
    </p>

    <div class="name-box">
        <div class="name-label">NAMA ASLI</div>
        <div class="name-value">
            <?= htmlspecialchars($rawName, ENT_QUOTES, 'UTF-8') ?>
        </div>
    </div>

    <h2 class="result-title">📋 Hasil Fungsi String</h2>

    <ul>
        <li>
            <span class="function-name">trim()</span>
            <span class="function-result">
                <?= htmlspecialchars($cleanName, ENT_QUOTES, 'UTF-8') ?>
            </span>
        </li>

        <li>
            <span class="function-name">strtoupper()</span>
            <span class="function-result">
                <?= htmlspecialchars($upperName, ENT_QUOTES, 'UTF-8') ?>
            </span>
        </li>

        <li>
            <span class="function-name">strtolower()</span>
            <span class="function-result">
                <?= htmlspecialchars($lowerName, ENT_QUOTES, 'UTF-8') ?>
            </span>
        </li>

        <li>
            <span class="function-name">strlen()</span>
            <span class="function-result">
                <?= $length ?> karakter
            </span>
        </li>

        <li>
            <span class="function-name">substr()</span>
            <span class="function-result">
                <?= htmlspecialchars($short, ENT_QUOTES, 'UTF-8') ?>
            </span>
        </li>
    </ul>

    <a href="index.php" class="back-button">
        ← Kembali ke Beranda
    </a>

    <div class="footer">
        &copy; 2026 KursusKu · String Function Test
    </div>

</main>

</body>
</html>
