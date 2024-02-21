<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$user_id = $_SESSION['id'];
if (!isset($user_id) || !isset($id)) {
    echo "<script>alert('Permintaan tidak valid!'); window.location.href='admin/home.php';</script>";
    exit;
}
$ceksuka = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE user_id='$user_id' AND foto_id='$id'");
if (mysqli_num_rows($ceksuka) == 1) {
    $row = mysqli_fetch_array($ceksuka);
    $like_id = $row['id'];
    $delete_query = mysqli_query($koneksi, "DELETE FROM like_foto WHERE id='$like_id'");
    if ($delete_query) {
        header('Location: ../admin/home.php');
        exit;
    } else {
        echo "<script>alert('Gagal menghapus suka!'); window.location.href='admin/home.php';</script>";
        exit;
    }
} else {
    $tanggal_like = date('Y-m-d');
    $insert_query = mysqli_query($koneksi, "INSERT INTO like_foto (foto_id, user_id, tanggal_like) VALUES ('$id', '$user_id', '$tanggal_like')");

    if ($insert_query) {
        header('Location: ../admin/home.php');
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan suka!'); window.location.href='admin/home.php';</script>";
        exit;
    }
}
?>
