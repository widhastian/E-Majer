<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Mading</span>
        <div class="notif">
            <i class="fas fa-bell n"></i>
        </div>
        <div class="setting">
            <i class="fas fa-cog s"></i>
        </div>
    </div>
    <div class="content" style="padding-bottom: 4%; height:100%">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-plus"></i> Tambah
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses/mading-tambah-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bxs-pin'></i></span>
                                    <select class="form-select" id="pengumuman" name="pengumuman">
                                        <option value="0">-- Jenis Pengumuman --</option>
                                        <option value="1">Pengumuman</option>
                                        <option value="2">Informasi</option>
                                        <option value="3">Pemberitahuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="tanggal" n aria-describedby="inputGroupPrepend" name="tanggal">
                                    <input type="hidden" value="<?= $kelas ?>" name="kelas">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <textarea class="form-control" id="deskripsi" placeholder="Deskripsi Pengumuman" name="deskripsi"></textarea>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        <button type="submit" class="btn btn-success" name="btn-tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $query = "SELECT * FROM mading WHERE id_kelas = '$kelas'";
        $result = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <div class="mading">
                    <div class="row">
                        <div class="col-3">
                            <?php
                            if ($row['jenis_mading'] === '1') {
                                echo "<i class='fas fa-bullhorn icon-mading'></i>";
                            } else if ($row['jenis_mading'] === '2') {
                                echo "<i class='bx bx-pin icon-mading'></i>";
                            } else if ($row['jenis_mading'] === '3') {
                                echo "<i class='bx bx-message-detail icon-mading'></i>";
                            }
                            ?>
                        </div>
                        <div class="col-7">
                            <p><?= $row['deskripsi_mading'] ?></p>
                        </div>
                        <div class="col-2">
                            <p style="padding-top: 4%;"><?= $row['tgl_pembagian'] ?></p>
                            <a href="navbar.php?p=mading-edit&id=<?php echo $row['id_mading']; ?>" style="text-decoration: none; color:white;">
                                <div type="button" class="btn btn-primary button"><i class="fas fa-edit" style="margin-bottom: 5px; margin-left:-5px;"></i></div>
                            </a>
                            <button type="button" class="btn btn-danger button" onclick="konfirmasi('<?= $row['id_mading'] ?>')"><i class="fas fa-trash-alt" style="margin-bottom: 4px; margin-left:-4px;"></i></button>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
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

    function konfirmasi(id) {
        swal.fire({
            title: "Hapus Data ini?",
            icon: "warning",
            closeOnClickOutside: false,
            showCancelButton: true,
            confirmButtonText: 'Iya',
            confirmButtonColor: '#6777ef',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.value) {
                window.location.href = "proses/mading-hapus-proses.php?id=" + id;
            }
        });
    }
</script>