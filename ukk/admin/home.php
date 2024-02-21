<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
  echo "<script>
    alert('Anda belum Login!');
    location.href='../index.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

 <style>
  .photo-container {
  position: relative;
  display: inline-block;
  margin: 10px;
}

/* Photo image */
.photo-container img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 5px;
}
/* Photo actions container */
.photo-actions {
  position: absolute;
  bottom: 10px;
  right: 10px;
}

/* Like button */
.like-btn,
.comment-btn {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  margin-right: 5px;
  font-size: 14px;
  transition: background-color 0.3s;
}

.like-btn:hover,
.comment-btn:hover {
  background-color: #0056b3;
}

 </style>
</head>
<body>
  <div class="dashboard">
    <div class="sidebar">
      <h2>Menu</h2>
      <ul>
        <li> <a href ="index.php" class=""><span class="las la-shipping-bag"></span>
                    <span>Album saya</span></a></li>
        <li><a href ="home.php" class=""><span class="las la-shipping-bag"></span>
                    <span>Home</span></a></li>
        <li><a href ="foto.php" class=""><span class="las la-shipping-bag"></span>
                    <span>Foto</span></a></li>
        <li><a href ="album.php"><span class="las la-shipping-bag"></span>
                    <span>Album</span></a>
        </li>
      </ul>
    </div>
    <div class="content">
      <div class="header">
        <h1>Home</h1>
        
         <a href ="../config/aksi_logout.php" class="logout"><h3>logout</h3></a>
      </div>

      <div class="card">
        <div class="card-body">
        <div class="search">
        <div class="container">
            <form action="">
                <input type="text" name="search" placeholder="Cari Username"/>
                <input type="submit" name="cari" value="Cari Username"/>
            </form>
        </div>
    </div>
   
         
      <?php  
  $query = mysqli_query($koneksi, "SELECT foto.id AS foto_id ,foto.*, album.*,user.* FROM foto JOIN user ON foto.user_id=user.id JOIN album ON foto.album_id=album.id");
  while($data = mysqli_fetch_array($query)){
 ?>
   <div class="photo-container">
            <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasi_file']?>" class="card img-top" title="<?php echo $data['judul_foto']?>">
            <div class="photo-actions">
            <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['foto_id'] ?>">
              <?php
          $id = $data['foto_id'];
          $ceksuka = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$id' ");
          if (mysqli_num_rows($ceksuka) == 1) { ?>
            <a href="../config/proses_like.php?id=<?php echo $data['foto_id'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart m-1"></i></a>

          <?php }else{ ?>
            <a href="../config/proses_like.php?id=<?php echo $data['foto_id'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart m-1"></i></a>

          <?php }
          $like =mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$id'");
          echo mysqli_num_rows($like). ' Suka';
          ?>
          <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['foto_id'] ?>"><i class="fa-regular fa-comment"></i></a>
          <?php
          $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentar_foto WHERE foto_id='$id'");
          echo mysqli_num_rows($jmlkomen).'Komentar';
           ?>
           
            </div>
            <div class="modal fade" id="komentar<?php echo $data['foto_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <img src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
          </div>
          <div class="col-md-4">
            <div class="m-2">
              <div class="overflow-auto">
                <div class="sticky-top">
                  <strong><?php echo $data['judul_foto'] ?></strong><br>
                  <span class="badge bg-secondary"><?php echo $data['nama_album'] ?></span>
                  <span class="badge bg-secondary"><?php echo $data['tanggal_unggah'] ?></span>
                  <span class="badge bg-primary"><?php echo $data['nama_album'] ?></span>
                </div>
                <hr>
                <p align="left">
                  <?php echo $data['deskripsi_foto'] ?>
                </p>
                <hr>
                <?php
                $foto_id = $data['foto_id'];
                $komentar   = mysqli_query($koneksi,"SELECT * FROM komentar_foto JOIN user ON komentar_foto.user_id=user.id WHERE komentar_foto.foto_id='$foto_id'");
                while($row = mysqli_fetch_array($komentar)) {
                 ?>
                 <p align="left">
                  <strong><?php echo $row['nama_lengkap'] ?></strong>
                  <?php echo $row['isi_komentar'] ?>
                 </p>
                 <?php } ?>
                <hr> 
                <div class="sticky-bottom">
                  <form action="../config/proses_komentar.php" method="POST">
                    <div class="input-group">
                      <input type="hidden" name="foto_id" value="<?php echo $data['foto_id'] ?>">
                      <input type="text" name="isi_komentar" class="form-control" placeholder="Tambah Komentar">
                      <div class="input-group-prepend">
                        <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
        </div>

  
    <?php } ?>
  
      </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>