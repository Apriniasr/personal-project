<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Bioskop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: white;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            padding: 20px;
        }
        .total-harga {
            font-size: 1.5em;
            font-weight: bold;
            color: blue;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <h3 class="text-center">Pemesanan Tiket Bioskop</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="jenisTiket">Jenis Tiket</label>
                        <select name="jenisTiket" id="jenisTiket" class="form-control" required>
                            <option value="dewasa">Dewasa - Rp50.000</option>
                            <option value="anak-anak">Anak-anak - Rp30.000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlahTiket">Jumlah Tiket</label>
                        <input type="number" name="jumlahTiket" id="jumlahTiket" class="form-control" min="1" required placeholder="Masukkan jumlah tiket">
                    </div>
                    <div class="form-group">
                        <label for="hariPemesanan">Hari Pemesanan</label>
                        <select name="hariPemesanan" id="hariPemesanan" class="form-control" required>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu (Akhir Pekan)</option>
                            <option value="minggu">Minggu (Akhir Pekan)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Hitung Total Harga</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Mengambil data dari form
                    $jenisTiket = $_POST['jenisTiket'];
                    $jumlahTiket = (int)$_POST['jumlahTiket'];
                    $hariPemesanan = $_POST['hariPemesanan'];

                    // Harga tiket
                    $hargaDewasa = 50000;
                    $hargaAnak = 30000;
                    $biayaAkhirPekan = 10000;
                    $hargaAwal = 0;

                    // Menentukan harga awal berdasarkan jenis tiket
                    if ($jenisTiket === "dewasa") {
                        $hargaAwal = $hargaDewasa * $jumlahTiket;
                    } elseif ($jenisTiket === "anak-anak") {
                        $hargaAwal = $hargaAnak * $jumlahTiket;
                    }

                    // Tambahan biaya akhir pekan jika pemesanan dilakukan pada Sabtu atau Minggu
                    if ($hariPemesanan === "sabtu" || $hariPemesanan === "minggu") {
                        $hargaAwal += $biayaAkhirPekan * $jumlahTiket;
                    }

                    // Diskon jika total harga melebihi Rp150.000
                    if ($hargaAwal > 150000) {
                        $hargaAkhir = $hargaAwal * 0.9; // Diskon 10%
                    } else {
                        $hargaAkhir = $hargaAwal;
                    }

                    // Menampilkan total harga
                    echo "<div class='mt-4 text-center'>";
                    echo "<p class='total-harga'>Total Harga: Rp" . number_format($hargaAkhir, 0, ',', '.') . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
