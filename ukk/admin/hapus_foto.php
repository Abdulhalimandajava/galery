<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login'){
    echo "<Script>
    alert('Anda belum login');
    location.href='../index.php';
    </Script>";
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <style>

    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="index.php"><span>Album Saya</span></a></li>
                <li><a href="home.php"><span>Home</span></a></li>
                <li><a href="foto.php"><span>Foto</span></a></li>
                <li><a href="album.php"><span>Album</span></a></li>
            </ul>
        </div>
        <div class="content">
            <div class="card">
            <div class="card-header">
                <h2>Hapus Data</h2>
                <a href="../config/aksi_logout.php" class="logout"><h4>logout</h4></a>
            </div>
            <div class="card-body">
            <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                <?php
                include '../config/koneksi.php';
                $id = $_GET['id'];
                $sql= mysqli_query($koneksi,"SELECT * FROM foto WHERE id='$id'");
                while ($data=mysqli_fetch_array($sql)){                
                ?>
                 <input type="text" name="id" value="<?php echo $data['id'] ?>" hidden>
                 <input type="text" name="judul_foto" value="<?php echo $data['judul_foto'] ?>" hidden>
                 Apakah Anda Yakin Akan Menghapus Data?
                 <strong><?php echo $data['judul_foto'] ?></strong>
                 <button type="submit" class="btn btn-primary" name="hapus">Hapus Data</button>
                <?php } ?>
            </form>
            </div>
            </div>
        </div>
       
    </div>
</body>
</html>