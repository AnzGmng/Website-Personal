    <?php
    require "session.php";
    require "../koneksi.php";

    //jangan ada space
    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id != '{$data['kategori_id']}'");

    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produk Detail</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    </head>

    <style>
        form div {
            margin-bottom: 10px;
        }
    </style>

    <body>
        <?php require "navbar.php"; ?>
        <div class="container mt-5">
            <h2> Detail Produk </h2>


            <div class="col-12 col-md-6 mb-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama"> Nama </label>
                        <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div>
                        <label for="kategori"> Produk </label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori'] ?></option>
                            <?php
                            while ($datakategori = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <option value="<?php echo $datakategori['id']; ?>"><?php echo $datakategori['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <div>
                            <label for="harga"> Harga </label>
                            <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']; ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="currentFoto" class="form-label">Foto Produk Saat Ini</label>
                        <div class="border rounded p-2 bg-light text-center">
                            <img src="../image/<?php echo $data['foto'] ?>" alt="Foto Produk" class="img-fluid rounded shadow-sm" style="max-width: 300px; height: auto;">
                        </div>
                    </div>
                    <div>
                        <label for="foto"> Foto </label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="detail"> Detail </label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                            <?php echo $data['detail']; ?>
                        </textarea>
                    </div>
                    <div>
                        <div>
                            <label for="ketersediaan_stok"> Ketersediaan Stok</label>
                            <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                                <option value="<?php echo $data['ketersediaan_stok'] ?>"><?php echo $data['ketersediaan_stok'] ?></option>
                                <?php
                                if ($data['ketersediaan_stok'] == 'tersedia') {
                                ?>
                                    <option value="habis"> Habis </option>
                                <?php
                                } else {
                                ?>
                                    <option value="tersedia"> Tersedia </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" name="simpan"> Simpan </button>
                            <button type="submit" class="btn btn-danger" name="hapus"> Delete </button>
                        </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES['foto']['name']);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES['foto']['size'];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, Kategori dan Harga Wajib diisi !
                        </div>
                        <?php
                    } else {
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', 
                            nama='$nama', harga='$harga', detail='$detail', 
                            ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");

                        if ($nama_file != '') {
                            // Maksimal 2MB (2 * 1024 * 1024 bytes)
                            if ($image_size > 2 * 1024 * 1024) {
                        ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Foto tidak boleh lebih dari 2MB!
                                </div>
                                <?php
                            } else {
                                if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') {
                                ?>
                                    <div class="alert alert-danger mt-3" role="alert">
                                        Foto harus berformat jpg, jpeg, atau png!
                                    </div>
                                    <?php
                                } else {
                                    // Proses upload file
                                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name)) {
                                        // Hapus foto lama jika ada
                                        if (file_exists($target_dir . $data['foto']) && $data['foto'] != '') {
                                            unlink($target_dir . $data['foto']);
                                        }
                                        // Update nama file foto di database
                                        $querysSimpan = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                                        if ($querysSimpan) {
                                    ?>
                                            <div class="alert alert-success mt-3" role="alert">
                                                Produk berhasil diupdate!
                                            </div>
                                            <script>
                                                alert('Foto produk berhasil diupdate!');
                                                window.location.href = 'produk.php';
                                            </script>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="alert alert-danger mt-3" role="alert">
                                                Gagal mengupdate foto produk!
                                            </div>
                        <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['hapus'])) {
                    // Hapus foto lama jika ada
                    $target_dir = "../image/";
                    if (!empty($data['foto']) && file_exists($target_dir . $data['foto'])) {
                        unlink($target_dir . $data['foto']);
                    }

                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

                    if ($queryHapus) {
                        ?>
                        <div class="alert alert-success mt-3" role="alert">
                            Produk berhasil dihapus!
                        </div>
                        <script>
                            alert('Produk berhasil dihapus!');
                            window.location.href = 'produk.php';
                        </script>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Gagal menghapus produk!
                        </div>
                <?php
                    }
                    // Close the if (isset($_POST['hapus'])) block
                }
                ?> </form>
            </div>
        </div>
        </div>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>