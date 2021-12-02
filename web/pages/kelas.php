<?php
$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas ='$kelas'");
$data = mysqli_fetch_array($query);
?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Kelas</span>
        <div class="notif">
            <i class="fas fa-bell n"></i>
        </div>
        <div class="setting">
            <i class="fas fa-cog s"></i>
        </div>
    </div>
    <div class="content">
        <table width="80%">
            <form action="proses/kelas-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                <tr>
                    <td style="padding-top: 2%; width:20%;"><label for="validationServer01" class="form-label ">Nominal Uang Kas</label></td>
                    <td style="padding-top: 1%; width:3%;">:</td>
                    <td>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-landmark"></i></span>
                            <input type="text" class="form-control" id="id_kelas" n aria-describedby="inputGroupPrepend" placeholder="ID Kelas" name="id_kelas" value="<?= $kelas ?>" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Nama Kelas</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-landmark"></i></span>
                            <input type="text" class="form-control" id="nama_kelas" n aria-describedby="inputGroupPrepend" placeholder="Nama Kelas" name="nama_kelas" value="<?= $data['nama_kelas'] ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Nominal Uang Kas</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-dollar-circle'></i></span>
                            <input type="text" class="form-control" id="nominal" n aria-describedby="inputGroupPrepend" placeholder="Nominal Uang Kas" name="nominal" value="<?= $data['nominal_uangkas'] ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-danger mt-3"" data-bs-dismiss=" modal" onclick="home()"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary mt-3" name="btn-edit"><i class='bx bx-edit'></i> Edit</button>
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