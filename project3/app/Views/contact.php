<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog - Contact</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    
    <!-- TAMBAHAN: CSS untuk efek hover card (tanpa CSS icon) -->
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

    <!-- Struktur Asli: Memanggil Navbar -->
    <?= $this->include('layouts/navbar'); ?>

    <!-- MODIFIKASI: Banner Contact dengan gradasi hijau-teal agar terlihat "fresh" dan ramah -->
    <div class="p-5 mb-5 text-white shadow-sm text-center" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
      <div class="container py-5">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="col-md-8 fs-4 mx-auto mt-3">Punya pertanyaan atau masukan? Jangan ragu untuk menghubungi kami.</p>
      </div>
    </div>

    <div class="container">
        <!-- MODIFIKASI: Mengubah baris agar tampil menyamping menjadi 3 kolom.
             Class 'text-center' memastikan semua teks di dalamnya rata tengah. -->
        <div class="row text-center">
            
            <!-- KARTU 1: Alamat -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title fw-bold">Alamat</h5>
                        <p class="card-text text-muted mb-0">Jl. KH. Abdurrahman No. 05A,<br>Kota Depok, Indonesia</p>
                    </div>
                </div>
            </div>

            <!-- KARTU 2: Email -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title fw-bold">Email</h5>
                        <p class="card-text text-muted">difanazf06@gmail.com<br>zifaasl06@gmail.com</p>
                        <a href="mailto:difanazf06@gmail.com" class="btn btn-sm btn-outline-primary mt-2">Kirim Email</a>
                    </div>
                </div>
            </div>

            <!-- KARTU 3: No.HP / WhatsApp -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title fw-bold">WhatsApp</h5>
                        <p class="card-text text-muted">+62 852-1060-9076<br>(Senin - Jumat, 09:00 - 17:00)</p>
                        <a href="https://wa.me/6285210609076" class="btn btn-sm btn-outline-success mt-2" target="_blank">Chat Sekarang</a>
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