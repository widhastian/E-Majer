<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Transaksi Pembayaran</span>
        <div class="notif">
            <i class="fas fa-bell n"></i>
        </div>
        <div class="setting">
            <i class="fas fa-cog s"></i>
        </div>
    </div>
    <div class="content">
        <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
        <button type="button" class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>
        <table class="table table-striped mt-4 ml-3" style="width:96%; text-align:center;">
            <tr>
                <td>No</td>
                <td>Nama Siswa</td>
                <td>Kelas</td>
                <td>Tanggal Transaksi</td>
                <td>Nominal Transaksi</td>
                <td>status</td>
                <td colspan="2">action</td>
            </tr>
            <?php
            $batas = 5;
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
                if ($pencarian != "") {
                    $sql = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE Nama_transaksi LIKE '%$pencarian%'";

                    $query = $sql;
                    $queryJml = $sql;
                } else {
                    $query = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas'";
                    $queryJml = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                    kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas'  ";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas'  ";
                $queryJml = "SELECT * FROM transaksi INNER JOIN akun ON transaksi.id_akun = akun.id_akun JOIN 
                            kelas On akun.id_kelas = kelas.id_kelas WHERE akun.id_kelas = '$kelas' ";
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
                        <td>
                            <!-- Example single danger button -->
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Bayar</a></li>
                                    <li><a class="dropdown-item" href="#">Sudah Bayar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
            <?php $nomor++;
                }
            } else {
                echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
            } ?>
        </table>
        <?php
        if (isset($_POST['pencarian'])) {
            if ($_POST['pencarian'] != '') {
                echo "<div style=\"float:left;\">";
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Data Hasil Pencarian: <b>$jml</b>";
                echo "</div>";
            }
        } else { ?>
            <div style="float: left;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Jumlah Data : <b>$jml</b>";
                ?>
            </div>
            <div class="pagination">
                <!-- <?php
                        $jml_hal = ceil($jml / $batas);
                        for ($i = 1; $i <= $jml_hal; $i++) {
                            if ($i != $hal) {
                                echo "<a href=\"?p=transaksi&hal=$i\">$i</a>";
                            } else {
                                echo "<a class=\"active\">$i</a>";
                            }
                        }
                        ?> -->
            </div>
        <?php
        }
        ?>
    </div>
</section>