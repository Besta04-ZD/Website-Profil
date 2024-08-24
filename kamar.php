<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "koneksi.php";

    $querytipe = mysqli_query($con, "SELECT * FROM tipe");

    if(isset($_GET['keyword'])){
        $queryKamar = mysqli_query($con, "SELECT * FROM kamar WHERE nama LIKE '%$_GET[keyword]%'");
    }

    else if(isset($_GET['tipe'])){
        $queryGetTipeId = mysqli_query($con, "SELECT id_tipe FROM tipe WHERE tipe='$_GET[tipe]'");
        $tipeId = mysqli_fetch_array($queryGetTipeId);

        $queryKamar = mysqli_query($con, "SELECT * FROM kamar WHERE id_tipe='$tipeId[id_tipe]'");
    }
    else{
        $queryKamar = mysqli_query($con, "SELECT * FROM kamar");
    }

    $countData = mysqli_num_rows($queryKamar);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website | Kamar</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require "navbar.php"; ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3 class="text-center mb-3">Tipe Kamar</h3>
                <ul class="list-group">
                <?php  while($tipe = mysqli_fetch_array($querytipe)){?>
                <a href="kamar.php?tipe=<?php echo $tipe['tipe']; ?>">
                    <li class="list-group-item no-decoration1"><?php echo $tipe['tipe']; ?></li>
                </a>
                <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Kamar</h3>
                <div class="row">
                    <?php
                        if($countData<1){
                    ?>
                        <h4 class="my-5 offset-md-4">Kamar tidak tersedia</h4>
                    <?php
                    }
                    ?>


                    <?php while($kamar = mysqli_fetch_array($queryKamar)){ ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="image-box">
                                <img src="image/<?php echo $kamar['foto']; ?>" class="card-img-top"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $kamar['nama']; ?></h4>
                                    <p class="card-text text-truncate"><?php echo $kamar['detail']; ?></p>
                                    <p class="card-text text-harga"><?php echo $kamar['harga']; ?></p>
                                    <a href="kamar-detail.php?nama=<?php echo $kamar['nama']; ?>"
                                     class="btn warna1 text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php"?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>