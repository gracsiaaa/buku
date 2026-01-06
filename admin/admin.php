<?php
include '../koneksi.php';

// Query untuk mengambil semua data buku
$query = "SELECT * FROM buku ORDER BY id DESC";
$sql = mysqli_query($koneksi, $query);
$no = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Kelola Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="admin.php">
                <i class="fas fa-user-shield me-2"></i>Admin Panel
            </a>
            <div class="d-flex">
                <a href="index.php" class="btn btn-outline-light btn-sm" target="_blank">
                    <i class="fas fa-external-link-alt me-1"></i> Lihat Website
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="card shadow border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Data Katalog Buku</h5>
                <a href="kelola.php" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <th width="10%">Cover</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($result = mysqli_fetch_assoc($sql)): ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?>.</td>
                                <td class="text-center">
                                    <?php 
                                        $gambar = $result['gambar_cover'];
                                        if ($gambar == null || $gambar == "") {
                                            $imgSrc = "https://via.placeholder.com/150x200?text=No+Cover";
                                        } else {
                                            $imgSrc = "../img/" . $gambar;
                                        }
                                    ?>
                                    <img src="<?php echo $imgSrc; ?>" style="width: 60px; height: auto;" class="rounded border">
                                </td>
                                <td class="fw-bold"><?php echo $result['judul']; ?></td>
                                <td><?php echo $result['penulis']; ?></td>
                                <td class="text-center"><?php echo $result['tahun']; ?></td>
                                <td class="text-center">
                                    <a href="kelola.php?ubah=<?php echo $result['id']; ?>" class="btn btn-warning btn-sm text-white me-1" title="Edit Data">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    <a href="proses.php?hapus=<?php echo $result['id']; ?>" class="btn btn-danger btn-sm" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>