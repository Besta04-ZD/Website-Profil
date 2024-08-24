<?php
    require "session_admin.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe='$id'");
    $data = mysqli_fetch_array($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tipe</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Tipe Kamar</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="tipe">Tipe Kamar</label>
                    <input type="text" name="tipe" id="tipe" class="form-control" value="<?php echo $data['tipe']; ?>">
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
                </div>
            </form>

            <?php
                if(isset($_POST['editBtn'])){
                    $tipe = htmlspecialchars($_POST['tipe']);

                    if($data['tipe']==$tipe){
            ?>
                        <meta http-equiv="refresh" content="2, url=kategori.php" />
            <?php
                    }
                    else{
                        $query = mysqli_query($con, "SELECT * FROM tipe WHERE tipe='$tipe'");
                        $jumlahData = mysqli_num_rows($query);
                        
                        if($jumlahData > 0){
            ?>
                    <div class="alert alert-danger mt-3" role="alert">
                    Tipe Kamar sudah ada
                    </div>     
            <?php
                        }
                        else{
                            $querySimpan = mysqli_query($con, "UPDATE tipe SET tipe='$tipe' WHERE
                            id_tipe='$id'" );
                            
                            if($querySimpan){
            ?>
                        <div class="alert alert-primary" role="alert">
                        Tipe Kamar diupdate
                        </div>
                                        
                        <meta http-equiv="refresh" content="2, url=tipe.php" />
            <?php 
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                }

                if(isset($_POST['deleteBtn'])){
                    $queryCheck = mysqli_query($con, "SELECT * FROM kamar WHERE id_tipe='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);

                    if($dataCount>0){
            ?>
                    <div class="alert alert-danger" role="alert">
                    Tipe Kamar tidak bisa dihapus
                    </div>
            <?php
                    die();
                    }

                    $queryDelete = mysqli_query($con, "DELETE FROM tipe WHERE id_tipe='$id'");

                    if($queryDelete){
            ?>
                    <div class="alert alert-primary" role="alert">
                    Tipe Kamar dihapus
                    </div>

                    <meta http-equiv="refresh" content="2, url=tipe.php" />
            <?php
                    }
                    else{
                        echo mysqli_error($con);
                    }
                }
            ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>