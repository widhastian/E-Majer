<?php $transaksi = $_GET['id']; ?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Detail Pengeluaran</span>
    </div>
    <div class="content">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-plus"></i> Tambah
        </button>
        <button type="button" class="btn btn-secondary"><i class="fas fa-print"></i> Print</button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Transaksi Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses/detail-tambah-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-briefcase-alt'></i></span>
                                    <select class="form-select" id="barang" name="barang">
                                        <option value="0">-- Nama Barang --</option>
                                        <?php
                                        require('koneksi.php');
                                        $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_kelas = '$kelas'");
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <option value="<?= $row['id_barang'] ?>"><?= $row['Nama_barang'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <input type="hidden" value="<?= $transaksi ?>" name="transaksi">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-spreadsheet'></i></span>
                                    <input type="text" class="form-control" id="jumlah" n aria-describedby="inputGroupPrepend" placeholder="Jumlah Barang" name="jumlah">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        <button type="submit" class="btn btn-success" name="btn-tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped mt-4 ml-3" style="width:96%; text-align:center;">
            <tr>
                <td>No</td>
                <td>Nama Barang</td>
                <td>Jumlah Barang</td>
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
                    $sql = "SELECT * FROM detail_transaksi INNER JOIN pengeluaran ON detail_transaksi.id_pengeluaran = pengeluaran.id_pengeluaran JOIN 
                            barang ON detail_transaksi.id_barang = barang.id_barang WHERE Nama_transaksi LIKE '%$pencarian%'";

                    $query = $sql;
                    $queryJml = $sql;
                } else {
                    $query = "SELECT * FROM detail_transaksi INNER JOIN pengeluaran ON detail_transaksi.id_pengeluaran = pengeluaran.id_pengeluaran JOIN 
                            barang ON detail_transaksi.id_barang = barang.id_barang WHERE pengeluaran.id_pengeluaran  = '$transaksi'";
                    $queryJml = "SELECT * FROM detail_transaksi INNER JOIN pengeluaran ON detail_transaksi.id_pengeluaran = pengeluaran.id_pengeluaran JOIN 
                    barang ON detail_transaksi.id_barang = barang.id_barang WHERE pengeluaran.id_pengeluaran  = '$transaksi'  ";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM detail_transaksi INNER JOIN pengeluaran ON detail_transaksi.id_pengeluaran = pengeluaran.id_pengeluaran JOIN 
                            barang ON detail_transaksi.id_barang = barang.id_barang WHERE pengeluaran.id_pengeluaran  = '$transaksi'  ";
                $queryJml = "SELECT * FROM detail_transaksi INNER JOIN pengeluaran ON detail_transaksi.id_pengeluaran = pengeluaran.id_pengeluaran JOIN 
                            barang ON detail_transaksi.id_barang = barang.id_barang WHERE pengeluaran.id_pengeluaran  = '$transaksi' ";
                $no = $posisi * 1;
            }

            //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
            $q_tampil_detail = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($q_tampil_detail) > 0) {
                while ($r_tampil_detail = mysqli_fetch_array($q_tampil_detail)) {
            ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_detail['Nama_barang']; ?></td>
                        <td><?php echo $r_tampil_detail['jumlah']; ?></td>
                        <td>
                            <a href="navbar.php?p=detail-edit&id=<?php echo $r_tampil_detail['id_detail']; ?>" style="text-decoration: none; color:white;">
                                <div type="button" class="btn btn-primary"><i class="fas fa-edit"></i></div>
                            </a>
                            <button type="button" class="btn btn-danger" onclick="konfirmasi('<?= $r_tampil_detail['id_detail']; ?>','<?= $r_tampil_detail['id_pengeluaran'] ?>')"><i class="fas fa-trash-alt"></i></button>
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
<script>
    function pesan(judul, status) {
        swal.fire({
            title: judul,
            icon: status,
            confirmButtonColor: '#6777ef',
        });
    }

    var barang = document.getElementById('barang');
    var jumlah = document.getElementById('jumlah');

    function tambah() {
        if (barang.value == "0") {
            pesan('Barang Tidak Boleh Kosong', 'warning');
            return false;
        } else if (jumlah.value == "") {
            pesan('Jumlah Barang Tidak Boleh Kosong', 'warning');
            return false;
        }
    }

    function konfirmasi(id, transaksi) {
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
                window.location.href = "proses/detail-hapus-proses.php?id=" + id + "&transaksi=" + transaksi;
            }
        });
    }
</script>