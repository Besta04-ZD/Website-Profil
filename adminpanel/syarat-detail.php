<?php
    require "session_admin.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM syarat WHERE id='$id'");
    $data = mysqli_fetch_array($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
    <h2>Syarat & Ketentuan</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="syarat">Syarat & Ketentuan</label>
                    <input type="text" name="syarat" id="syarat" class="form-control" value="<?php echo $data['syarat']; ?>">
                </div>
                <div class="mt-2 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
                </div>
            </form>

            <?php
                if(isset($_POST['editBtn'])){
                    $Syarat = htmlspecialchars($_POST['syarat']);

                    if($data['syarat']==$Syarat){
            ?>
                        <meta http-equiv="refresh" content="2, url=syarat.php" />
            <?php
                    }
                    else{
                        $query = mysqli_query($con, "SELECT * FROM syarat WHERE syarat='$Syarat'");
                        $jumlahData = mysqli_num_rows($query);
                        
                        if($jumlahData > 0){
            ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Syarat & Ketentuan sudah ada
                    </div>     
            <?php
                        }
                        else{
                            $querySimpan = mysqli_query($con, "UPDATE syarat SET syarat='$Syarat' WHERE
                            id='$id'" );
                            
                            if($querySimpan){
            ?>
                        <div class="alert alert-primary" role="alert">
                        Syarat & Ketentuan diupdate
                        </div>
                                        
                        <meta http-equiv="refresh" content="2, url=syarat.php" />
            <?php 
                            }
                            else{
                                echo mysqli_error($con);
                            }
                        }
                    }
                }

                if(isset($_POST['deleteBtn'])){
                    $queryDelete = mysqli_query($con, "DELETE FROM syarat WHERE id='$id'");

                    if($queryDelete){
            ?>
                    <div class="alert alert-primary" role="alert">
                        Syarat & Ketentuan dihapus
                    </div>

                    <meta http-equiv="refresh" content="2, url=syarat.php" />
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