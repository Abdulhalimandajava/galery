<?php
session_start();
include 'koneksi.php';
$username = $_POST['username']; 
$password = md5( $_POST['password']); 
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password' ");
$cek =mysqli_num_rows($sql);
if ($cek > 0) {
    $data = mysqli_fetch_array($sql);
    $_SESSION['username'] = $data['username'];
    $_SESSION['id'] = $data['id'];
    $_SESSION['status'] = 'login';
    echo "<Script>
    alert('login berhasil');
    location.href='../admin/home.php';
    </Script>";

}else {
    echo "<Script>
    alert('username atau password salah');
    location.href='../index.php';
    </Script>";
}
?>