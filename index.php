<?php

$daftarLokasi = ['Jakarta', 'Bogor', 'Tangerang', 'Bekasi'];

asort($daftarLokasi);

$tarif = [
    'a' => 5000,
    'b' => 8600,
    'c' => 9800,
    'd' => 11300,
    'e' => 15100
];
$PPN = 1195;
$harga_materai =  3000;
$biaya_pemeliharaan = 4400;


function hitung_tarif_pemakaian($tarif, $meteran, $golongan)
{
    $tarif_pemakaian = $tarif[$golongan] * $meteran;
    return $tarif_pemakaian;
}

function hitung_tagihan($tarif, $meteran, $golongan, $biaya_pemeliharaan, $harga_materai, $PPN)
{
    $tarif_pemakaian = hitung_tarif_pemakaian($tarif, $meteran, $golongan);
    $total_tagihan = $tarif_pemakaian + $PPN + $harga_materai + $biaya_pemeliharaan;
    return $total_tagihan;
}


?>

<html>

<head>
    <title>Perhitungan Tagihan PDAM</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container border">
        <h5 class="text-primary">perhitungan tagihan pdam</h5>

        <form action="index.php" method="post" id="formTagihan">
            <div class="row">
                <div class="col-lg-2"><label for="lokasi">Lokasi: </label></div>
                <div class="col-lg-2">
                    <select name="lokasi" id="lokasi" class="form-control">
                        <option value="">Lokasi</option>
                        <?php
                        foreach ($daftarLokasi as $lokasi) :
                            echo "<option value='$lokasi'>$lokasi</option>";
                        endforeach;

                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"><label for="nama">Nama Pelanggan</label></div>
                <div class="col-lg-2"><input type="text" id="nama" name="nama" class="form-control"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"><label for="nomor">Nomor Pelanggan</label></div>
                <div class="col-lg-2"><input type="number" id="nomor" name="nomor" class="form-control"></div>

            </div>

            <div class="row">
                <div class="col-lg-2"><label for="golongan">Golongan:</label></div>
                <div class="col-lg-2">
                    <div class="form-check">
                        <input type="radio" name="golongan" value="a">
                        <label for="a">(A)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="golongan" value="b">
                        <label for="b">(B)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="golongan" value="c">
                        <label for="c">(C)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="golongan" value="d">
                        <label for="d">(D)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="golongan" value="e">
                        <label for="e">(E)</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2"><label for="meteran">Pemakaian (m3): </label></div>
                <div class="col-lg-2"><input type="number" id="meteran" name="meteran" class="form-control"></div>

            </div>

            <div class="row">
                <div class="col-lg-2"><button type="submit" class="btn btn-primary" form="formTagihan" value="Hitung" name="Hitung">Hitung</button></div>
                <div class="col-lg-2"></div>
            </div>

        </form>

    </div>

    <?php

    if (isset($_POST['Hitung'])) {

        $lokasi = $_POST['lokasi'];
        $nama = $_POST['nama'];
        $nomor = $_POST['nomor'];
        $golongan = $_POST['golongan'];
        $meteran = $_POST['meteran'];

        $tarif_pemakaian = hitung_tarif_pemakaian($tarif, $meteran, $golongan);
        $total_tagihan = hitung_tagihan($tarif, $meteran, $golongan, $biaya_pemeliharaan, $harga_materai, $PPN);

        echo "
<br/>
<div class='container'>

<div class='row'>
<div class='col-lg-2'>Lokasi:</div>
<div class='col-lg-2'>" . $lokasi . "</div>
</div>

<div class='row'>
<div class='col-lg-2'>Nama Pelanggan</div>
<div class='col-lg-2'>" . $nama . "</div>
</div>

<div class='row'>
<div class='col-lg-2'>nomor Pelanggan:</div>
<div class='col-lg-2'>" . $nomor . "</div>
</div>

<div class='row'>
<div class='col-lg-2'>Golongan Pemakaian:</div>
<div class='col-lg-2'>" . $golongan . "</div>
</div>

<div class='row'>
<div class='col-lg-2'>Pemakaian (m3):</div>
<div class='col-lg-2'>" . $meteran . "</div>
</div>

<div class='row'>
<div class='col-lg-2'>tarif pemakaian:</div>
<div class='col-lg-2'>Rp " . number_format($tarif_pemakaian, 0, ".", ".") . " </div>
</div>

<div class='row'>
<div class='col-lg-2'>Jumlah Tagihan:</div>
<div class='col-lg-2'>Rp " . number_format($total_tagihan, 0, ".", ".") . " </div>
</div>

</div>
";
    }

    ?>

</body>

</html>