<?php
    require "session_admin.php";
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT a.*, b.tipe AS tipe_kamar FROM kamar a JOIN tipe b ON a.id_tipe=b.id_tipe WHERE ketersediaan = 'tersedia'");
    $jumlahKamar = mysqli_num_rows($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamar Tersedia</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .summary-tersedia{
            background-color: #ECB176;
            border-radius: 10px; 
            width: 300px;
            height: 200px;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <div class="mt-3 mb-5">
            <h2>List Kamar Yang Tersedia</h2>
            <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tipe Kamar</th>
                        <th>Harga</th>
                        <th>Ketersediaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        if($jumlahKamar==0){
                    ?>
                        <tr>
                        <td colspan=6 class="text-center">Tidak ada data Kamar</td>
                        </tr>
                    <?php
                        }
                        else{
                            $jumlah = 1;
                            while($data=mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $jumlah; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['tipe_kamar']; ?></td>
                            <td><?php echo $data['harga']; ?></td>
                            <td><?php echo $data['ketersediaan']; ?></td>
                            <td>
                                <a href="kamar-detail.php?p=<?php echo $data['id_tipe']; ?>"
                                    class="btn btn-warning">Action</a>
                                </td>
                        </tr>
                    <?php
                            $jumlah++;
                            }
                        }
                    ?>
                 </tbody>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
