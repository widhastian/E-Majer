<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Transaksi Pembayaran</span>
    </div>
    <div class="content">
        <div class="row" style="width:97%;">
            <div>
                <form class="row g-3" style="margin-bottom:-15px; float:right;" method="POST">
                    <div class="col-auto">
                        <input type="date" name="tanggal" class="form-control" id="inputPassword2">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" name="btn-cari" style="height: 40px; padding-top:8px; width:45px; padding-left:11px;"><i class='bx bx-search-alt fs-4'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped mt-4 ml-3" style="width:96%; text-align:center;">
            <tr style="width:96%">
                <td>No</td>
                <td>Nama Siswa</td>
                <td>Kelas</td>
                <td>Tanggal Transaksi</td>
                <td>Nominal Transaksi</td>
                <td>status</td>
            </tr>
            <?php
            $batas = 8;
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
                $tanggal = trim(mysqli_real_escape_string($koneksi, $_POST['tanggal']));
                if ($tanggal != "") {
                    $query = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                    kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' AND akun.id_akun = '$id' AND transaksi.tanggal_transaksi LIKE '%$tanggal%' ORDER BY transaksi.tanggal_transaksi ASC , akun.nama ASC LIMIT $posisi, $batas ";
                    $queryJml = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                    kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' AND akun.id_akun = '$id' AND transaksi.tanggal_transaksi LIKE '%$tanggal%' ORDER BY transaksi.tanggal_transaksi ASC , akun.nama ASC";
                    $no = $posisi * 1;
                } else {
                    $query = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' AND akun.id_akun = '$id' ORDER BY transaksi.tanggal_transaksi ASC , akun.nama ASC LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                    kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' AND akun.id_akun = '$id' ORDER BY transaksi.tanggal_transaksi ASC , akun.nama ASC";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' AND akun.id_akun = '$id' ORDER BY transaksi.tanggal_transaksi ASC , akun.nama ASC LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' AND akun.id_akun = '$id' ORDER BY transaksi.tanggal_transaksi ASC , akun.nama ASC";
                $no = $posisi * 1;
            }

            //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
            $q_tampil_transaksi = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($q_tampil_transaksi) > 0) {
                while ($r_tampil_transaksi = mysqli_fetch_array($q_tampil_transaksi)) {
            ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_transaksi['nama']; ?></td>
                        <td><?php echo $r_tampil_transaksi['nama_kelas']; ?></td>
                        <td><?php echo $r_tampil_transaksi['tanggal_transaksi']; ?></td>
                        <td><?php echo $r_tampil_transaksi['nominal_transaksi']; ?></td>
                        <td>
                            <?php
                            if ($r_tampil_transaksi['status'] == 1) {
                                echo "<div class='status' style='background-color: #DB0909;'>Belum Bayar</div>";
                            } else if ($r_tampil_transaksi['status'] == 2) {
                                echo "<div class='status' style='background-color: #1A8708;'>Sudah Bayar</div>";
                            }
                            ?>
                        </td>
                    </tr>
            <?php $nomor++;
                }
            } else {
                echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
            } ?>
        </table>
        <?php
        if (isset($_POST['btn-cari'])) {
            if ($_POST['pencarian'] != '' || $_POST['tanggal'] != '') {
                echo "<div style=\"float:left;\">";
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Data Hasil Pencarian: <b>$jml</b>";
                echo "</div>";
        ?>
                <div class="pagination">
                    <?php
                    $jml_hal = ceil($jml / $batas);
                    for ($i = 1; $i <= $jml_hal; $i++) {
                        if ($i != $hal) {
                            echo "<a href=\"?p=pengeluaran-siswa&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<meta http-equiv='refresh' content='0; url=navbar.php?p=pengeluaran-siswa'>";
            }
        } else { ?>
            <div style="float: left;">
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
                        echo "<a href=\"?p=pengeluaran-siswa&hal=$i\">$i</a>";
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

    var nama = document.getElementById('nama');
    var tanggal = document.getElementById('tanggal');

    function tambah() {
        if (nama.value == "0") {
            pesan('Nama Tidak Boleh Kosong', 'warning');
            return false;
        } else if (tanggal.value == "") {
            pesan('Tanggal Tidak Boleh Kosong', 'warning');
            return false;
        }
    }

    function bayar(id, nominal, akun) {
        window.location.href = "proses/change-bayar.php?id=" + id + "&nominal=" + nominal + "&id_akun=" + akun;
    }

    function belum_bayar(id, nominal, akun) {
        window.location.href = "proses/change-belumbayar.php?id=" + id + "&nominal=" + nominal + "&id_akun=" + akun;
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