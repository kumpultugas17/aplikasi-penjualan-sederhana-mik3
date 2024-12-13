<?php
session_start();
if (!isset($_SESSION['users'])) {
   header('location: login.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Aplikasi Menegement Sales">
   <meta name="author" content="M. Iqbal Adenan">
   <title>Aplikasi Management Sales | Produk</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- Tabler Icons CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
   <!-- Gogole Font -->
   <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
   <!-- My Style -->
   <link rel="stylesheet" href="assets/css/app.css">
   <style>
      * {
         padding: 0;
         margin: 0;
         font-family: 'Nunito', Courier, monospace;
         font-optical-sizing: auto;
         font-weight: 600;
         font-style: normal;
      }

      body {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         margin: 0;
      }

      main {
         flex: 1;
      }
   </style>
</head>

<body class="d-flex flex-column h-100">
   <header>
      <!-- Navbar Top -->
      <nav class="navbar navbar-top fixed-top bg-dark text-white">
         <div class="container">
            <a href="#" class="d-inline navbar-brand text-white">
               <img src="assets/images/logo-dashboard.png" alt="Logo" width="32" class="align-text-bottom me-2">
               <span class="fs-4 text-uppercase">Apliaksi Management Sales</span>
            </a>
         </div>
      </nav>
      <!-- Navbar Menu -->
      <nav class="navbar navbar-menu fixed-top navbar-expand-lg bg-light shadow-lg-sm">
         <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a href="dashboard.php" class="nav-link text-nowrap me-3">
                        <i class="ti ti-home align-text-top me-1"></i> Dashboard
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="pelanggan.php" class="nav-link text-nowrap me-3">
                        <i class="ti ti-users align-text-top me-1"></i> Customers
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="produk.php" class="nav-link text-nowrap me-3 active">
                        <i class="ti ti-cube-spark align-text-top me-1"></i> Products
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="transaksi.php" class="nav-link text-nowrap me-3">
                        <i class="ti ti-shopping-cart align-text-top me-1"></i> Transactions
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="laporan.php" class="nav-link text-nowrap me-3">
                        <i class="ti ti-file-description align-text-top me-1"></i> Report
                     </a>
                  </li>
               </ul>

               <div class="d-flex nav-item">
                  <a href="logout.php" class="nav-link text-nowrap">
                     <i class="ti ti-logout align-text-top me-1"></i> Logout
                  </a>
               </div>
            </div>
         </div>
      </nav>
   </header>

   <!-- Main Content -->
   <main class="flex-shrink-0">
      <div class="container">
         <div class="page-content">

            <div class="d-flex flex-column flex-lg-row mb-2">
               <!-- Page Title -->
               <div class="flex-grow-1">
                  <h5 class="page-title">Products</h5>
               </div>
               <div class="pt-lg-1">
                  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="dashboard.php" class="text-breadcrumb text-decoration-none">
                              <i class="ti ti-home fs-6"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           New Product
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-2 mb-5">
               <form action="insert_produk.php" method="POST">
                  <div class="row d-flex align-items-center mb-3">
                     <label for="nama_produk" class="col-sm-2 form-label">Nama Produk</label>
                     <div class="col-sm-10">
                        <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama produk" required>
                     </div>
                  </div>
                  <div class="row d-flex align-items-center mb-3">
                     <label for="harga_produk" class="col-sm-2 form-label">Harga Produk</label>
                     <div class="col-sm-10">
                        <input type="text" name="harga_produk" class="form-control" placeholder="Masukkan harga produk" required>
                     </div>
                  </div>
                  <div class="row d-flex align-items-center mb-4">
                     <label for="stok" class="col-sm-2 form-label">Stok</label>
                     <div class="col-sm-10">
                        <input type="text" name="stok" class="form-control" placeholder="Masukkan stok produk" required>
                     </div>
                  </div>
                  <div class="row d-flex align-items-center mb-2">
                     <div class="col-md-12 offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="produk.php" class="btn btn-secondary">Cancel</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </main>

   <!-- Footer -->
   <footer class="footer bg-white shadow mt-auto py-3">
      <div class="container">
         <div class="d-flex flex-column flex-md-row align-items-center align-items-md-left">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
               &copy; 2024 - <a href="#" target="_blank" class="fw-semibold">ELTIBIZ Koding</a>. All rights reserved.
            </div>
            <!-- link -->
            <div class="link ms-md-auto">
               <a href="#" target="_blank">Terms & Conditions</a>
            </div>
         </div>
      </div>
   </footer>

   <!-- Bootstrap JS -->
   <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>