<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM buku WHERE id = '$id'";
$sql = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($sql);
if (!$data) {
    echo "<script>window.location='index.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA: <?php echo $data['judul']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="floating-shape shape-1"></div>
    <header>
        <div class="brand">RENDY.PUB</div>
        <a href="index.php" class="nav-btn">
            < BACK</a>
    </header>

    <div class="container">
        <div class="detail-box">
            <?php
            $img = $data['gambar_cover'] ? "img/" . $data['gambar_cover'] : "https://via.placeholder.com/500x700?text=NO+IMAGE";
            ?>
            <img src="<?php echo $img; ?>" class="detail-img">

            <div class="detail-content">
                <div style="background:var(--blue); color:white; display:inline-block; padding:5px 10px; font-weight:bold; margin-bottom:20px;">
                    // SYSTEM_ID: <?php echo $data['id']; ?>
                </div>
                <h1 style="font-family:'Archivo Black'; font-size:3rem; line-height:1; margin-bottom:20px; text-transform:uppercase;">
                    <?php echo $data['judul']; ?>
                </h1>
                <p style="border-bottom:2px solid black; padding-bottom:10px; font-weight:bold;">
                    AUTHOR: <span style="color:var(--blue)"><?php echo $data['penulis']; ?></span>
                </p>
                <p style="border-bottom:2px solid black; padding-bottom:10px; font-weight:bold;">
                    YEAR: <span style="color:var(--pink)"><?php echo $data['tahun']; ?></span>
                </p>
                <br>
                <h3>SYNOPSIS_DATA:</h3>
                <p style="line-height:1.6; text-align:justify;"><?php echo nl2br($data['sinopsis']); ?></p>

                <a href="index.php" class="btn-back">
                    << CLOSE FILE</a>
            </div>
        </div>
    </div>
</body>

</html>