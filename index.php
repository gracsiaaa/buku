<?php
include 'koneksi.php';
$query = "SELECT * FROM buku ORDER BY id DESC";
$sql = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK CATALOG</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>

    <header>
        <div class="brand">ARRUDYA</div>
        <a href="#" class="nav-btn">CATALOG 2026</a>
    </header>

    <div class="container">
        <h1 class="hero-text">
            BOOK<br><span>CATALOG</span><br>/// 2026
        </h1>

        <div class="grid-catalog">
            <?php while ($result = mysqli_fetch_assoc($sql)): ?>
                <a href="detail.php?id=<?php echo $result['id']; ?>" class="card-brutal">
                    <div class="tape-label">ID_<?php echo $result['id']; ?></div>
                    <div class="card-img-box">
                        <?php
                        $img = $result['gambar_cover'] ? "img/" . $result['gambar_cover'] : "https://via.placeholder.com/300x450?text=NO+IMAGE";
                        ?>
                        <img src="<?php echo $img; ?>" alt="Cover">
                    </div>
                    <div class="card-info">
                        <div class="card-title"><?php echo $result['judul']; ?></div>
                        <div class="meta">
                            > AUT: <?php echo $result['penulis']; ?><br>
                            > YR : <?php echo $result['tahun']; ?>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>