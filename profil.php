<?php
    require "koneksi.php";

    $querySyarat = mysqli_query($con, "SELECT * FROM syarat");
    $jumlahSyarat = mysqli_num_rows($querySyarat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website | Profil</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid warna2 py-3 text-center">
    <h3>Sejarah Kos</h3>
    </div>
        <div class="container text-center">          
            <div class="col-md-8 offset-md-2">
                    <div>
                        Kost Green Sinabung merupakan Kost Pria dan Wanita yang berada di medan 
                        tepatnya di Jl. Mistar, Sei Putih Bar., Kec. Medan Petisah, Kota Medan, 
                        Sumatera Utara 20118.
                        <br>
                        <br> 
                        Kost Green Sinabung dibangun atau berdiri pada tahun 2014 dengan nama awal 
                        Apartmen Green Leuser dan Green leuser Cafe & Coffe Shop. Kafe sendiri berada 
                        di lantai 1, dan kamar berada di lantai 1, 2 dan 3. Lantai 4 diperuntukan anak kos 
                        untuk menjemur pakaian.
                        <br>
                        <br> 
                        Pada tahun 2020 berhenti sementara dikarenakan wabah covid dan dibuka 
                        kembali pada September 2022 sebagai Kost dengan nama Kost Green Sinabung.
                    </div>
            </div>
        </div>
    </div>

    <div class="container-fluid warna2 py-3 mt-4 text-center">
    <h3>Syarat & Ketentuan</h3>
    </div>
    <div class="container py-3 mt-4 text-center">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Syarat & Ketentuan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($jumlahSyarat ==0){
                            ?>
                                <tr>
                                    <td colspan=3 class="text-center">Tidak ada data Syarat & Ketentuan</td>
                                </tr>
                            <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data=mysqli_fetch_array($querySyarat)){
                            ?>
                                <tr>
                                    <td><?php echo $data['syarat']; ?></td>
                                </tr>
                            <?php
                                $jumlah++;
                                }
                        
                            }
                            ?>
                    </tbody>
                </table>
            </div>
    </div>

    <?php require "footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
