<?php
    require "session_admin.php";
    require "../koneksi.php";

    $queryTipe = mysqli_query($con, "SELECT * FROM tipe");
    $jumlahTipe = mysqli_num_rows($queryTipe);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Kamar</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Tipe Kamar</h3>
                <form action="" method="post">
                    <div>
                        <label for="tipe">Tipe Kamar</label>
                        <input type="text" id="tipe" name="tipe" placeholder="input tipe kamar"
                        class="form-control">
                    </div>
                    <div class= "mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_tipe">Simpan</button>
                    </div>
                </form>

                <?php
                    if(isset($_POST['simpan_tipe'])){
                        $Tipe = htmlspecialchars($_POST['tipe']);

                        $queryExist = mysqli_query($con, "SELECT tipe FROM tipe WHERE
                        tipe='$Tipe'");
                        $jumlahDataTipeBaru = mysqli_num_rows($queryExist);

                        if($jumlahDataTipeBaru > 0){
                ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Tipe Kamar sudah ada
                        </div>       
                <?php        
                        }
                        else{
                            $querySimpan = mysqli_query($con, "INSERT INTO tipe (tipe) VALUES
                            ('$Tipe')" );

                            if($querySimpan){
                ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Tipe Kamar tersimpan
                        </div>
                        
                        <meta http-equiv="refresh" content="2, url=tipe.php" />
                <?php 
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                ?>
        </div>

        <div class="container mt-3">
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tipe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($jumlahTipe ==0){
                        ?>
                            <tr>
                                <td colspan=3 class="text-center">Tidak ada data Tipe Kamar</td>
                            </tr>
                        <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data=mysqli_fetch_array($queryTipe)){
                        ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['tipe']; ?></td>
                                    <td>
                                        <a href="tipe-detail.php?p=<?php echo $data['id_tipe']; ?>"
                                        class="btn btn-warning">Action</a>
                                    </td>
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>