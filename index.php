<?php
include 'koneksi.php';

// Query data terbaru
$query = "SELECT * FROM buku ORDER BY id DESC";
$sql = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card-book {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            border: none;
        }
        .card-book:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .cover-img {
            height: 380px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        /* Style untuk judul agar maksimal 2 baris */
        .judul-buku {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 3em; 
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-book-open me-2"></i>MyKatalog
            </a>
            </div>
    </nav>

    <div class="container mt-4">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark" style="background: linear-gradient(45deg, #0d6efd, #0dcaf0);">
            <div class="col-md-6 px-0">
                <h1 class="display-5 fst-italic fw-bold">Selamat Datang di Dunia Buku</h1>
                <p class="lead my-3">Temukan koleksi buku terbaik untuk menemani hari-harimu. Baca sinopsis lengkap sebelum memutuskan untuk meminjam atau membeli.</p>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <h3 class="mb-4 fw-bold border-bottom pb-2"><i class="fas fa-fire text-danger"></i> Koleksi Terbaru</h3>
        
        <div class="row">
            <?php while($result = mysqli_fetch_assoc($sql)): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="detail.php?id=<?php echo $result['id']; ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm card-book">
                            <?php 
                                $gambar = $result['gambar_cover'];
                                if ($gambar == null || $gambar == "") {
                                    $imgSrc = "https://via.placeholder.com/300x450?text=No+Cover";
                                } else {
                                    $imgSrc = "img/" . $gambar;
                                }
                            ?>
                            <img src="<?php echo $imgSrc; ?>" class="card-img-top cover-img" alt="<?php echo $result['judul']; ?>">
                            
                            <div class="card-body">
                                <h5 class="card-title fw-bold judul-buku"><?php echo $result['judul']; ?></h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted"><i class="fas fa-user"></i> <?php echo $result['penulis']; ?></small>
                                    <span class="badge bg-light text-dark border"><?php echo $result['tahun']; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>