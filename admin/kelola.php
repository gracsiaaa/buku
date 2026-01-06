<?php
include '../koneksi.php';

// Inisialisasi variabel kosong agar tidak error saat mode Tambah
$id_buku = '';
$judul = '';
$penulis = '';
$tahun = '';
$sinopsis = '';
$gambar = '';

// LOGIKA: Cek apakah ini Mode Edit? (Ada parameter 'ubah' di URL)
if(isset($_GET['ubah'])){
    $id_buku = $_GET['ubah'];
    
    // Ambil data lama dari database
    $query = "SELECT * FROM buku WHERE id = '$id_buku'";
    $sql = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($sql);

    // Masukkan data lama ke variabel
    $judul = $result['judul'];
    $penulis = $result['penulis'];
    $tahun = $result['tahun'];
    $sinopsis = $result['sinopsis'];
    $gambar = $result['gambar_cover'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kelola Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="admin.php">Admin Panel</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-edit me-2"></i>
                            <?php 
                                // Ubah judul form dinamis
                                if(isset($_GET['ubah'])){ echo "Edit Data Buku"; } 
                                else { echo "Tambah Data Buku"; } 
                            ?>
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <form action="proses.php" method="POST" enctype="multipart/form-data">
                            
                            <input type="hidden" name="id" value="<?php echo $id_buku; ?>">
                            
                            <?php if(isset($_GET['ubah'])): ?>
                                <input type="hidden" name="aksi" value="edit">
                            <?php else: ?>
                                <input type="hidden" name="aksi" value="tambah">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>" placeholder="Masukkan judul buku..." required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Penulis</label>
                                    <input type="text" name="penulis" class="form-control" value="<?php echo $penulis; ?>" placeholder="Nama penulis..." required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tahun Terbit</label>
                                    <input type="number" name="tahun" class="form-control" value="<?php echo $tahun; ?>" placeholder="Contoh: 2024" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Sinopsis</label>
                                <textarea name="sinopsis" class="form-control" rows="5" placeholder="Tulis sinopsis singkat..." required><?php echo $sinopsis; ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Upload Cover</label>
                                
                                <?php if($gambar != ""): ?>
                                    <div class="mb-2">
                                        <img src="../img/<?php echo $gambar; ?>" width="100" class="img-thumbnail">
                                        <small class="text-muted d-block">Gambar saat ini</small>
                                    </div>
                                <?php endif; ?>

                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <small class="text-secondary">*Biarkan kosong jika tidak ingin mengganti gambar (saat edit).</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="admin.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i class="fas fa-save me-1"></i> Simpan Data
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>