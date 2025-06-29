<?php
require "koneksi.php";
$queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Makan Dimsum</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require "navbaryo.php" ?>
    <!-- BANNER -->
    <div class="container-fluid banner d-flex align-items-center justify-content-center" style="min-height: 60vh; background: linear-gradient(rgba(132, 131, 57, 0.45), rgba(112, 112, 86, 0.49)), url('image/Dimsum.jpeg') center center/cover no-repeat;">
        <div class="container text-center text-white py-5">
            <h1 class="display-4 fw-bold mb-3" style="text-shadow: 0 4px 16px rgba(0,0,0,0.25); letter-spacing:2px;">Kedai Makan Dimsum</h1>
            <h3 class="mb-4" style="text-shadow: 0 2px 8px rgba(0,0,0,0.18);">Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group justify-content-center my-3" style="max-width:400px; margin:auto;">
                        <input type="text" class="form-control border-0 rounded-start-pill px-3 py-2" placeholder="Cari makanan Dimsum..." aria-label="Nama Produk" aria-describedby="basic-addon2" name="keyword" style="font-size:1rem; background:rgba(255,255,255,0.92); min-width:0;">
                        <button type="submit" class="btn warna2 text-white fw-bold rounded-end-pill px-3 py-2" style="font-size:1rem;">Telusuri</button>
                    </div>
                </form>
            </div>
            <!-- End Banner -->
            <!-- gk terlalu penting -->
            <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-warning text-dark fs-6 px-3 py-2 shadow-sm"><i class="fas fa-star me-1"></i> Premium</span>
                <span class="badge bg-info text-white fs-6 px-3 py-2 shadow-sm"><i class="fas fa-leaf me-1"></i> Fresh</span>
                <span class="badge bg-success text-white fs-6 px-3 py-2 shadow-sm"><i class="fas fa-heart me-1"></i> Halal</span>
            </div>
            <!-- sampai sini -->
        </div>
    </div>

    <!-- HIGHLIGHTED KATEGORI-->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3 class="text-center">Kategori Terlaris</h3>

            <div class="row mt-5 mb-5 justify-content-center g-4">
                <!-- Dimsum Ayam -->
                <div class="col-12 col-md-4">
                    <a href="produk.php?kategori=ayam" class="text-decoration-none">
                        <div class="card border-0 shadow-lg h-100 kategori-card position-relative overflow-hidden">
                            <div class="kategori-gradient position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #fffbe6 60%, #ffe082 100%); opacity:0.25; z-index:1;"></div>
                            <div class="card-body text-center position-relative" style="z-index:2;">
                                <img src="image/Ayam.jpeg" alt="Dimsum Ayam" class="rounded-circle shadow-lg mb-3 border border-4 border-warning" style="width:110px; height:110px; object-fit:cover;">
                                <h5 class="fw-bold text-dark mb-1">Dimsum Ayam</h5>
                                <span class="badge bg-warning text-dark mb-2 px-3 py-2 fs-6 shadow" style="border-radius: 1rem 0 1rem 1rem;">Terlaris <i class="fas fa-star"></i></span>
                                <p class="text-muted small mb-0">Rasa ayam juicy, favorit semua kalangan!</p>
                            </div>
                            <div class="kategori-ribbon bg-warning text-dark fw-bold px-3 py-1 position-absolute top-0 start-0 rounded-end" style="font-size:0.95rem; z-index:3;">
                                <i class="fas fa-crown me-1"></i> Best Seller
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Dimsum Udang -->
                <div class="col-12 col-md-4">
                    <a href="produk.php?kategori=udang" class="text-decoration-none">
                        <div class="card border-0 shadow-lg h-100 kategori-card position-relative overflow-hidden">
                            <div class="kategori-gradient position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #e0f7fa 60%, #00bcd4 100%); opacity:0.22; z-index:1;"></div>
                            <div class="card-body text-center position-relative" style="z-index:2;">
                                <img src="image/Udang.jpeg" alt="Dimsum Udang" class="rounded-circle shadow-lg mb-3 border border-4 border-info" style="width:110px; height:110px; object-fit:cover;">
                                <h5 class="fw-bold text-dark mb-1">Dimsum Udang</h5>
                                <span class="badge bg-info text-white mb-2 px-3 py-2 fs-6 shadow" style="border-radius: 1rem 0 1rem 1rem;">Fresh <i class="fas fa-water"></i></span>
                                <p class="text-muted small mb-0">Udang segar, tekstur kenyal, rasa premium.</p>
                            </div>
                            <div class="kategori-ribbon bg-info text-white fw-bold px-3 py-1 position-absolute top-0 start-0 rounded-end" style="font-size:0.95rem; z-index:3;">
                                <i class="fas fa-water me-1"></i> Paling Segar
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Dimsum Mentai -->
                <div class="col-12 col-md-4">
                    <a href="produk.php?kategori=mentai" class="text-decoration-none">
                        <div class="card border-0 shadow-lg h-100 kategori-card position-relative overflow-hidden">
                            <div class="kategori-gradient position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #fff3e0 60%, #ff9800 100%); opacity:0.22; z-index:1;"></div>
                            <div class="card-body text-center position-relative" style="z-index:2;">
                                <img src="image/Mentai.jpeg" alt="Dimsum Mentai" class="rounded-circle shadow-lg mb-3 border border-4" style="border-color:#fd7e14; width:110px; height:110px; object-fit:cover;">
                                <h5 class="fw-bold text-dark mb-1">Dimsum Mentai</h5>
                                <span class="badge text-white mb-2 px-3 py-2 fs-6 shadow" style="background:#fd7e14; border-radius: 1rem 0 1rem 1rem;">Favorit <i class="fas fa-fire"></i></span>
                                <p class="text-muted small mb-0">Mentai creamy, sensasi gurih yang unik!</p>
                            </div>
                            <div class="kategori-ribbon text-white fw-bold px-3 py-1 position-absolute top-0 start-0 rounded-end" style="background:#fd7e14; font-size:0.95rem; z-index:3;">
                                <i class="fas fa-fire me-1"></i> Paling Enak
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TENTANG KAMI -->
    <section class="container-fluid warna3 py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="image/Dimsum.jpeg" alt="Tentang Kami" class="img-fluid rounded-4 shadow-lg" style="max-height:180px; width:auto; object-fit:cover;">
                </div>
                <div class="col-lg-6 text-center text-lg-start">
                    <h3 class="fw-bold mb-3 mt-4 mt-lg-0"><i class="fas fa-store-alt me-2 text-warning"></i> About Me </h3>
                    <p class="fs-5 mb-4 text-muted">
                        Makan Dimsum adalah toko kuliner yang menghadirkan dimsum berkualitas premium dengan cita rasa autentik dan inovatif. Kami menggunakan bahan-bahan segar pilihan, diolah secara higienis, dan selalu mengutamakan kepuasan pelanggan. Nikmati berbagai varian dimsum favorit, mulai dari ayam, udang, hingga mentai, cocok untuk segala suasana!
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2 shadow-sm"><i class="fas fa-star me-1"></i> Premium Quality</span>
                        <span class="badge bg-info text-white fs-6 px-3 py-2 shadow-sm"><i class="fas fa-leaf me-1"></i> Fresh Ingredients</span>
                        <span class="badge bg-success text-white fs-6 px-3 py-2 shadow-sm"><i class="fas fa-heart me-1"></i> Halal &amp; Higienis</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUK -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3> Produk </h3>

            <div class="row mt-5">
                <!--PROSES DATA BASE-->
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-5 col-md-4 mb-3">
                        <div class="card">
                            <div class="image-box">
                                <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title fs-2"><?php echo $data['nama']; ?></h3>
                                <p class="card-text text-truncate fs-3"><?php echo $data['detail']; ?></p>
                                <p class="card-text text-harga fs-4 fw-bold">Rp.<?php echo $data['harga']; ?></p>
                                <div class="d-flex justify-content-center">
                                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class=" btn btn-warning text-white fw-bold px-4 py-2">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="fontawesome/js/all.min.js"></script>
</body>

</html>