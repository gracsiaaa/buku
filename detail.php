<?php
include 'koneksi.php';

// Ambil ID dari parameter URL
$id_buku = $_GET['id'];

// Query ambil data buku berdasarkan ID
$query = "SELECT * FROM buku WHERE id = '$id_buku'";
$sql = mysqli_query($koneksi, $query);
$result = mysqli_fetch_assoc($sql);

// Jika data tidak ditemukan (misal user iseng ganti ID di url)
if (!$result) {
    echo "<script>alert('Buku tidak ditemukan!');window.location='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - <?php echo $result['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-book-open me-2"></i>MyKatalog
            </a>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            
                            <div class="col-md-4 bg-light text-center p-4 d-flex align-items-center justify-content-center">
                                <?php 
                                    $gambar = $result['gambar_cover'];
                                    if ($gambar == null || $gambar == "") {
                                        $imgSrc = "https://via.placeholder.com/300x450?text=No+Cover";
                                    } else {
                                        $imgSrc = "img/" . $gambar;
                                    }
                                ?>
                                <img src="<?php echo $imgSrc; ?>" class="img-fluid rounded shadow" style="max-height: 450px;" alt="Cover Buku">
                            </div>

                            <div class="col-md-8 p-4 p-lg-5">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Buku</li>
                                    </ol>
                                </nav>

                                <h2 class="fw-bold mb-3"><?php echo $result['judul']; ?></h2>
                                
                                <div class="table-responsive mb-4">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th class="ps-0 w-25 text-secondary">Penulis</th>
                                            <td>: <strong><?php echo $result['penulis']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0 text-secondary">Tahun Terbit</th>
                                            <td>: <?php echo $result['tahun']; ?></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mb-4">
                                    <h5 class="fw-bold border-bottom pb-2">Sinopsis</h5>
                                    <p class="text-muted" style="text-align: justify; line-height: 1.8;">
                                        <?php echo nl2br($result['sinopsis']); ?>
                                        </p>
                                </div>

                                <div class="d-grid gap-2 d-md-block">
                                    <a href="index.php" class="btn btn-outline-primary px-4">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>