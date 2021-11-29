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
    <div class="content">
        <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
        <?php
        $query = "SELECT * FROM mading WHERE id_kelas = $kelas";
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
                            <div type="button " class="btn btn-primary button i"><a href="index.php?p=barang-edit&id=<?php echo $r_tampil_barang['id_barang']; ?>" style="text-decoration: none; color:white;"><i class="fas fa-edit" style="margin-bottom: 5px; margin-left:-5px;"></i></a></div>
                            <div type="button" class="btn btn-danger button"><a href="proses/barang-hapus.php?id=<?php echo $r_tampil_barang['id_barang']; ?>" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" style="text-decoration: none; color:white;"><i class="fas fa-trash-alt" style="margin-bottom: 4px; margin-left:-4px;"></i></a></div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

</section>