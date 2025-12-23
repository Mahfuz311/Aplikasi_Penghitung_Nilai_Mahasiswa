<?php 
session_start();
include 'koneksi.php';

if($_SESSION['level'] != 'Akademik'){
    echo "<script>alert('AKSES DITOLAK! Hanya Staff Akademik yang boleh mencetak laporan.'); window.location='penilaian.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', serif; padding: 40px; }
        .kop-surat { border-bottom: 3px double black; padding-bottom: 10px; margin-bottom: 20px; text-align: center; }
        .kop-surat h2 { margin: 0; font-weight: bold; text-transform: uppercase; }
        .kop-surat p { margin: 0; font-size: 0.9rem; }
        .tabel-nilai { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .tabel-nilai th, .tabel-nilai td { border: 1px solid black; padding: 8px; text-align: center; }
        .tabel-nilai th { background-color: #f0f0f0; }
        
        .ttd { margin-top: 50px; float: right; text-align: center; width: 200px; }
        
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="no-print mb-4">
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak PDF / Print</button>
        <a href="penilaian.php" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="kop-surat">
        <h2>Universitas Mahfuz</h2>
        <p>Jl. Cabang Dua, Cabang Bungin, Bekasi</p>
        <p>Telp: (021) 0888888 | Email: info@mahfuz.ac.id</p>
    </div>

    <h4 class="text-center mb-4">LAPORAN REKAPITULASI NILAI MAHASISWA</h4>

    <table class="tabel-nilai">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Mata Kuliah</th>
                <th>Dosen Pengampu</th>
                <th>Nilai Akhir</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $q = mysqli_query($koneksi, "SELECT * FROM view_rekap_nilai ORDER BY nama_mahasiswa ASC");
            $no = 1;
            while($d = mysqli_fetch_array($q)){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nim'] ?></td>
                <td style="text-align:left; padding-left:10px;"><?= $d['nama_mahasiswa'] ?></td>
                <td><?= $d['mata_kuliah'] ?></td>
                <td><?= $d['nama_dosen'] ?></td>
                <td><strong><?= $d['nilai_akhir'] ?></strong></td>
                <td><?= $d['keterangan_lulus'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="ttd">
        <p>Bekasi, <?= date('d F Y'); ?></p>
        <p>Bagian Akademik,</p>
        <br><br><br>
        <p><strong>( ________________ )</strong></p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>