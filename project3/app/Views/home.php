<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    
    <!-- Efek animasi saat kartu disentuh kursor -->
    <style>
        .custom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
        }
    </style>
</head>

<body>

    <!-- Memanggil Navbar -->
    <?= $this->include('layouts/navbar'); ?>

    <!-- Banner (Hero Section) dibuat lebih berwarna dengan gradasi dan teks di tengah -->
    <div class="p-5 mb-5 text-white shadow-sm" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
      <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">Selamat Datang di MyBlog</h1>
        <p class="col-md-8 fs-4 mx-auto mt-3">Tempat berbagi cerita, pengalaman, dan pengetahuan dunia programming.</p>
      </div>
    </div>

    <div class="container">
        <!-- Mengubah susunan baris agar tampil menyamping (Grid) -->
        <div class="row">
            
            <!-- KARTU 1 -->
            <!-- col-md-4 artinya 1 baris dibagi 3 kotak -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Mulai ngoding PHP</h5>
                        <p class="text-muted small mb-3"><i class="fas fa-calendar-alt"></i> 10 Mei 2026</p>
                        <p class="card-text">PHP adalah bahasa pemrograman server-side yang sangat populer untuk pengembangan web. Di artikel ini, kita akan membahas cara instalasi XAMPP, menulis sintaks dasar, dan membuat program 'Hello World' pertamamu.</p>
                    </div>
                    <!-- Tambahan tombol Read More di bagian bawah kartu -->
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <a href="#" class="btn btn-outline-primary btn-sm w-100">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- KARTU 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Jadi paham CSS dan JS</h5>
                        <p class="text-muted small mb-3"><i class="fas fa-calendar-alt"></i> 12 Mei 2026</p>
                        <p class="card-text">Setelah menguasai HTML dasar, langkah selanjutnya adalah mempercantik tampilan website dengan CSS dan membuatnya interaktif menggunakan JavaScript. Mari pelajari fungsi dan perbedaan mendasar dari kedua bahasa ini.</p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <a href="#" class="btn btn-outline-primary btn-sm w-100">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- KARTU 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Codeigniter asik juga kok</h5>
                        <p class="text-muted small mb-3"><i class="fas fa-calendar-alt"></i> 15 Mei 2026</p>
                        <p class="card-text">CodeIgniter adalah framework PHP yang ringan dan mudah digunakan. Di artikel ini, kita akan membahas cara instalasi, struktur dasar, dan beberapa fitur menarik dari CodeIgniter.</p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <a href="#" class="btn btn-outline-primary btn-sm w-100">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Footer -->
    <div class="container py-4">
        <footer class="pt-3 mt-4 text-muted border-top text-center">
            <div class="container">
                &copy; <?= Date('Y') ?> - Adilah Nazifah Salamah
            </div>
        </footer>
    </div>

    <!-- Tombol Back to Top yang melayang di pojok kanan bawah -->
    <a href="#" class="position-fixed bottom-0 end-0 m-4 bg-primary text-white rounded-circle shadow d-flex justify-content-center align-items-center" style="width: 50px; height: 50px; text-decoration: none; z-index: 999;">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- Jquery dan Bootsrap JS -->
    <!-- Menambahkan fallback jQuery CDN agar terbaca -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>

</html>