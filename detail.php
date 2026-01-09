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
    <title><?php echo $data['judul']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="dust-container">
        <div class="dust d1"></div>
        <div class="dust d2"></div>
    </div>

    <header>
        <div class="brand" style="font-size: 2rem;">Item No. <?php echo $data['id']; ?></div>
    </header>

    <div class="container">
        <div class="detail-paper">

            <div class="book-frame" style="height: fit-content; border-image: none;">
                <div class="img-container" style="height: auto; filter: none;">
                    <?php
                    $img = $data['gambar_cover'] ? "img/" . $data['gambar_cover'] : "https://via.placeholder.com/500x700/111/333?text=No+Cover";
                    ?>
                    <img src="<?php echo $img; ?>" style="display: block;">
                </div>
                <div class="plaque">
                    <div class="book-author" style="color:white; letter-spacing:2px;">EVIDENCE #<?php echo $data['id']; ?></div>
                </div>
            </div>

            <div class="detail-content">
                <h1 class="detail-title"><?php echo $data['judul']; ?></h1>

                <div class="detail-meta">
                    Authored by <strong style="color: white;"><?php echo $data['penulis']; ?></strong> <br>
                    Published in the Year <?php echo $data['tahun']; ?>
                </div>

                <div class="synopsis-container">
                    <div class="synopsis-text">
                        <?php
                        $sinopsis = $data['sinopsis'];
                        $firstChar = substr($sinopsis, 0, 1);
                        $rest = substr($sinopsis, 1);
                        ?>
                        <span class="drop-cap"><?php echo $firstChar; ?></span>
                        <?php echo nl2br($rest); ?>
                    </div>
                </div>

                <a href="katalog.php" class="btn-return">
                    &larr; Return to The Gallery
                </a>
            </div>

        </div>
    </div>

</body>

</html>