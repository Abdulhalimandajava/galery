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
                <h2>Edit Data</h2>
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
                 <label class="form-label">Judul Foto</label>
                <input type="text" class="form-control" name="judul_foto" value="<?php echo $data['judul_foto'] ?>" required>
                <label class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" name="deskripsi_foto"  required><?php echo $data['deskripsi_foto'] ?></textarea>  
                <label class="form-label">Album</label>
                <select name="album_id" class="form-control" required>
                <?php
                $id =$_SESSION['id'];
                $sql_album=mysqli_query($koneksi,"SELECT * FROM album WHERE user_id='$id'");
                while ($data_album = mysqli_fetch_array($sql_album)) {
                ?>
                <option value="<?php echo $data_album['id'] ?>"><?php echo $data_album['nama_album'] ?></option>
                <?php } ?>
                </select>
                <label class="form-label">Foto</label>
                <div class="row">
                <div class="col-md-4">
                <img src="../assets/img/<?php echo $data['lokasi_file'] ?>" width="100">
                </div>
                <div class="col-md-8">
                <label class="form-label">Ganti File</label>
                <input type="file" class="form-control" name="lokasi_file">
                </div>
                </div>
                <button type="submit" class="btn btn-primary" name="edit">Edit Data</button>
                <?php } ?>
            </form>
            </div>
            </div>
        </div>
       
    </div>
</body>
</html>