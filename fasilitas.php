<?php
    require "koneksi.php";

    $queryFasilitas = mysqli_query($con, "SELECT id, fasilitas, foto, detail FROM fasilitas");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website | Fasilitas</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require "navbar.php"; ?>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3 class="text-center">Fasilitas</h3>
            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryFasilitas)){ ?>
                    <div class="col-md-3 col-sm-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $data['foto']?>" class="card-img-top"  alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['fasilitas']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail']?></p>
                                <a href="fasilitas-detail.php?fasilitas=<?php echo $data['fasilitas']; ?>" class="btn warna1 text-white">Lihat Detail</a>
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