<?php
// Koneksi naik satu folder ke atas (../)
include '../koneksi.php';

$query = "SELECT * FROM buku ORDER BY id DESC";
$sql = mysqli_query($koneksi, $query);
$no = 1;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD // RENDY.PUB</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* CSS KHUSUS ADMIN */
        .admin-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border: var(--border);
            box-shadow: 15px 15px 0 var(--black);
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 3px solid black;
            padding-bottom: 20px;
        }

        .admin-title {
            font-family: 'Archivo Black';
            font-size: 2.5rem;
            text-transform: uppercase;
            line-height: 1;
        }

        .admin-subtitle {
            font-family: 'Space Mono';
            color: var(--blue);
            font-weight: bold;
        }

        /* TABEL BRUTALIST */
        .brutal-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Space Mono';
            margin-top: 20px;
        }

        .brutal-table th {
            background: var(--black);
            color: var(--green);
            padding: 15px;
            text-align: left;
            text-transform: uppercase;
            border: 3px solid black;
        }

        .brutal-table td {
            border: 3px solid black;
            padding: 15px;
            background: white;
            transition: 0.2s;
        }

        .brutal-table tr:hover td {
            background: #fff0f5;
        }

        /* Efek hover tipis */

        /* TOMBOL AKSI */
        .btn-action {
            display: inline-block;
            padding: 5px 10px;
            font-weight: bold;
            text-decoration: none;
            border: 2px solid black;
            text-transform: uppercase;
            font-size: 0.8rem;
            margin-right: 5px;
        }

        .btn-edit {
            background: var(--green);
            color: black;
            box-shadow: 3px 3px 0 black;
        }

        .btn-hapus {
            background: var(--pink);
            color: white;
            box-shadow: 3px 3px 0 black;
        }

        .btn-action:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 black;
        }

        .btn-add {
            background: var(--blue);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border: 3px solid black;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 5px 5px 0 black;
            transition: 0.2s;
        }

        .btn-add:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0 black;
            background: white;
            color: var(--blue);
        }

        .btn-view-site {
            background: black;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid white;
        }
    </style>
</head>

<body>

    <div style="position:fixed; top:0; left:0; width:100%; height:100%; z-index:-1; background-image: linear-gradient(rgba(0,0,0,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.1) 1px, transparent 1px); background-size: 20px 20px;"></div>

    <header style="background: var(--black);">
        <div class="brand" style="color: white; background: transparent;">ADMIN_PANEL</div>
        <a href="../index.php" target="_blank" class="btn-view-site">VIEW_WEBSITE >></a>
    </header>

    <div class="admin-container">
        <div class="admin-header">
            <div>
                <div class="admin-title">Database<br>Manager</div>
            </div>
            <a href="kelola.php" class="btn-add">
                <span>[+]</span> ADD NEW DATA
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table class="brutal-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Cover_Img</th>
                        <th>Book_Info</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($res = mysqli_fetch_assoc($sql)): ?>
                        <tr>
                            <td style="font-weight: bold; text-align: center;"><?php echo $no++; ?></td>
                            <td style="text-align: center;">
                                <?php
                                $img = $res['gambar_cover'];
                                if ($img == "") $img = "https://via.placeholder.com/100";
                                else $img = "../img/" . $img; // Path mundur satu folder
                                ?>
                                <img src="<?php echo $img; ?>" style="width: 60px; border: 2px solid black;">
                            </td>
                            <td>
                                <strong style="font-size: 1.1rem; text-transform: uppercase;"><?php echo $res['judul']; ?></strong><br>
                                <span style="color: var(--blue); font-size: 0.9rem;">> <?php echo $res['penulis']; ?></span><br>
                                <span style="background: var(--black); color: white; font-size: 0.8rem; padding: 2px 5px;"><?php echo $res['tahun']; ?></span>
                            </td>
                            <td>
                                <a href="kelola.php?ubah=<?php echo $res['id']; ?>" class="btn-action btn-edit">EDIT</a>
                                <a href="proses.php?hapus=<?php echo $res['id']; ?>" class="btn-action btn-hapus" onclick="return confirm('DELETE DATA PERMANENTLY?')">DEL</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>