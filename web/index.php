<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/landing_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Petrona" rel="stylesheet">
    <script src="../assets/js/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    </script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<!-- rgba(244, 244, 244, 0); -->

<body>
    <div class="content1" id="content1">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgba(244, 244, 244, 0); border:none;">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 10%;">
                        <li class="nav-item">
                            <a class="nav-link active" href="#content1">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#content2">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#content3">Features</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="login.php">Login</a>
                        <a href="register(admin).php" class="btn" type="submit">Daftar</a>
                    </form>
                </div>
            </div>
        </nav>
        <div class="row" style="width: 100%;">
            <div class="col-md-6">
                <p class="p2">
                    Financial Recording easily and reliably
                </p>
                <p class="p3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisl purus tempus feugiat nulla.
                </p>
                <button class="btn2">Get Started</button>
            </div>
            <div class="col-md-6"><img src="assets/gbr_landing/bg91.png" alt="" width="80%"></div>
        </div>
    </div>
    <div class="content2" id="content2">
        <div class="row" style="width: 100%;">
            <div class="col-lg-6">
                <img src="assets/gbr_landing/jkl.png" alt="" width="80%">
            </div>
            <div class="col-lg-6">
                <p class="p2">
                    Financial Recording easily and reliably
                </p>
                <p class="p3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisl purus tempus feugiat nulla.
                </p>
            </div>
        </div>
    </div>
    <div class="content3" id="content3">
        <p>Our Features</p>
        <hr>
        <div class="row" style="width: 100%;">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <img src="assets/gbr_landing/logo1.png" alt="" width="15%">
                        <p class="judul">Cash Flow Management</p>
                        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisl purus tempus feugiat nulla.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <img src="assets/gbr_landing/logo2.png" alt="" width="15%">
                        <p class="judul">Easy payment</p>
                        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisl purus tempus feugiat nulla.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <img src="assets/gbr_landing/logo3.png" alt="" width="15%">
                        <p class="judul">Cash Flow Management</p>
                        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisl purus tempus feugiat nulla.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content4">
        <div class="row" style="width: 100%;">
            <div class="col-md-6">
                <p class="p2">
                    Financial Recording easily and reliably
                </p>
                <p class="p3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisl purus tempus feugiat nulla.
                </p>
            </div>
            <div class="col-md-6"><img src="assets/gbr_landing/gbr1.png" alt="" width="50%"></div>
        </div>
    </div>
    <div class="content5">
        <p align="center" class="p1">Start your class financial<br> management</p>
        <p align="center" class="p2">Lorem ipsum dolor sit amet, consectetur<br> adipiscing elit. Morbi nisl purus.</p>
        <p align="center"><button align="center" onclick="register()">Sign Up</button></p>
    </div>
    <script>
        function register() {
            window.location.href = "register(admin).php";
        }
    </script>
</body>

</html>