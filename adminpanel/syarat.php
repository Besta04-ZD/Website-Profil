<?php
    require "session_admin.php";
    require "../koneksi.php";

    $querySyarat = mysqli_query($con, "SELECT * FROM syarat");
    $jumlahSyarat = mysqli_num_rows($querySyarat);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&K</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <div class="container mt-5">
        <div class="col-12 col-md-6">
            <h3>Tambah Syarat & Ketentuan</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <input type="text" id="syarat" name="syarat" placeholder="input Syarat & Ketentuan"
                        autocomplete="off" class="form-control">
                    </div>
                    <div class= "mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_syarat">Simpan</button>
                    </div>
                </form>

                <?php
                    if(isset($_POST['simpan_syarat'])){
                        $syarat = htmlspecialchars($_POST['syarat']);

                        $queryExist = mysqli_query($con, "SELECT syarat FROM syarat WHERE
                        syarat='$syarat'");
                        $jumlahDataSyaratBaru = mysqli_num_rows($queryExist);

                        if($jumlahDataSyaratBaru > 0){
                ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Syarat & Ketentuan sudah ada
                        </div>       
                <?php        
                        }
                        else{
                            $querySimpan = mysqli_query($con, "INSERT INTO syarat (syarat) VALUES
                            ('$syarat')" );

                            if($querySimpan){
                ?>
                        <div class="alert alert-primary" role="alert">
                            Syarat & Ketentuan Tersimpan
                        </div>
                    
                        <meta http-equiv="refresh" content="2, url=syarat.php" />
                <?php 
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                ?>
        </div>

        <div class="container mt-3 mb-5">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Syarat & Ketentuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($jumlahSyarat ==0){
                    ?>
                            <tr>
                                <td colspan=3 class="text-center">Tidak ada Data Syarat & Ketentuan</td>
                            </tr>
                    <?php
                        }
                        else{
                            $jumlah = 1;
                            while($data=mysqli_fetch_array($querySyarat)){
                    ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['syarat']; ?></td>
                                <td>
                                <a href="syarat-detail.php?p=<?php echo $data['id']; ?>"
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