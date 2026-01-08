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
            </div>

            <div class="detail-content">
                <h1 class="detail-title"><?php echo $data['judul']; ?></h1>

                <p style="color: var(--maroon); margin-bottom: 20px; font-style: italic; border-left: 3px solid var(--frame-light); padding-left: 15px;">
                    A masterpiece authored by <?php echo $data['penulis']; ?>, published in the year <?php echo $data['tahun']; ?>.
                </p>

                <div style="line-height: 1.8; text-align: justify; font-size: 1.1rem;">
                    <?php
                    $sinopsis = $data['sinopsis'];
                    $firstChar = substr($sinopsis, 0, 1);
                    $rest = substr($sinopsis, 1);
                    ?>
                    <span class="drop-cap"><?php echo $firstChar; ?></span>
                    <?php echo nl2br($rest); ?>
                </div>

                <a href="index.php" class="btn-return">&larr; Return to The Gallery</a>
            </div>
        </div>
    </div>
</body>

</html>