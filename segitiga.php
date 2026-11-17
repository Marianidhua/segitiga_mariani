<?php
$hasilSegitiga = "";
$pesanError = "";
$tinggi = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = $_POST["tinggi"] ?? "";

    if (filter_var($input, FILTER_VALIDATE_INT) === false) {
        $pesanError = "Masukan tidak valid! Harap masukkan bilangan bulat saja.";
    } else {
        $tinggi = (int) $input;

        if ($tinggi < 1 || $tinggi > 20) {
            $pesanError = "Tinggi segitiga tidak valid! Masukkan angka antara 1 sampai 20.";
        } else {
            // Perulangan bersarang (Nested Loop) untuk segitiga simetris presisi
            for ($baris = 1; $baris <= $tinggi; $baris++) {
                $hasilSegitiga .= '<div class="baris">';

                // 1. Perulangan untuk kotak kosong (spasi kiri)
                for ($spasi = 1; $spasi <= ($tinggi - $baris); $spasi++) {
                    $hasilSegitiga .= '<span class="sel"></span>';
                }

                // 2. Perulangan untuk bintang (1, 3, 5, 7, ...)
                for ($bintang = 1; $bintang <= (2 * $baris - 1); $bintang++) {
                    $hasilSegitiga .= '<span class="sel">*</span>';
                }

                $hasilSegitiga .= '</div>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pola Segitiga Bintang - PHP Native</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f3f4f6;
            color: #1f2937;
            display: flex;
            justify-content: center;
            padding: 40px 16px;
            margin: 0;
        }
        .card {
            background: #ffffff;
            width: 100%;
            max-width: 650px;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        h2 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 22px;
            color: #111827;
        }
        p.desc {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 14px;
            color: #6b7280;
        }
        .form-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
        }
        input[type="text"]:focus {
            outline: 2px solid #2563eb;
            border-color: #2563eb;
        }
        button {
            padding: 10px 20px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover {
            background-color: #1d4ed8;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .output-box {
            background-color: #0f172a;
            color: #38bdf8;
            padding: 24px 12px;
            border-radius: 8px;
            overflow-x: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .baris {
            display: flex;
            justify-content: flex-start;
            height: 22px;
            line-height: 22px;
        }
        /* Setiap spasi dan bintang memiliki lebar kotak yang identik (14px) */
        .sel {
            display: inline-block;
            width: 14px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Generator Segitiga Bintang</h2>
    <p class="desc">Masukkan tinggi segitiga berupa bilangan bulat antara <strong>1 sampai 20</strong>.</p>

    <form method="POST" action="">
        <div class="form-group">
            <input type="text" name="tinggi" placeholder="Contoh: 5" value="<?= htmlspecialchars($_POST['tinggi'] ?? '') ?>">
            <button type="submit">Tampilkan</button>
        </div>
    </form>

    <?php if ($pesanError !== ""): ?>
        <div class="alert-error">
            <?= $pesanError ?>
        </div>
    <?php endif; ?>

    <?php if ($hasilSegitiga !== ""): ?>
        <div class="output-box">
            <!-- Pembungkus div ditambahkan di sini agar seluruh blok segitiga rata tengah tanpa merusak perataan spasi per baris -->
            <div>
                <?= $hasilSegitiga ?>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
