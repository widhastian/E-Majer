<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pengeluaran WHERE id_pengeluaran ='$id'");
$data = mysqli_fetch_array($query);
if (empty($data['foto']) or ($data['foto'] == '-')) {
    $foto = "barang.jpg";
} else {
    $foto = $data['foto'];
}
?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Edit Pengeluaran</span>
    </div>
    <div class="content">
        <table width="80%">
            <form action="proses/pengeluaran-edit-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                <tr>
                    <td style="width:15%; padding-top:1%"><label for="validationServer01" class="form-label ">Nominal</label></td>
                    <td style="width: 3%;">:</td>
                    <td>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-dollar-circle'></i></span>
                            <input type="hidden" value="<?= $id ?>" name="id">
                            <input type="text" class="form-control" id="nominal" n aria-describedby="inputGroupPrepend" placeholder="Nominal Pengeluaran" name="nominal" value="<?= $data['nominal_pengeluaran'] ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Tanggal Pengeluaran</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group has-validation mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" class="form-control" id="tanggal" aria-describedby="inputGroupPrepend" placeholder="Jumlah Barang" name="tanggal" value="<?= $data['tgl_pengeluaran'] ?>">
                            <input type="hidden" value="<?= $data['id_akun'] ?>" name="akun">
                            <input type="hidden" value="<?= $kelas ?>" name="kelas">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Foto</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <img src="assets/gambar/<?php echo $foto; ?>" width=70px height=75px class="mt-3">
                        <div class="input-group has-validation mt-3">
                            <input type="file" class="form-control" name="foto" id="foto" aria-describedby="inputGroupPrepend">
                            <input type="hidden" name="foto_awal" value="<?php echo $data['foto']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class=" input-group has-validation mt-3">
                            <button type="submit" class="btn btn-primary" name="btn-edit"><i class='bx bx-edit'></i> Edit</button>
                        </div>
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

    var nominal = document.getElementById('nominal');
    var tanggal = document.getElementById('tanggal');
    var foto = document.getElementById('foto');

    function tambah() {
        if (nominal.value == "") {
            pesan('Nominal Tidak Boleh Kosong', 'warning');
            return false;
        } else if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        } else if (foto.value == "0") {
            pesan('Foto Tidak Boleh Kosong', 'warning');
            return false;
        }
    }
</script>