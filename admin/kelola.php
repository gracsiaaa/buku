<?php
include '../koneksi.php';
$judul = '';
$penulis = '';
$tahun = '';
$sinopsis = '';
$gambar = '';
$id_buku = '';
if (isset($_GET['ubah'])) {
    $id_buku = $_GET['ubah'];
    $res = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id_buku'"));
    $judul = $res['judul'];
    $penulis = $res['penulis'];
    $tahun = $res['tahun'];
    $sinopsis = $res['sinopsis'];
    $gambar = $res['gambar_cover'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Editor</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container" style="max-width:700px;">
        <header>
            <div class="brand">Inscribe.</div><a href="index.php">&larr; Back</a>
        </header>
        <div class="card">
            <h2><?php echo $id_buku ? "Edit Manuscript" : "New Entry"; ?></h2>
            <form action="proses.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id_buku; ?>">
                <input type="hidden" name="aksi" value="<?php echo $id_buku ? 'edit' : 'tambah'; ?>">
                <label>Title</label><input type="text" name="judul" value="<?php echo $judul; ?>" required>
                <label>Author</label><input type="text" name="penulis" value="<?php echo $penulis; ?>" required>
                <label>Year</label><input type="number" name="tahun" value="<?php echo $tahun; ?>" required>
                <label>Synopsis</label><textarea name="sinopsis" rows="6" required><?php echo $sinopsis; ?></textarea>
                <label>Cover</label>
                <?php if ($gambar) echo "<br><img src='../img/$gambar' width='80'><br>"; ?>
                <input type="file" name="foto">
                <br><br><button class="btn-primary">Save to Archive</button>
            </form>
        </div>
    </div>
</body>

</html>