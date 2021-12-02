<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang ='$id'");
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
        <span class="text">Edit Barang</span>
        <div class="notif">
            <i class="fas fa-bell n"></i>
        </div>
        <div class="setting">
            <i class="fas fa-cog s"></i>
        </div>
    </div>
    <div class="content">
        <table width="80%">
            <form action="proses/barang-edit-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                <tr>
                    <td style="width:15%; padding-top:1%"><label for="validationServer01" class="form-label ">Nama Barang</label></td>
                    <td style="width: 3%;">:</td>
                    <td>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-briefcase-alt'></i></span>
                            <input type="hidden" value="<?= $id ?>" name="id">
                            <input type="text" class="form-control" id="nama_barang" n aria-describedby="inputGroupPrepend" placeholder="Nama Barang" name="nama_barang" value="<?= $data['Nama_barang'] ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Jumlah Barang</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group has-validation mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-spreadsheet'></i></span>
                            <input type="text" class="form-control" id="jumlah_barang" aria-describedby="inputGroupPrepend" placeholder="Jumlah Barang" name="jumlah_barang" value="<?= $data['jumlah_barang'] ?>">
                            <input type="hidden" value="<?= $data['id_kelas'] ?>" name="kelas">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Kondisi</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group has-validation mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-pie-chart-alt-2'></i></span>
                            <select class="form-select" id="kondisi" name="kondisi">
                                <?php
                                if ($data['kondisi'] == 1) {
                                    echo "<option value='0'>-- Kondisi --</option>";
                                    echo "<option value='1' selected>Baik</option>";
                                    echo "<option value='2'>Kurang Baik</option>";
                                    echo "<option value='3'>Rusak</option>";
                                } else if ($data['kondisi'] == 2) {
                                    echo "<option value='0'>-- Kondisi --</option>";
                                    echo "<option value='1'>Baik</option>";
                                    echo "<option value='2' selected>Kurang Baik</option>";
                                    echo "<option value='3'>Rusak</option>";
                                } else if ($data['kondisi'] == 3) {
                                    echo "<option value='0'>-- Kondisi --</option>";
                                    echo "<option value='1'>Baik</option>";
                                    echo "<option value='2'>Kurang Baik</option>";
                                    echo "<option value='3' selected >Rusak</option>";
                                }
                                ?>
                            </select>
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

    var nama_barang = document.getElementById('nama_barang');
    var jumlah_barang = document.getElementById('jumlah_barang');
    var kondisi = document.getElementById('kondisi');

    function tambah() {
        if (nama_barang.value == "") {
            pesan('Nama Barang Tidak Boleh Kosong', 'warning');
            return false;
        } else if (jumlah_barang.value == "") {
            pesan('Jumlah Barang Tidak Boleh Kosong', 'warning');
            return false;
        } else if (kondisi.value == "0") {
            pesan('Pilih Kondisi Barang Dengan Benar', 'warning');
            return false;
        }
    }
</script>