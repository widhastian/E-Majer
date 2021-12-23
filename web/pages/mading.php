<section class="home-section" style="background-color: #f8f8f8;">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Mading</span>
    </div>
    <div class="content" style="padding-bottom: 4%; height:90vh;">
        <div class="row" style="width:97%;">
            <div class="col-md-5">
                <?php if ($level == 1) { ?>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                <?php } ?>
            </div>
            <div class="col-md-7">
                <form class="row g-3" style="margin-left:10%; margin-bottom:-15px;" method="POST">
                    <div class="col-auto">
                        <input type="date" name="pencarian" class="form-control" id="inputPassword2">
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="pengumuman">
                            <option value="0">-- Jenis Pengumuman --</option>
                            <option value="1">Pengumuman</option>
                            <option value="2">Informasi</option>
                            <option value="3">Pemberitahuan</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" name="btn-cari" style="height: 40px; padding-top:8px; width:45px; padding-left:11px;"><i class='bx bx-search-alt fs-4'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Mading</h5>
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
        $batas = 2;
        extract($_GET);
        if (empty($hal)) {
            $posisi = 0;
            $hal = 1;
            $nomor = 1;
        } else {
            $posisi = ($hal - 1) * $batas;
            $nomor = $posisi + 1;
        }
        // SELECT * FROM tbtransaksi INNER JOIN tbanggota ON tbtransaksi.idanggota = tbanggota.idanggota INNER JOIN akun ON tbtransaksi.idbuku = tbbuku.idbuku

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pencarian = trim(mysqli_real_escape_string($koneksi, $_POST['pencarian']));
            $pengumuman = trim(mysqli_real_escape_string($koneksi, $_POST['pengumuman']));
            if ($pencarian != "") {
                $query = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas= '$kelas' AND mading.tgl_pembagian LIKE '%$pencarian%' ORDER BY mading.tgl_pembagian DESC LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas= '$kelas' AND mading.tgl_pembagian LIKE '%$pencarian%' ORDER BY mading.tgl_pembagian DESC";
                $no = $posisi * 1;
            } else if ($pengumuman != "") {
                $query =  "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas= '$kelas' AND mading.jenis_mading LIKE '%$pengumuman%' ORDER BY mading.tgl_pembagian DESC LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas= '$kelas' AND mading.jenis_mading LIKE '%$pengumuman%' ORDER BY mading.tgl_pembagian DESC";
                $no = $posisi * 1;
            } else {
                $query = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas= '$kelas' ORDER BY mading.tgl_pembagian DESC LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas = '$kelas' ORDER BY mading.tgl_pembagian DESC";
                $no = $posisi * 1;
            }
        } else {
            $query = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas= '$kelas' ORDER BY mading.tgl_pembagian DESC LIMIT $posisi, $batas";
            $queryJml = "SELECT * FROM mading INNER JOIN kelas ON mading.id_kelas = kelas.id_kelas WHERE mading.id_kelas = '$kelas' ORDER BY mading.tgl_pembagian DESC";
            $no = $posisi * 1;
        }

        //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
        $q_tampil_transaksi = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($q_tampil_transaksi) > 0) {
            while ($row = mysqli_fetch_array($q_tampil_transaksi)) {
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
                            <?php if ($level == 1) { ?>
                                <a href="navbar.php?p=mading-edit&id=<?php echo $row['id_mading']; ?>" style="text-decoration: none; color:white;">
                                    <div type="button" class="btn btn-primary button"><i class="fas fa-edit" style="margin-bottom: 5px; margin-left:-5px;"></i></div>
                                </a>
                                <button type="button" class="btn btn-danger button" onclick="konfirmasi('<?= $row['id_mading'] ?>')"><i class="fas fa-trash-alt" style="margin-bottom: 4px; margin-left:-4px;"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        <?php $nomor++;
            }
        } else {
            echo "<p align='center' style='margin-top:2rem; font-weight:bold;'>Data Mading Tidak Ditemukan</p>";
        } ?>
        </table>
        <?php
        if (isset($_POST['btn-cari'])) {
            if ($_POST['pencarian'] != '' || $_POST['pengumuman'] != '0') {
                echo "<div style=\"float:left;\">";
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "<center>Data Hasil Pencarian: <b>$jml</b><center>";
                echo "</div>";
        ?>
                <div class="pagination">
                    <?php
                    $jml_hal = ceil($jml / $batas);
                    for ($i = 1; $i <= $jml_hal; $i++) {
                        if ($i != $hal) {
                            echo "<a href=\"?p=mading&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<meta http-equiv='refresh' content='0; url=navbar.php?p=mading'>";
            }
        } else { ?>
            <div style="float: left; margin-top:15px;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Jumlah Data : <b>$jml</b>";
                ?>
            </div>
            <div class="pagination">
                <?php
                $jml_hal = ceil($jml / $batas);
                for ($i = 1; $i <= $jml_hal; $i++) {
                    if ($i != $hal) {
                        echo "<a href=\"?p=mading&hal=$i\">$i</a>";
                    } else {
                        echo "<a class=\"active\">$i</a>";
                    }
                }
                ?>
            </div>
        <?php
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