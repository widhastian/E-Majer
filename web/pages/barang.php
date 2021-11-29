<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Data Barang</span>
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
                <td>Nama Barang</td>
                <td>Jumlah Barang</td>
                <td>Kondisi</td>
                <td>Foto</td>
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
                    $sql = "SELECT * FROM barang WHERE Nama_barang LIKE '%$pencarian%'";

                    $query = $sql;
                    $queryJml = $sql;
                } else {
                    $query = "SELECT * FROM barang LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM barang";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM barang LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM barang ";
                $no = $posisi * 1;
            }

            //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
            $q_tampil_barang = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($q_tampil_barang) > 0) {
                while ($r_tampil_barang = mysqli_fetch_array($q_tampil_barang)) {
            ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_barang['Nama_barang']; ?></td>
                        <td><?php echo $r_tampil_barang['jumlah_barang']; ?></td>
                        <td>
                            <?php
                            if ($r_tampil_barang['kondisi'] == 1) {
                                echo "<div class='status' style='background-color: #1A8708;'>baik</div>";
                            } else if ($r_tampil_barang['kondisi'] == 2) {
                                echo "<div class='status' style='background-color: #0F67EC;'>Kurang baik</div>";
                            } else if ($r_tampil_barang['kondisi'] == 3) {
                                echo "<div class='status' style='background-color: #A64702;'>Rusak</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $r_tampil_barang['foto']; ?></td>
                        <td>
                            <div type="button" class="btn btn-primary"><a href="index.php?p=barang-edit&id=<?php echo $r_tampil_barang['id_barang']; ?>" style="text-decoration: none; color:white;"><i class="fas fa-edit"></i></a></div>
                            <div type="button" class="btn btn-danger"><a href="proses/barang-hapus.php?id=<?php echo $r_tampil_barang['id_barang']; ?>" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" style="text-decoration: none; color:white;"><i class="fas fa-trash-alt"></i></a></div>
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
                                echo "<a href=\"?p=barang&hal=$i\">$i</a>";
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