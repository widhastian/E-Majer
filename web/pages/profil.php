<?php
$query = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_akun ='$id'");
$data = mysqli_fetch_array($query);
?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Profil</span>
    </div>
    <div style="display:flex;">
        <div>
            <img src="" alt="">
        </div>
        <div class="content" style="display: block;">
            <table width="80%">
                <form action="proses/profil-edit-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                    <tr>
                        <td style="padding-top: 2%; width:20%;"><label for="validationServer01" class="form-label ">ID Akun</label></td>
                        <td style="padding-top: 1%; width:3%;">:</td>
                        <td>
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user-alt"></i></span>
                                <input type="text" class="form-control" id="id_akun" n aria-describedby="inputGroupPrepend" placeholder="ID Akun" name="id_akun" value="<?= $id ?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Nama Lengkap</label></td>
                        <td style="padding-top: 1%;">:</td>
                        <td>
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user-alt"></i></span>
                                <input type="text" class="form-control" id="nama_lengkap" n aria-describedby="inputGroupPrepend" placeholder="Nama Lengkap" name="nama_lengkap" value="<?= $data['nama'] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Email</label></td>
                        <td style="padding-top: 1%;">:</td>
                        <td>
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroupPrepend" style="height: 2.5rem;"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" n aria-describedby="inputGroupPrepend" placeholder="Email" name="email" value="<?= $data['email'] ?>" style="height: 2.5rem; margin-top: -0.2px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Username</label></td>
                        <td style="padding-top: 1%;">:</td>
                        <td>
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user-alt"></i></span>
                                <input type="text" class="form-control" id="username" n aria-describedby="inputGroupPrepend" placeholder="Username" name="username" value="<?= $data['username'] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Password</label></td>
                        <td style="padding-top: 1%;">:</td>
                        <td>
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-key'></i></span>
                                <input type="password" class="form-control" id="password" n aria-describedby="inputGroupPrepend" placeholder="Password" name="password" value="<?= $data['password'] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="navbar.php?p=home" class="btn btn-danger mt-3"><i class="fas fa-times-circle"></i> Batal</a>
                            <button type="submit" class="btn btn-primary mt-3" name="btn-edit"><i class='bx bx-edit'></i> Edit</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
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