<?php
session_start();
if (!isset($_SESSION['users'])) {
   header('location: login.php');
   exit();
}
$conn = mysqli_connect('localhost', 'root', '', 'db_mik3_penjualan');
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Aplikasi Menegement Sales">
   <meta name="author" content="M. Iqbal Adenan">
   <title>Aplikasi Management Sales | Reports</title>
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
                     <a href="produk.php" class="nav-link text-nowrap me-3">
                        <i class="ti ti-cube-spark align-text-top me-1"></i> Products
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="transaksi.php" class="nav-link text-nowrap me-3">
                        <i class="ti ti-shopping-cart align-text-top me-1"></i> Transactions
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="laporan.php" class="nav-link text-nowrap me-3 active">
                        <i class="ti ti-file-description align-text-top me-1"></i> Reports
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
                  <h5 class="page-title">Reports</h5>
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
                           Reports
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
               <div class="row">
                  <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                     <!-- button form add data -->
                     <form action="" method="get" class="d-flex align-items-center">
                        <input type="date" name="start_date" class="form-control">
                        <span class="mx-2">to</span>
                        <input type="date" name="end_date" class="form-control">
                        <button type="submit" class="btn btn-dark ms-2 px-3" style="width: 240px;">
                           <i class="ti ti-search me-2"></i> Search
                        </button>
                     </form>
                  </div>
               </div>
            </div>

            <?php
            if (isset($_GET['start_date']) && isset($_GET['end_date']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
            ?>
               <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-2 mb-5">
                  <div class="table-responsive mb-3">
                     <table class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                           <th class="text-center">No.</th>
                           <th class="text-center">Date</th>
                           <th class="text-center">Customer Name</th>
                           <th class="text-center">Product Name</th>
                           <th class="text-center">Price</th>
                           <th class="text-center">Quantity</th>
                           <th class="text-center">Total</th>
                        </thead>
                        <tbody>
                           <?php
                           // Ambil nilai pencarian
                           $start_date = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
                           $end_date = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';

                           // Bersihkan input untuk menghindari SQL injection
                           $search_start = htmlspecialchars($start_date, ENT_QUOTES, 'UTF-8');
                           $search_end = htmlspecialchars($end_date, ENT_QUOTES, 'UTF-8');

                           // Tambahkan kondisi pencarian jika ada
                           $search_condition = $search_start && $search_end ? "WHERE tanggal BETWEEN '$search_start' AND '$search_end'" : "";

                           // Query data dengan limit dan offset
                           $query = "SELECT * FROM transaksi INNER JOIN produk ON transaksi.produk_id = produk.id_produk INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id_pelanggan $search_condition";
                           $result = $conn->query($query);

                           $no = 1;
                           foreach ($result as $data) :
                              $total = $data['harga'] * $data['jumlah'];
                              $grand_total[] = $data['harga'] * $data['jumlah'];
                           ?>
                              <tr>
                                 <td width="30" class="text-center"><?= $no++ ?></td>
                                 <td width="100"><?= $data['tanggal'] ?></td>
                                 <td width="150"><?= $data['nama_pelanggan'] ?></td>
                                 <td width="200"><?= $data['nama_produk'] ?></td>
                                 <td class="text-center" width="150">Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                                 <td class="text-center" width="50"><?= $data['jumlah'] ?></td>
                                 <td class="text-center" width="150">Rp <?= number_format($total, 0, ',', '.') ?></td>
                              </tr>
                           <?php endforeach ?>
                           <tr>
                              <td colspan="6" class="text-end me-3">Grand Total</td>
                              <td class="text-center fw-bold">Rp <?= number_format(array_sum($grand_total), 0, ',', '.') ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

               </div>
            <?php } ?>

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