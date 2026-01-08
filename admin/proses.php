<?php
include '../koneksi.php';
if (isset($_POST['aksi'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $sinopsis = $_POST['sinopsis'];
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $fotobaru = date('dmYHis') . $foto;
    $path = "../img/" . $fotobaru;

    if ($_POST['aksi'] == "tambah") {
        if (move_uploaded_file($tmp, $path)) $q = "INSERT INTO buku VALUES(null, '$judul', '$penulis', '$tahun', '$sinopsis', '$fotobaru')";
        else $q = "INSERT INTO buku VALUES(null, '$judul', '$penulis', '$tahun', '$sinopsis', null)";
        mysqli_query($koneksi, $q);
        header("location: index.php");
    } else if ($_POST['aksi'] == "edit") {
        $id = $_POST['id'];
        if ($foto != "") {
            $r = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'"));
            unlink("../img/" . $r['gambar_cover']);
            move_uploaded_file($tmp, $path);
            $q = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun', sinopsis='$sinopsis', gambar_cover='$fotobaru' WHERE id='$id'";
        } else {
            $q = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun', sinopsis='$sinopsis' WHERE id='$id'";
        }
        mysqli_query($koneksi, $q);
        header("location: index.php");
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $r = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'"));
    unlink("../img/" . $r['gambar_cover']);
    mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header("location: index.php");
}
