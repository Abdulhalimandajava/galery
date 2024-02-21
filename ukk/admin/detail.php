<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>alert('Anda belum Login!');
     location.href='../index.php';</script>";
    exit;
}

$user_id = $_SESSION['id'];
$sql=mysqli_query($koneksi, "SELECT foto.*,album.nama_album FROM foto INNER JOIN album ON foto.album_id=album.id WHERE foto.user_id='$user_id'");
$data = mysqli_fetch_array($sql);

if (!$data) {
    echo "<script>alert('Foto tidak ditemukan!');
     </script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Foto</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="index.php"><span class="las la-shipping-bag"></span><span>Album saya</span></a></li>
                <li><a href="home.php"><span class="las la-shipping-bag"></span><span>Home</span></a></li>
                <li><a href="foto.php"><span class="las la-shipping-bag"></span><span>Foto</span></a></li>
                <li><a href="album.php"><span class="las la-shipping-bag"></span><span>Album</span></a></li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <h1>Detail Foto</h1>
            </div>
            <div class="card">
                <div class="card-body">
                <h4><a href="index.php" class="btn btn-primary">Kembali</a></h4>
                    <div class="photo-container">
                        <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card img-top" title="<?php echo $data['judul_foto'] ?>">
                        <div class="photo-actions">
                            
                        </div>
                    </div>
                    <div class="photo-details">
                        <h4>Judul Foto :<?php echo $data['judul_foto'] ?></h4>
                        <h4>Nama Album :<?php echo $data['nama_album'] ?></h4>
                        <h4>Deskripsi :<?php echo $data['deskripsi_foto'] ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
