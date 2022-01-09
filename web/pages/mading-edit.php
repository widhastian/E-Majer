<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM mading WHERE id_mading ='$id'");
$data = mysqli_fetch_array($query);
?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Edit Mading</span>
    </div>
    <div class="content">
        <table width="80%">
            <form action="proses/mading-edit-proses.php?judul=Mading" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Jenis Pengumuman</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group has-validation mt-3">
                            <input type="hidden" value="<?= $id ?>" name="id">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-pie-chart-alt-2'></i></span>
                            <select class="form-select" id="pengumuman" name="pengumuman">
                                <?php
                                if ($data['jenis_mading'] == 1) {
                                    echo "<option value='0'>-- Jenis Pengumuman --</option>";
                                    echo '<option value="1" selected>Pengumuman</option>';
                                    echo '<option value="2">Informasi</option>';
                                    echo '<option value="3">Pemberitahuan</option>';
                                } else if ($data['jenis_mading'] == 2) {
                                    echo "<option value='0'>-- Jenis Pengumuman --</option>";
                                    echo '<option value="1">Pengumuman</option>';
                                    echo '<option value="2" selected>Informasi</option>';
                                    echo '<option value="3">Pemberitahuan</option>';
                                } else if ($data['jenis_mading'] == 3) {
                                    echo "<option value='0'>-- Jenis Pengumuman --</option>";
                                    echo '<option value="1">Pengumuman</option>';
                                    echo '<option value="2">Informasi</option>';
                                    echo '<option value="3" selected>Pemberitahuan</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:15%; padding-top:1%"><label for="validationServer01" class="form-label ">Tanggal Pembagian</label></td>
                    <td style="width: 3%;">:</td>
                    <td>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-briefcase-alt'></i></span>
                            <input type="date" class="form-control" id="tanggal" aria-describedby="inputGroupPrepend" name="tanggal" value="<?= $data['tgl_pembagian'] ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Deskripsi Pengumuman</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group mt-3">
                            <textarea class="form-control" id="deskripsi" placeholder="Deskripsi Pengumuman" name="deskripsi"><?= $data['deskripsi_mading'] ?></textarea>
                            <input type="hidden" value="<?= $data['id_kelas'] ?>" name="kelas">
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

    var pengumuman = document.getElementById('pengumuman');
    var tanggal = document.getElementById('tanggal');
    var deskripsi = document.getElementById('deskripsi');

    function tambah() {
        if (pengumuman.value == "0") {
            pesan('Masukkan Jenis Pengumuman Terlebih dahulu', 'warning');
            return false;
        } else if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        } else if (deskripsi.value == "") {
            pesan('Deskripsi Tidak Boleh Kosong', 'warning');
            return false;
        }
    }
</script>