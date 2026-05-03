<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog - Blog</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />

    <!-- TAMBAHAN: CSS untuk efek hover pada kartu dan merapikan link judul -->
    <style>
        .custom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
        }
        /* Merapikan link judul artikel agar tidak ada garis bawah */
        .post-title a {
            text-decoration: none;
            color: #212529; /* Warna teks gelap */
            transition: color 0.2s;
        }
        .post-title a:hover {
            color: #0d6efd; /* Berubah jadi biru saat di-hover */
        }
    </style>
</head>

<body>

    <!-- Struktur Asli: Memanggil Navbar -->
    <?= $this->include('layouts/navbar'); ?>

    <!-- MODIFIKASI: Banner Blog dengan tema biru cerah -->
    <div class="p-5 mb-5 text-white shadow-sm text-center" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
      <div class="container py-5">
        <h1 class="display-4 fw-bold">Daftar Artikel</h1>
        <p class="col-md-8 fs-4 mx-auto mt-3">Kumpulan tulisan, tutorial, dan update terbaru dari kami.</p>
      </div>
    </div>

    <div class="container">
        <!-- MODIFIKASI: Mengubah susunan baris agar tampil menyamping menjadi 3 kolom -->
        <div class="row">
            
            <!-- Struktur Asli: Looping data postingan dari Controller -->
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 custom-card">
                        <div class="card-body d-flex flex-column">
                            
                            <!-- Judul Artikel (Bisa di-klik) -->
                            <h5 class="h5 fw-bold post-title mb-3">
                                <a href="/post/<?= $post['slug'] ?>"><?= $post['title'] ?></a>
                            </h5>
                            
                            <!-- Cuplikan Isi Artikel -->
                            <!-- Class flex-grow-1 memastikan tombol di bawahnya selalu sejajar meski panjang teks berbeda -->
                            <p class="text-muted flex-grow-1">
                                <?= substr($post['content'], 0, 120) ?>...
                            </p>
                            
                            <!-- Tombol Baca Selengkapnya yang mengarah ke link yang sama dengan judul -->
                            <a href="/post/<?= $post['slug'] ?>" class="btn btn-outline-primary btn-sm mt-3 w-100">
                                Baca Selengkapnya
                            </a>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            
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