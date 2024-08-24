<?php
    require "session_admin.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM galeri WHERE id='$id'");
    $data = mysqli_fetch_array($query);

    function generateRandomString($length = 10){
        $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomstring = '';
        for ($i = 0; $i < $length; $i++){
            $randomstring .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomstring;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kamar</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<style>
    form div{
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Gambar</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>" class="form-control" autocomplete="off"
                    required>
                </div>
                <div>
                <div>
                    <label for="currentFoto">Foto sekarang</label>
                    <img src="../image/<?php echo $data['foto']; ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail']; ?>
                    </textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $detail = htmlspecialchars($_POST['detail']);
    
                    $target_dir ="../image/";
                    $nama_file = basename($_FILES['foto']['name']);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;
    
                    if($nama==''){
            ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Nama, kategori dan harga wajib
                    </div>   
            <?php
                    }
                    else{
                       $queryUpdate = mysqli_query($con, "UPDATE galeri SET id='$id', nama='$nama', 
                       detail='$detail' WHERE id=$id");

                       if($nama_file!=''){
                        if($image_size > 2000000){
            ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                File harus dibawah 2 mb
                            </div>   
        
            <?php 
                        }
                        else{
                            if($imageFileType != 'jpg' && $imageFileType !='jpeg' &&
                            $imageFileType !='gif' &&  $imageFileType !='png'){
            ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    File harus jpg, jpeg gif dan png
                                </div>   
            
            <?php 
                                }
                                else{
                                    move_uploaded_file($_FILES['foto']['tmp_name'],
                                    $target_dir . $new_name);

                                    $queryUpdate = mysqli_query($con, "UPDATE galeri SET foto='$new_name' WHERE id='$id'");

                                    if($queryUpdate){
            ?>
                                        <div class="alert alert-primary" role="alert">
                                        Data Gambar DiUpdate
                                        </div>
                                        
                                        <meta http-equiv="refresh" content="2, url=galeri.php" />
            <?php 
                                    }
                                }
                            }
                       }
                    }
                }

                if(isset($_POST['hapus'])){
                    $queryHapus = mysqli_query($con, "DELETE FROM galeri WHERE id='$id'");

                    if($queryHapus){
            ?>
                    <div class="alert alert-primary" role="alert">
                    Data Gambar dihapus
                    </div>
    
                    <meta http-equiv="refresh" content="2, url=galeri.php" />
            <?php
                    }
                }
            ?>

        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>