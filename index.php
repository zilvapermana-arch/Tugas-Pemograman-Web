
<?php
// 1. Array multidimensi mata kuliah
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 85],
    ["nama" => "Sistem Basis Data", "sks" => 3, "nilai" => 75],
    ["nama" => "Struktur Data", "sks" => 3, "nilai" => 65],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 55],
    ["nama" => "Kalkulus", "sks" => 2, "nilai" => 45],
];

// 2. Fungsi helper nilai angka menjadi huruf dan bobot
function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSks = 0;
$totalMutu = 0;
$totalMatkul = count($matkul);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai Mata Kuliah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f7fb;
            color: #243247;
        }
        h1, h2 { color: #174a7e; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ccd5df;
            padding: 12px;
            text-align: center;
        }
        th {
            background: #174a7e;
            color: white;
        }
        tr.mengulang { background: #ffe0e0; }
        .ringkasan {
            background: white;
            border: 1px solid #ccd5df;
            border-radius: 8px;
            padding: 18px;
            margin-top: 20px;
        }
        .lulus { color: #16743b; font-weight: bold; }
        .gagal { color: #c62828; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Rekap Nilai Mata Kuliah</h1>
    <p>Contoh perhitungan nilai, bobot, IPS, dan batas SKS semester.</p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Angka</th>
                <th>Nilai Huruf</th>
                <th>Bobot</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($matkul as $i => $m):
            $hasil = hitungBobot($m["nilai"]);
            $status = $hasil["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";

            $totalSks += $m["sks"];
            $totalMutu += $m["sks"] * $hasil["bobot"];
        ?>
            <tr class="<?= $status === 'MENGULANG' ? 'mengulang' : '' ?>">
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($m["nama"]) ?></td>
                <td><?= $m["sks"] ?></td>
                <td><?= $m["nilai"] ?></td>
                <td><?= $hasil["huruf"] ?></td>
                <td><?= number_format($hasil["bobot"], 1) ?></td>
                <td class="<?= $status === 'LULUS' ? 'lulus' : 'gagal' ?>">
                    <?= $status ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $ips = $totalSks > 0 ? $totalMutu / $totalSks : 0;
    $maksSks = $ips >= 3.00 ? 24 : 20;
    ?>

    <div class="ringkasan">
        <h2>Ringkasan IPS</h2>
        <p>Total mata kuliah: <?= $totalMatkul ?></p>
        <p>Total SKS: <?= $totalSks ?></p>
        <p>Total mutu: <?= number_format($totalMutu, 2) ?></p>
        <p>IPS: <strong><?= number_format($ips, 2) ?></strong></p>
        <p>Maksimal SKS semester berikutnya:
            <strong><?= $maksSks ?> SKS</strong>
        </p>
    </div>
</body>
</html>
