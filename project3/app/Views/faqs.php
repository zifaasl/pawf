<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog - FAQ</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    
    <!-- TAMBAHAN: CSS untuk efek hover pada kartu pertanyaan -->
    <style>
        .custom-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-left: 5px solid #0d6efd; /* Memberi garis biru di kiri kartu */
        }
        .custom-card:hover {
            transform: translateX(5px); /* Kartu bergeser sedikit ke kanan saat di-hover */
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        }
        .q-text {
            color: #0d6efd; /* Warna biru untuk huruf 'Q' */
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Struktur Asli: Memanggil Navbar -->
    <?= $this->include('layouts/navbar'); ?>

    <!-- MODIFIKASI: Banner FAQ dengan warna biru yang sama dengan Home -->
    <div class="p-5 mb-5 text-white shadow-sm text-center" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
      <div class="container py-5">
        <h1 class="display-4 fw-bold">FAQ</h1>
        <p class="col-md-8 fs-4 mx-auto mt-3">Pertanyaan yang Sering Diajukan</p>
      </div>
    </div>

    <div class="container">
        <!-- Struktur Asli: Baris tetap menggunakan col-md-12 karena cocok untuk FAQ -->
        <div class="row">
            
            <!-- KARTU FAQ 1 -->
            <div class="col-md-12 my-3">
                <div class="card shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="h5 fw-bold mb-3"><span class="q-text">Q:</span> Bagaimana cara membuat postingan baru?</h5>
                        <p class="text-muted mb-0"><span class="fw-bold">A:</span> Anda harus login terlebih dahulu sebagai admin, kemudian klik menu "New Post" pada navigasi bar di atas, lalu isi formulir judul dan konten yang disediakan.</p>
                    </div>
                </div>
            </div>

            <!-- KARTU FAQ 2 -->
            <div class="col-md-12 my-3">
                <div class="card shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="h5 fw-bold mb-3"><span class="q-text">Q:</span> Apakah data yang dihapus bisa dikembalikan?</h5>
                        <p class="text-muted mb-0"><span class="fw-bold">A:</span> Tidak. Semua data postingan yang sudah dihapus melalui halaman admin akan terhapus secara permanen dari sistem database.</p>
                    </div>
                </div>
            </div>

             <!-- KARTU FAQ 3 -->
             <div class="col-md-12 my-3">
                <div class="card shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="h5 fw-bold mb-3"><span class="q-text">Q:</span> Mengapa status postingan saya 'draft'?</h5>
                        <p class="text-muted mb-0"><span class="fw-bold">A:</span> Status 'draft' berarti postingan tersebut belum dipublikasikan dan hanya bisa dilihat oleh admin. Anda perlu mengedit postingan tersebut dan mengubah statusnya menjadi 'published' agar bisa dilihat oleh pengunjung.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Struktur Asli: Footer -->
    <div class="container py-4">
        <footer class="pt-3 mt-4 text-muted border-top text-center">
            <div class="container">
                &copy; <?= Date('Y') ?> - Adilah Nazifah Salamah
            </div>
        </footer>
    </div>

    <!-- Struktur Asli: Jquery dan Bootsrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>
</html>