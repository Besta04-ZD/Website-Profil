<?php

    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryKamar = mysqli_query($con, "SELECT * FROM kamar WHERE nama='$nama'");
    $kamar = mysqli_fetch_array($queryKamar);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website | Detail Kamar</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="image-box img col-md-5 mb-3">
                    <img src="image/<?php echo $kamar['foto']; ?>" alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $kamar['nama']; ?></h1>
                    <p class="fs-5">
                        <?php echo htmlspecialchars_decode ($kamar['detail']); ?>
                    </p>
                    <p class="text-harga">
                        Rp <?php echo $kamar['harga']; ?>
                    </p>
                    <p>
                        Ketersediaan : <strong><?php echo $kamar['ketersediaan']; ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>


    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>