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
                <h2>Tambah Album</h2>
                <a href="../config/aksi_logout.php" class="logout"><h4>logout</h4></a>
            </div>
        <div class="card-body">
            <form action="../config/aksi_album.php" method="POST" enctype="multipart/form-data">
            <label class="form-label">Nama Album</label>
                <input type="text" class="form-control" name="nama_album" required>
                <label class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" name="deskripsi" required></textarea>          
                <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
            </form>
        </div> 
        </div>
        <div class="card">
        <div class="card-header">
            <h2>Data Album</h2>
        </div>
      
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Album</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $user_id = $_SESSION['id'];
                    $sql=mysqli_query($koneksi, "SELECT * FROM album WHERE user_id='$user_id'");
                    while ($data = mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama_album'] ?></td>
                        <td><?php echo $data['deskripsi'] ?></td>
                        <td><?php echo $data['tanggal_dibuat'] ?></td>
                        <td>
                            <?php echo"<a href='edit_album.php?id=". $data['id']."'>Edit</a>" ?>
                            <?php echo"<a href='hapus_album.php?id=". $data['id']."'>Hapus</a>" ?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</body>
</html>