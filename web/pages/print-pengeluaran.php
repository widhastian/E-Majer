<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <p class="mt-4"><b>Pembayaran Uang Kas</b><br>
            TIF B - Muh Yusril Amin</p>
        <p align="right">Tanggal : 8 November 2021</p>
        <table class="table table-bordered">
            <tr align="center">
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nominal Uang Kas</th>
                <th>Status</th>
            </tr>
            <tr align="center">
                <td>No</td>
                <td>Nama Siswa</td>
                <td>Kelas</td>
                <td>Nominal Uang Kas</td>
                <td>Status</td>
            </tr>
        </table>
        <div class="box1">
            <p style="font-size: 12px; padding-top:10px; " align="center">Transaksi Bendahara</p>
            <canvas id="myChart"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM transaksi GROUP BY tanggal_transaksi");
                        while ($row = mysqli_fetch_array($result)) {
                            $date   =  $row['tanggal_transaksi']; ?> "<?= $date ?>",
                        <?php
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Belum Bayar',
                        data: [
                            <?php
                            $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi status ='1' GROUP BY tanggal_transaksi");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $bayar = $row['total'];
                            ?>
                                    <?= $bayar ?>,
                            <?php
                                }
                            }
                            ?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                        ],
                        borderWidth: 1
                    }, {
                        label: 'Bayar',
                        data: [
                            <?php
                            $result = mysqli_query($koneksi, "SELECT *, COUNT( * ) AS total FROM transaksi status = '2'  GROUP BY tanggal_transaksi");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $bayar = $row['total'];
                            ?>
                                    <?= $bayar ?>,
                            <?php
                                }
                            }
                            ?>
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </div>
</body>

</html>