<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_detail ='$id'");
$data = mysqli_fetch_array($query);
?>
<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text">Edit Detail Transaksi</span>
    </div>
    <div class="content">
        <table width="80%">
            <form action="proses/detail-edit-proses.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" onsubmit="return tambah();">
                <tr>
                    <td style="width:15%; padding-top:1%"><label for="validationServer01" class="form-label ">Nama Barang</label></td>
                    <td style="width: 3%;">:</td>
                    <td>
                        <div class="input-group has-validation">
                            <input type="hidden" value="<?= $id ?>" name="id">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-briefcase-alt'></i></span>
                            <select class="form-select" id="barang" name="barang">
                                <option value="0">-- Nama Barang --</option>
                                <?php
                                require('koneksi.php');
                                $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_kelas = '$kelas'");
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($row['id_barang'] == $data['id_barang']) { ?>
                                            <option value="<?= $row['id_barang'] ?>" selected><?= $row['Nama_barang'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $row['id_barang'] ?>"><?= $row['Nama_barang'] ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2%;"><label for="validationServer01" class="form-label ">Jumlah Barang</label></td>
                    <td style="padding-top: 1%;">:</td>
                    <td>
                        <div class="input-group mt-3"> <input type="hidden" value="<?= $data['id_pengeluaran'] ?>" name="transaksi">
                            <span class="input-group-text" id="inputGroupPrepend"><i class='bx bx-spreadsheet'></i></span>
                            <input type="text" class="form-control" id="jumlah" n aria-describedby="inputGroupPrepend" placeholder="Jumlah Barang" name="jumlah" value="<?= $data['jumlah'] ?>">
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