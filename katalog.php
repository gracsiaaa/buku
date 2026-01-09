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
  <title>The Gallery | Great Library</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="dust-container">
    <div class="dust d1"></div>
    <div class="dust d2"></div>
    <div class="dust d3"></div>
    <div class="dust d4"></div>
  </div>

  <header>
    <a href="index.php" class="admin-link">&larr; Back to Gate</a>

    <div class="header-ornament">⚜</div>
    <div class="brand">The Gallery</div>
    <br>
    <span class="subtitle">Silence is requested in the hall.</span>
  </header>

  <div class="container">

    <div class="gothic-divider">
      <span class="gothic-icon">❦</span>
    </div>

    <div class="grid-gallery">

      <?php while ($result = mysqli_fetch_assoc($sql)): ?>
        <a href="detail.php?id=<?php echo $result['id']; ?>">

          <div class="book-frame">
            <div class="img-container">
              <?php
              $img = $result['gambar_cover'] ? "img/" . $result['gambar_cover'] : "https://via.placeholder.com/300x450/111/333?text=Cover+Missing";
              ?>
              <img src="<?php echo $img; ?>" alt="Cover">

              <div class="view-overlay">
                <span class="view-text">INSPECT</span>
              </div>
            </div>

            <div class="plaque">
              <div class="book-title"><?php echo $result['judul']; ?></div>
              <div class="book-author">By <?php echo $result['penulis']; ?></div>
            </div>
          </div>

        </a>
      <?php endwhile; ?>

    </div>
  </div>

</body>

</html>