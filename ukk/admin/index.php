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
 .photo-container{
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .photo-container img {
            width: 100;
            height: auto;
            display: block;
            border-radius: 5px;
        }
        .photo-actions {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
        .like-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10 px;
        }
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
                <h2>Album Saya</h2>
                <a href="../config/aksi_logout.php" class="logout"><h4>logout</h4></a>
            </div>
        <div class="card-body">
            <?php
            $no = 1;
            $id =$_SESSION['id'];
            $sql=mysqli_query($koneksi,"SELECT * FROM foto WHERE user_id='$id'");
            while ($data = mysqli_fetch_array($sql)){
            ?>
            <div class="photo-container">
               <img style="height: 12rem;"  title="<?php echo $data['judul_foto'] ?>" src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card img-top">
            <div class="photo-actions">
                <a href="detail.php" class="btn btn-primary">detail</a>
            </div>
            </div>
            <?php } ?>
        </div> 
        </div>
        
    </div>
    </div>
</body>
</html>