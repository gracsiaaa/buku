<?php
include 'config.php';

if(isset($_GET['hapus'])){
    $id_buku = $_GET['hapus'];

    $queryShow = "SELECT * FROM buku WHERE id = '$id_buku'";
    $sqlShow = mysqli_query($koneksi, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);
    unlink("img/".$result['gambar_cover']);

    $query = "DELETE FROM buku WHERE id = '$id_buku'";
    $sql = mysqli_query($koneksi, $query);

    if($sql){
        header("location: index.php");
    } else {
        echo $query;
    }
}
?> 