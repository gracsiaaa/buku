<?php
include '../koneksi.php'; // Path naik satu level

$judul = '';
$penulis = '';
$tahun = '';
$sinopsis = '';
$gambar = '';
$id_buku = '';

if (isset($_GET['ubah'])) {
    $id_buku = $_GET['ubah'];
    $sql = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id_buku'");
    $res = mysqli_fetch_assoc($sql);
    $judul = $res['judul'];
    $penulis = $res['penulis'];
    $tahun = $res['tahun'];
    $sinopsis = $res['sinopsis'];
    $gambar = $res['gambar_cover'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITOR // RENDY.PUB</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: var(--green);
            border: 3px solid black;
            box-shadow: 15px 15px 0 var(--blue);
            padding: 30px;
        }

        .form-title {
            font-family: 'Archivo Black';
            font-size: 2rem;
            margin-bottom: 20px;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            background: black;
            color: white;
            width: fit-content;
            padding: 2px 10px;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            border: 3px solid black;
            font-family: 'Space Mono';
            background: white;
            font-size: 1rem;
        }

        .input-field:focus {
            outline: none;
            background: #fff0f5;
            box-shadow: 5px 5px 0 var(--pink);
        }

        .btn-save {
            width: 100%;
            background: var(--black);
            color: white;
            padding: 15px;
            font-weight: bold;
            font-size: 1.2rem;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Archivo Black';
            margin-top: 10px;
        }

        .btn-save:hover {
            background: var(--pink);
            color: black;
            box-shadow: 8px 8px 0 black;
            transform: translate(-3px, -3px);
        }

        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }

        .btn-cancel:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <div class="form-title">
            <?php echo isset($_GET['ubah']) ? "EDIT_DATA_MODE" : "NEW_ENTRY_MODE"; ?>
        </div>

        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id_buku; ?>">
            <input type="hidden" name="aksi" value="<?php echo isset($_GET['ubah']) ? 'edit' : 'tambah'; ?>">

            <div class="input-group">
                <label class="input-label">BOOK TITLE</label>
                <input type="text" name="judul" class="input-field" value="<?php echo $judul; ?>" required placeholder="Enter title...">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="input-group">
                    <label class="input-label">AUTHOR</label>
                    <input type="text" name="penulis" class="input-field" value="<?php echo $penulis; ?>" required placeholder="Author name...">
                </div>
                <div class="input-group">
                    <label class="input-label">YEAR</label>
                    <input type="number" name="tahun" class="input-field" value="<?php echo $tahun; ?>" required placeholder="2024">
                </div>
            </div>

            <div class="input-group">
                <label class="input-label">SYNOPSIS</label>
                <textarea name="sinopsis" class="input-field" rows="6" required placeholder="Type synopsis here..."><?php echo $sinopsis; ?></textarea>
            </div>

            <div class="input-group">
                <label class="input-label">COVER IMAGE</label>
                <?php if ($gambar) echo "<div style='margin:10px 0; border:2px solid black; display:inline-block;'><img src='../img/$gambar' width='80'></div>"; ?>
                <input type="file" name="foto" class="input-field">
            </div>

            <button type="submit" class="btn-save">
                <?php echo isset($_GET['ubah']) ? "UPDATE DATABASE >>" : "SAVE TO DATABASE >>"; ?>
            </button>
            <a href="index.php" class="btn-cancel">CANCEL / BACK</a>
        </form>
    </div>

</body>

</html>