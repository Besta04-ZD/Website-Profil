<?php
    require "session_admin.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT a.*, b.tipe AS tipe_kamar FROM kamar a JOIN tipe b ON a.
    id_tipe=b.id_tipe WHERE a.id_kamar='$id'");
    $data = mysqli_fetch_array($query);

    $querytipe = mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe!='$data[id_tipe]'");

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
        <h2>Detail Kamar</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>" class="form-control" autocomplete="off"
                    required>
                </div>
                <div>
                    <label for="tipe">Kategori</label>
                        <select name="tipe" id="tipe" class="form-control" required>
                            <option value="<?php echo $data['id_tipe']; ?>"><?php echo $data['tipe_kamar'] ?></option>
                        <?php
                            while($datatipe=mysqli_fetch_array($querytipe)){
                        ?>
                            <option value="<?php echo $datatipe['id_tipe']; ?>"><?php echo $datatipe['tipe']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                <label for="harga">Harga</label>
                    <input type="number" class="form-control" value="<?php echo $data['harga'] ?>" name="harga" required>
                </div>
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
                <div>
                    <label for="ketersediaan">Ketersediaan</label>
                    <select name="ketersediaan" id="ketersediaan" class="form-control">
                        <option value="<?php echo $data['ketersediaan']; ?>"><?php echo 
                        $data['ketersediaan']; ?></option>
                        <?php
                            if($data['ketersediaan']=='tersedia'){
                        ?>
                            <option value="penuh">Penuh</option>
                        <?php
                            }
                            else{
                        ?>
                            <option value="tersedia">Tersedia</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $tipe = htmlspecialchars($_POST['tipe']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan = htmlspecialchars($_POST['ketersediaan']);

                    $target_dir ="../image/";
                    $nama_file = basename($_FILES['foto']['name']);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama=='' || $tipe=='' || $harga==''){
            ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Nama, kategori dan harga wajib
                    </div>   
            <?php
                    }
                    else{
                       $queryUpdate = mysqli_query($con, "UPDATE kamar SET id_tipe='$tipe', 
                       nama='$nama', harga='$harga', detail='$detail', ketersediaan='$ketersediaan' WHERE id_kamar=$id");

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

                                    $queryUpdate = mysqli_query($con, "UPDATE kamar SET foto='$new_name' WHERE id_kamar='$id'");

                                    if($queryUpdate){
            ?>
                                        <div class="alert alert-primary" role="alert">
                                            Kamar DiUpdate
                                        </div>
                                        
                                        <meta http-equiv="refresh" content="2, url=kamar.php" />
            <?php 
                                    }
                                }
                            }
                       }
                    }
                }

                if(isset($_POST['hapus'])){
                    $queryHapus = mysqli_query($con, "DELETE FROM kamar WHERE id_kamar='$id'");

                    if($queryHapus){
            ?>
                    <div class="alert alert-primary" role="alert">
                    Kamar dihapus
                    </div>
    
                    <meta http-equiv="refresh" content="2, url=Kamar.php" />
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