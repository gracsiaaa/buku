<?php
include '../koneksi.php';

// Fungsi logic Tambah Data
if(isset($_POST['aksi'])){
    
    // Ambil data dari form
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $sinopsis = $_POST['sinopsis'];
    
    // Logic Upload Gambar
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $fotobaru = date('dmYHis').$foto; // Rename file jadi unik (pake tanggal jam)
    $path = "../img/".$fotobaru;

    // --- KONDISI 1: TAMBAH DATA ---
    if($_POST['aksi'] == "tambah"){

        // Jika user upload foto
        if(move_uploaded_file($tmp, $path)){
            $query = "INSERT INTO buku VALUES(null, '$judul', '$penulis', '$tahun', '$sinopsis', '$fotobaru')";
        } else {
            // Jika gagal upload/tidak ada foto, insert data tanpa kolom gambar (atau gambar kosong)
            $query = "INSERT INTO buku VALUES(null, '$judul', '$penulis', '$tahun', '$sinopsis', null)";
        }

        $sql = mysqli_query($koneksi, $query);

        if($sql){
            header("location: admin.php"); // Balik ke halaman admin
        } else {
            echo "Gagal Menambah Data: " . mysqli_error($koneksi);
        }

    // --- KONDISI 2: EDIT DATA ---
    } else if($_POST['aksi'] == "edit"){
        $id = $_POST['id'];

        // Cek apakah user upload foto baru?
        if($_FILES['foto']['name'] != ""){
            // 1. Hapus foto lama dulu biar server gak penuh
            $queryShow = "SELECT * FROM buku WHERE id = '$id'";
            $sqlShow = mysqli_query($koneksi, $queryShow);
            $result = mysqli_fetch_assoc($sqlShow);
            unlink("../img/".$result['gambar_cover']);

            // 2. Upload foto baru
            move_uploaded_file($tmp, $path);

            // 3. Update query dengan foto baru
            $query = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun', sinopsis='$sinopsis', gambar_cover='$fotobaru' WHERE id='$id'";
        } else {
            // Jika tidak upload foto baru, update data tulisan saja
            $query = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun', sinopsis='$sinopsis' WHERE id='$id'";
        }

        $sql = mysqli_query($koneksi, $query);
        
        if($sql){
            header("location: admin.php");
        } else {
            echo "Gagal Edit Data: " . mysqli_error($koneksi);
        }
    }
}

// --- KONDISI 3: HAPUS DATA (Tetap dipertahankan) ---
if(isset($_GET['hapus'])){
    $id_buku = $_GET['hapus'];

    // Hapus gambar fisik
    $queryShow = "SELECT * FROM buku WHERE id = '$id_buku'";
    $sqlShow = mysqli_query($koneksi, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);
    unlink("../img/".$result['gambar_cover']);

    $query = "DELETE FROM buku WHERE id = '$id_buku'";
    $sql = mysqli_query($koneksi, $query);

    if($sql){
        header("location: ../admin.php");
    }
}
?>