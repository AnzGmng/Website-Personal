    <?php
    require "session.php";
    require "../koneksi.php";

    //jangan ada space
    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Kategori</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    </head>

    <body>
        <?php require "navbar.php"; ?>
        <div class="container mt-5">

            <h2>Detail Kategori</h2>

            <div class="col-12 col-md-6">
                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama']; ?>">

                        <div class="mt-5 d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                            <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['editBtn'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if ($data['nama'] == $kategori) {
                        // Jika nama tidak diubah, redirect ke kategori.php
                        echo '<script>window.location.href="kategori.php";</script>';
                        exit;
                    } else {
                        $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);

                        if ($jumlahData > 0) {
                ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori Sudah Ada
                            </div>
                            <?php
                        } else {
                            $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                            if ($querySimpan) {
                            ?>
                                <!--Alert jika berhasil-->
                                <div class="alert alert-success mt-3" role="alert">
                                    Kategori berhasil diupdate!
                                </div>
                                <meta http-equiv="refresh" content="1;url=kategori.php">
                        <?php
                            } else {
                                echo mysqli_error($con);
                            }
                        }
                    }
                }

                if (isset($_POST['deleteBtn'])) {
                    $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);

                    if ($dataCount > 0) {
                        ?>
                        <script>
                            alert('Kategori tidak bisa dihapus karena sudah digunakan di produk!');
                        </script>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori tidak bisa dihapus karena sudah digunakan di produk!
                        </div>
                    <?php
                        die();
                    }

                    $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

                    if ($queryDelete) {
                    ?>
                        <!--Alert jika berhasil di hapus / delete-->
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori tidak bisa dihapus karena sudah digunakan di produk!
                        </div>
                        <meta http-equiv="refresh" content="1;url=kategori.php">

                <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
                ?>
            </div>
        </div>

        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>


    </html>