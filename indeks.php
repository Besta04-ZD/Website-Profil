<?php
    require "koneksi.php";

    $querySekitar = mysqli_query($con, "SELECT id, nama_tempat, foto, jarak FROM sekitar LIMIT 6");

    $queryGambar = mysqli_query($con, "SELECT id, nama, foto, detail FROM galeri LIMIT 3");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div id="hero-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#hero-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#hero-carousel" data-slide-to="1"></li>
            <li data-target="#hero-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active c-item">
                <img class="d-block w-100 c-img" src="image1/Kos Green Sinabung.png" alt="First slide">
                <div class="carousel-caption text align-self-center">
                    <h1>Selamat Datang di Website Kost Green Sinabung</h1>
                    <p>Cari Kosan di daerah Medan Petisah dengan banyak tempat tujuan cari disini saja</p>
                    <a href="profil.php" class="btn btn-primary">Lihat Profil</a>
                </div>
            </div>
            <div class="carousel-item c-item">
                <img class="d-block w-100 c-img" src="image1/indeks 2.jpg" alt="Second slide">
                <div class="carousel-caption text align-self-center">
                    <h1>Langsung Cari Kamar?</h1>
                    <p>Kost Green Sinabung memiliki banyak pilihan kamar dengan tipe yang berbeda menyesuaikan dengan fasilitas pribadi dan harga
                    </p>
                    <a href="kamar.php" class="btn btn-primary">Lihat Kamar</a>
                </div>
            </div>
            <div class="carousel-item c-item">
                <img class="d-block w-100 c-img" src="image1/Slide 3.jpg" alt="Third slide">
                <div class="carousel-caption text align-self-center">
                    <h1>Lihat Kondisi Kost?</h1>
                    <p>Ingin memastikan kondisi bangunan dan sekitarnya bisa klik tombol Galeri dibawah
                    </p>
                    <a href="galeri.php" class="btn btn-primary">Galeri</a>
                </div>
            </div>
        </div>
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
    </div>

    <div class="container-fluid py-5 mt-4 text-center">
    <h3>Sekitar</h3>
        <div class="container text-center">
            <div class="row mt-5">
            <?php while($data = mysqli_fetch_array($querySekitar)){ ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                        <img src="image/<?php echo $data['foto']?>" class="card-img-top"  alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama_tempat']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['jarak']?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div class="container-fluid py-5 mt-4">
        <div class="container text-center">
            <h3>Galleri</h3>

            <div class="row mt-5">
            <?php while($data = mysqli_fetch_array($queryGambar)){ ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                        <img src="image/<?php echo $data['foto']?>" class="card-img-top"  alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail']?></p>
                            <a href="galeri-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna1 text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-warning mt-3 p-3 fs-2" href="galeri.php">See more</a>
        </div>
    </div>



    <?php require "footer.php"; ?>

    <script src="fontawesome/js/fontawesome.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>