<?php
include '../koneksi.php'; // Koneksi naik satu level

if (isset($_POST['aksi'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $sinopsis = $_POST['sinopsis'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $fotobaru = date('dmYHis') . $foto;

    // Perubahan PENTING: Path simpan gambar mundur satu folder (../img/)
    $path = "../img/" . $fotobaru;

    if ($_POST['aksi'] == "tambah") {
        if (move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO buku VALUES(null, '$judul', '$penulis', '$tahun', '$sinopsis', '$fotobaru')";
        } else {
            $query = "INSERT INTO buku VALUES(null, '$judul', '$penulis', '$tahun', '$sinopsis', null)";
        }
        mysqli_query($koneksi, $query);
        header("location: index.php"); // Tetap di folder admin

    } else if ($_POST['aksi'] == "edit") {
        $id = $_POST['id'];
        if ($_FILES['foto']['name'] != "") {
            $queryShow = "SELECT * FROM buku WHERE id='$id'";
            $sqlShow = mysqli_query($koneksi, $queryShow);
            $result = mysqli_fetch_assoc($sqlShow);

            // Hapus gambar lama (Path juga mundur ../img/)
            if ($result['gambar_cover']) {
                unlink("../img/" . $result['gambar_cover']);
            }

            move_uploaded_file($tmp, $path);
            $query = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun', sinopsis='$sinopsis', gambar_cover='$fotobaru' WHERE id='$id'";
        } else {
            $query = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun', sinopsis='$sinopsis' WHERE id='$id'";
        }
        mysqli_query($koneksi, $query);
        header("location: index.php");
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sqlShow = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
    $result = mysqli_fetch_assoc($sqlShow);

    if ($result['gambar_cover']) {
        unlink("../img/" . $result['gambar_cover']);
    }

    mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header("location: index.php");
}
