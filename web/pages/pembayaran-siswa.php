<?php
$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas ='$kelas'");
$data = mysqli_fetch_array($query);
?>
<section class="home-section">
    <div class="home-content">
        <h5 class="text">Transaksi Pembayaran</h5>
        <i class='bx bx-menu'></i>
    </div>
    <div class="content">
        <table width="80%">
            <form action="proses/pembayaran-siswa-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                <tr>
                    <td style="padding-top: 2%; width:20%;"><label for="validationServer01" class="form-label ">Nominal Uang Kas</label></td>
                    <td style="padding-top: 1%; width:3%;">:</td>
                    <td>
                        <div class="input-group mt-3">
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_kelas ='$kelas' AND id_level = 1");
                            $data = mysqli_fetch_array($query);
                            ?>
                            <input type="hidden" name="id2" value="<?= $data['id_akun']  ?>">
                            <input type="hidden" name="nama" value="<?= $id  ?>">
                            <input type="hidden" name="nominal" value="<?= $nominal  ?>">
                            <p class="saldo">Rp. <?= number_format($nominal, 0, ".", ".") ?>;-</p>
                            <input type="hidden" name="kelas" value="<?= $kelas  ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Tanggal Transaksi</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-dollar-circle'></i></span>
                            <input type="date" class="form-control" id="tanggal" n aria-describedby="inputGroupPrepend" name="tanggal">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if ($saldo != 0 && $saldo >= $nominal) { ?>
                            <button type="submit" class="btn btn-success mt-3" id="bayar" name="btn-edit"><i class='bx bxs-dollar-circle'></i> Bayar</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-success mt-3" name="btn-edit" onclick="bayar()"><i class='bx bxs-dollar-circle'></i> Bayar</button>
                        <?php } ?>
                    </td>
                </tr>
            </form>
        </table>
    </div>
</section>
<script>
    function pesan(judul, status) {
        swal.fire({
            title: judul,
            icon: status,
            confirmButtonColor: '#6777ef',
        });
    }


    function home() {
        window.location.href = "navbar.php?p=home";
    }

    var tanggal = document.getElementById('tanggal');

    function tambah() {
        if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        }
    }

    function bayar() {
        pesan('Saldo Tidak Mencukupi Silahkan Isi Ulang Terlebih Dahulu', 'warning');
        return false;
    }
</script>