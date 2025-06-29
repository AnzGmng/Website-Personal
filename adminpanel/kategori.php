<?php
require "session.php";
require "../koneksi.php";

//Penghubung Mysqli ke Website
$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori"> Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori"
                        class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan_kategori'])) {
                $kategori = htmlspecialchars(trim($_POST['kategori']));

                if ($kategori == "") {
            ?>
                    <!--Alert jika input kosong-->
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama kategori tidak boleh kosong!
                    </div>
                    <meta http-equiv="refresh" content="1" url="kategori.php">

                    <?php
                } else {
                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if ($jumlahDataKategoriBaru > 0) {
                    ?>
                        <!--Alert jika kategori sudah ada-->
                        <div class="alert alert-danger mt-3" role="alert">
                            Kategori sudah ada!
                        </div>
                        <meta http-equiv="refresh" content="1" url="kategori.php">

                    <?php
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                    ?>
                        <!--Alert jika berhasil-->
                        <div class="alert alert-success mt-3" role="alert">
                            Kategori berhasil tersimpan!
                        </div>

                        <meta http-equiv="refresh" content="1" url="kategori.php">
            <?php
                    }
                }
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center"> Data Kategori Tidak Ada</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?p=<?php echo $data['id']; ?>"
                                            class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>

</body>

</html>