<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog - About</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    
    <!-- TAMBAHAN: CSS untuk efek hover pada kartu -->
    <style>
        .custom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
        }
        .icon-circle {
            width: 70px;
            height: 70px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <!-- Struktur Asli: Memanggil Navbar -->
    <?= $this->include('layouts/navbar'); ?>

    <!-- MODIFIKASI: Banner About dibuat elegan dengan gradasi warna ungu-biru -->
    <div class="p-5 mb-5 text-white shadow-sm text-center" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
      <div class="container py-5">
        <h1 class="display-4 fw-bold">About Me</h1>
        <p class="col-md-8 fs-4 mx-auto mt-3">Mengenal lebih dekat siapa di balik layar project aplikasi ini.</p>
      </div>
    </div>

    <div class="container">
        <!-- MODIFIKASI: Mengubah susunan baris agar tampil menyamping menjadi 3 kolom (col-md-4) -->
        <div class="row text-center">
            
            <!-- KARTU 1: Siapa Aku -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Siapa Aku ?</h5>
                        <p class="card-text text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam perferendis commodi tenetur quos ducimus repellat nulla, nam magni. Commodi iusto ad harum voluptas.</p>
                    </div>
                </div>
            </div>

            <!-- KARTU 2: Bisa Apa Aku -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Bisa Apa Aku ?</h5>
                        <p class="card-text text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam perferendis commodi tenetur quos ducimus repellat nulla, nam magni. Commodi iusto ad harum voluptas.</p>
                    </div>
                </div>
            </div>

            <!-- KARTU 3: Bagaimana Aku -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Bagaimana Aku ?</h5>
                        <p class="card-text text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam perferendis commodi tenetur quos ducimus repellat nulla, nam magni. Commodi iusto ad harum voluptas.</p>
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