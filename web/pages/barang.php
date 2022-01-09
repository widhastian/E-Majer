<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Data Barang</span>
    </div>
    </div>
    <div class="content">
        <!-- Button trigger modal -->
        <div class="row" style="width:97%;">
            <div class="col-md-8">
                <?php if ($level == 1) { ?>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <form class="row g-3" style="margin-left: 13%; margin-bottom:-15px;" method="POST">
                    <div class="col-auto">
                        <input type="text" name="pencarian" class="form-control" id="inputPassword2" placeholder="Nama Barang">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" style="height: 40px; padding-top:8px; width:45px; padding-left:11px;"><i class='bx bx-search-alt fs-4'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses/barang-tambah-proses.php?judul=Data Barang" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <input type="hidden" value="<?= $no ?>" name="kelas">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-briefcase-alt'></i></span>
                                    <input type="text" class="form-control" id="nama_barang" n aria-describedby="inputGroupPrepend" placeholder="Nama Barang" name="nama_barang">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-spreadsheet'></i></span>
                                    <input type="number" class="form-control" id="jumlah_barang" aria-describedby="inputGroupPrepend" placeholder="Jumlah Barang" name="jumlah_barang">
                                    <input type="hidden" value="<?= $kelas ?>" name="kelas">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-pie-chart-alt-2'></i></span>
                                    <select class="form-select" id="kondisi" name="kondisi">
                                        <option value="0">-- Kondisi --</option>
                                        <option value="1">Baik</option>
                                        <option value="2">Kurang Baik</option>
                                        <option value="3">Rusak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" name="foto" id="foto" aria-describedby="inputGroupPrepend">
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
        <table class="table table-striped mt-4 ml-3" style="width:96%; text-align:center;">
            <tr>
                <td>No</td>
                <td>Nama Barang</td>
                <td>Jumlah Barang</td>
                <td>Kondisi</td>
                <td>Foto</td>
                <?php if ($level == 1) { ?>
                    <td colspan="2">action</td>
                <?php } ?>
            </tr>
            <?php
            $judul = $_GET['judul'];
            $batas = 4;
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
                    $query = "SELECT * FROM barang WHERE Nama_barang LIKE '%$pencarian%' LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM barang WHERE Nama_barang LIKE '%$pencarian%'";
                    $no = $posisi * 1;
                } else {
                    $query = "SELECT * FROM barang WHERE id_kelas = '$kelas' LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM barang WHERE id_kelas = '$kelas'";
                    $no = $posisi * 1;
                }
            } else {
                $query = "SELECT * FROM barang WHERE id_kelas = '$kelas' LIMIT $posisi, $batas";
                $queryJml = "SELECT * FROM barang WHERE id_kelas = '$kelas'";
                $no = $posisi * 1;
            }

            //$sql="SELECT * FROM tbtranskasi ORDER BY idanggota DESC";
            $q_tampil_barang = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($q_tampil_barang) > 0) {
                while ($r_tampil_barang = mysqli_fetch_array($q_tampil_barang)) {
                    if (empty($r_tampil_barang['foto']) or ($r_tampil_barang['foto'] == '-')) {
                        $foto = "barang.jpg";
                    } else {
                        $foto = $r_tampil_barang['foto'];
                    }
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
                        <td><img src="<?php echo "images/barang/" . $foto ?>" width=70px height=70px></td>
                        <?php if ($level == 1) { ?>
                            <td>
                                <a href="navbar.php?p=barang-edit&id=<?php echo $r_tampil_barang['id_barang']; ?>&judul=Edit Barang" style="text-decoration: none; color:white;">
                                    <div type="button" class="btn btn-primary"><i class="fas fa-edit"></i></div>
                                </a>
                                <button type="button" class="btn btn-danger" onclick="konfirmasi('<?php echo $r_tampil_barang['id_barang']; ?>')"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        <?php } ?>
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
        ?>
                <div class="pagination">
                    <?php
                    $jml_hal = ceil($jml / $batas);
                    for ($i = 1; $i <= $jml_hal; $i++) {
                        if ($i != $hal) {
                            echo "<a href=\"?p=barang&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "<meta http-equiv='refresh' content='0; url=navbar.php?p=barang&judul=Data Barang'>";
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
                        echo "<a href=\"?p=barang&judul=Data Barang&hal=$i\">$i</a>";
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

    var nama_barang = document.getElementById('nama_barang');
    var jumlah_barang = document.getElementById('jumlah_barang');
    var kondisi = document.getElementById('kondisi');
    var foto = document.getElementById('foto');

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
        } else if (foto.value == "") {
            pesan('Foto Tidak Boleh Kosong', 'warning');
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
                window.location.href = "proses/barang-hapus-proses.php?id=" + id + "&judul=Data Barang";
            }
        });

    }
</script>