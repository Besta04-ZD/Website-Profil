<?php
    require "session_admin.php";
    require "../koneksi.php";

    $queryTipe = mysqli_query($con, "SELECT * FROM tipe");
    $jumlahTipe = mysqli_num_rows($queryTipe);

    $queryKamar = mysqli_query($con, "SELECT * FROM kamar");
    $jumlahKamar = mysqli_num_rows($queryKamar);

    $queryTersedia = mysqli_query($con, "SELECT * FROM kamar WHERE ketersediaan = 'tersedia'");
    $jumlahTersedia = mysqli_num_rows($queryTersedia);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .kotak {
            border: solid;
        }

        .summary-tipe{
            background-color: #80391e;
            border-radius: 10px;
            width: 300px;
            height: 200px;
        }

        .summary-kamar{
            background-color: #dfc8a2;
            border-radius: 10px; 
            width: 300px;
            height: 200px;
        }

        .summary-tersedia{
            background-color: #ECB176;
            border-radius: 10px; 
            width: 300px;
            height: 200px;
        }

    </style>
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <h2>Halo, Admin</h2>

        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-tipe p-5">
                    <div class="row">
                        <div class="text-white">
                            <h3 class="fs-2">Tipe Kamar</h3>
                            <p class="fs-4"><?php echo $jumlahTipe; ?> Tipe</p>
                            <p><a href="tipe.php" class="text-white">Lihat detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-kamar p-5">
                    <div class="row">
                        <div class="text-white">
                            <h3 class="fs-2">Jumlah Kamar</h3> 
                            <p class="fs-4"><?php echo $jumlahKamar; ?> Kamar</p>
                            <p><a href="kamar.php" class="text-white">Lihat detail</a></p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="summary-tersedia p-5">
                    <div class="row">
                        <div class="text-white">
                            <h4 class="fs-4">Kamar Yang Tersedia</h4> 
                            <p class="fs-4"><?php echo $jumlahTersedia; ?> kamar</p>
                            <?php if ($jumlahTersedia > -1): ?>
                                <p><a href="kamar_tersedia.php" class="text-white">Lihat detail</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
