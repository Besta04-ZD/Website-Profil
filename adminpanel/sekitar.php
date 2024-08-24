<?php

    require "session_admin.php";
    require "../koneksi.php";

    
    $querySekitar = mysqli_query($con, "SELECT * FROM sekitar");
    $jumlahSekitar = mysqli_num_rows($querySekitar);

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
    <title>Fasilitas dan Sekitar</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php require "navbar.php"; ?>
    <div class="container mt-5">
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Data</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nnama_tempat">Nama Tempat</label>
                        <input type="text" id="nama_tempat" name="nama_tempat" class="form-control" autocomplete="off"
                        required>
                    </div>
                    <div class="mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control-file">
                    </div>
                    <div class="mb-3">
                        <label for="jarak">Jarak</label>
                        <input type="text" id="jarak" name="jarak" class="form-control" autocomplete="off"
                        required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>

                <?php
                    if(isset($_POST['simpan'])){
                        $nama = htmlspecialchars($_POST['nama_tempat']);
                        $jarak = htmlspecialchars($_POST['jarak']);

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
                            $imageFileType !='gif' && $imageFileType !='png'){
                ?>
                        <div class="alert alert-danger mt-3" role="alert">
                        File harus jpg, jpeg, png dan gif
                        </div>  
                <?php
                        }
                        else{
                            move_uploaded_file($_FILES['foto']['tmp_name'],
                            $target_dir . $new_name);
                            }
                        }
                    }

                        $queryTambah = mysqli_query($con, "INSERT INTO  sekitar (nama_tempat, foto, jarak) 
                        VALUES ('$nama', '$new_name', '$jarak')");

                        if($queryTambah){
                ?>
                        <div class="alert alert-primary" role="alert">
                        Data Tersimpan
                        </div>
                                
                        <meta http-equiv="refresh" content="2, url=sekitar.php" />
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
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Tempat</th>
                            <th>Jarak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($jumlahSekitar == 0){
                    ?>
                        <tr>
                            <td colspan=4 class="text-center">Tidak ada Data Fasilitas dan Sekitar</td>
                        </tr>
                    <?php
                        } else {
                        $jumlah = 1;
                        while($data = mysqli_fetch_array($querySekitar)){
                    ?>
                        <tr>
                            <td><?php echo $jumlah; ?></td>
                            <td><?php echo $data['nama_tempat']; ?></td>
                            <td><?php echo $data['jarak']; ?></td>
                            <td><a href="sekitar-detail.php?p=<?php echo $data['id']; ?>" 
                            class="btn btn-warning">Action</a></td>
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