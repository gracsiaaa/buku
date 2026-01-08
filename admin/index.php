<?php
include '../koneksi.php';
$query = "SELECT * FROM buku ORDER BY id DESC";
$sql = mysqli_query($koneksi, $query);
$no = 1;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Crimson Archive</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="brand">Crimson Archive.</div>
            <a href="../index.php" target="_blank">View Gallery &rarr;</a>
        </header>
        <div class="card">
            <div style="display:flex; justify-content:space-between;">
                <h2>Manuscript Registry</h2>
                <a href="kelola.php" class="btn-primary">+ Inscribe New</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($res = mysqli_fetch_assoc($sql)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <?php $img = $res['gambar_cover'] ? "../img/" . $res['gambar_cover'] : "https://via.placeholder.com/60"; ?>
                                <img src="<?php echo $img; ?>" width="60" style="border:1px solid #333">
                            </td>
                            <td>
                                <strong style="font-size:1.1rem"><?php echo $res['judul']; ?></strong><br>
                                <small style="color:var(--crimson)">by <?php echo $res['penulis']; ?></small>
                            </td>
                            <td>
                                <a href="kelola.php?ubah=<?php echo $res['id']; ?>" style="color:var(--gold)">Edit</a> |
                                <a href="proses.php?hapus=<?php echo $res['id']; ?>" style="color:var(--crimson)" onclick="return confirm('Burn?')">Burn</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>