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
   <title>Aplikasi Management Sales | Transactions</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- Tabler Icons CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
   <!-- Gogole Font -->
   <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
   <!-- Sweetalert -->
   <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">
   <!-- Select2 -->
   <link rel="stylesheet" href="assets/select2/css/select2.min.css">
   <!-- jQuery -->
   <script src="assets/js/jquery-3.7.1.min.js"></script>
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
                     <a href="transaksi.php" class="nav-link text-nowrap me-3 active">
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
                  <h5 class="page-title">Transactions</h5>
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
                           Transactions
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
               <div class="row">
                  <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                     <!-- button modal add transaksi -->
                     <button type="button" data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-dark py-2 px-3">
                        <i class="ti ti-plus me-2"></i> Add Transactions
                     </button>
                     <!-- form modal add transaksi -->
                     <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="modalTambahLabel">
                                    <i class="ti ti-shopping-cart me-2"></i> Add Transaction
                                 </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="insert_transaksi.php" method="post">
                                 <div class="modal-body">
                                    <div class="mb-3">
                                       <label for="tanggal" class="form-label">Date</label>
                                       <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                    <div class="mb-3">
                                       <label for="pelanggan" class="form-label">Customer</label>
                                       <select name="pelanggan" id="pelanggan" class="select2-single" required>
                                          <option value="" disabled selected>Choose Customer</option>
                                          <?php
                                          $query = $conn->query("SELECT * FROM pelanggan");
                                          foreach ($query as $data) :
                                          ?>
                                             <option value="<?= $data['id_pelanggan']; ?>"><?= $data['nama_pelanggan']; ?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                    <div class="mb-3">
                                       <label for="produk" class="form-label">Product</label>
                                       <select name="produk" id="produk" class="select2-single" required>
                                          <option value="" disabled selected>Choose Product</option>
                                          <?php
                                          $query = $conn->query("SELECT * FROM produk");
                                          foreach ($query as $data) :
                                          ?>
                                             <option value="<?= $data['id_produk']; ?>"><?= $data['nama_produk'] . " - Rp " . $data['harga']; ?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                    <div class="mb-3">
                                       <label for="jumlah" class="form-label">Quantity</label>
                                       <input type="number" class="form-control" id="jumlah" name="jumlah" required placeholder="Enter Quantity">
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-dark py-2 px-3"> Submit </button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="col-lg-7 col-xl-6">
                     <!-- form pencarian -->
                     <form action="" method="GET">
                        <div class="input-group">
                           <input type="text" name="search" class="form-control form-search py-2" placeholder="Search category ..." autocomplete="off" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                           <button class="btn btn-dark py-2" type="submit">Search</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

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
                        <th class="text-center">Actions</th>
                     </thead>
                     <tbody>
                        <?php

                        // Jumlah data per halaman
                        $limit = 5;

                        // Ambil halaman saat ini
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $page = max($page, 1); // Halaman minimal adalah 1

                        // Hitung offset
                        $offset = ($page - 1) * $limit;

                        // Ambil nilai pencarian
                        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

                        // Bersihkan input untuk menghindari SQL injection
                        $search_clean = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');

                        // Tambahkan kondisi pencarian jika ada
                        $search_condition = $search ? "WHERE nama_produk LIKE '%$search_clean%' OR nama_pelanggan LIKE '%$search_clean%'" : "";

                        // Hitung total hasil
                        $total_results_query = "SELECT COUNT(*) AS total FROM transaksi $search_condition";
                        $total_results_result = $conn->query($total_results_query);
                        $total_results = $total_results_result->fetch_assoc()['total'];

                        // Hitung total halaman
                        $total_pages = ceil($total_results / $limit);

                        // Query data dengan limit dan offset
                        $query = "SELECT * FROM transaksi INNER JOIN produk ON transaksi.produk_id = produk.id_produk INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id_pelanggan $search_condition LIMIT $limit OFFSET $offset";
                        $result = $conn->query($query);

                        $no = 1;
                        foreach ($result as $data) :
                           $total = $data['harga'] * $data['jumlah'];
                        ?>
                           <tr>
                              <td width="30" class="text-center"><?= $no++ ?></td>
                              <td width="100"><?= $data['tanggal'] ?></td>
                              <td width="150"><?= $data['nama_pelanggan'] ?></td>
                              <td width="200"><?= $data['nama_produk'] ?></td>
                              <td class="text-center" width="150">Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                              <td class="text-center" width="50"><?= $data['jumlah'] ?></td>
                              <td class="text-center" width="150">Rp <?= number_format($total, 0, ',', '.') ?></td>
                              <td width="70" class="text-center">
                                 <a href="edit_produk.php?id=<?= $data['id_transaksi'] ?>" class="btn btn-primary btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Edit">
                                    <i class="ti ti-edit"></i>
                                 </a>
                                 <!-- button modal hapus data -->
                                 <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id_transaksi'] ?>" data-bs-tooltip="tooltip" data-bs-title="Delete">
                                    <i class="ti ti-trash"></i>
                                 </button>
                              </td>
                           </tr>
                           <!-- Modal hapus data -->
                           <div class="modal fade" id="modalHapus<?= $data['id_transaksi'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h1 class="modal-title fs-5" id="exampleModalLabel">
                                          <i class="ti ti-trash me-2"></i> Hapus Produk
                                       </h1>
                                    </div>
                                    <div class="modal-body">
                                       <p class="mb-2">
                                          Apakah Anda yakin
                                          <span class="fw-bold mb-2">
                                             <?= $data['nama_produk'] ?>
                                          </span> akan dihapus?
                                       </p>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                                       <form action="hapus_produk.php" method="POST">
                                          <input type="hidden" name="id_hapus" value="<?= $data['id_produk'] ?>">
                                          <button type="submit" class="btn btn-danger py-2 px-3"> Yes, delete it! </button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php endforeach ?>
                     </tbody>
                  </table>
               </div>
               <?php if ($total_pages > 1) { ?>
                  <nav aria-label="pagination">
                     <ul class="pagination">
                        <?php if ($page > 1) { ?>
                           <li class="page-item">
                              <a href="?search=<?= urlencode($search) ?>&page=<?= ($page - 1) ?>" class="page-link">Previous</a>
                           </li>
                        <?php } else { ?>
                           <li class="page-item disabled">
                              <a href="#" class="page-link">Previous</a>
                           </li>
                        <?php } ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                           <?php if ($i == $page) { ?>
                              <li class="page-item active"><a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a></li>
                           <?php } else { ?>
                              <li class="page-item"><a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a></li>
                           <?php } ?>
                        <?php } ?>

                        <?php if ($page < $total_pages) { ?>
                           <li class="page-item">
                              <a href="?search=<?= urlencode($search) ?>&page=<?= ($page + 1) ?>" class="page-link">Next</a>
                           </li>
                        <?php } else { ?>
                           <li class="page-item disabled">
                              <a class="page-link">Next</a>
                           </li>
                        <?php } ?>
                     </ul>
                  </nav>
               <?php } ?>
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
   <!-- Sweetalert JS -->
   <script src="assets/sweetalert2/sweetalert2.all.min.js"></script>
   <!-- Select2 JS -->
   <script src="assets/select2/js/select2.min.js"></script>
   <script>
      // select2
      $('.select2-single').each(function() {
         $(this).select2({
            // fix select2 search input focus bug
            dropdownParent: $(this).parent(),
         })
      })

      // fix select2 bootstrap modal scroll bug
      $(document).on('select2:close', '.select2-single', function(e) {
         var evt = "scroll.select2"
         $(e.target).parents().off(evt)
         $(window).off(evt)
      })
   </script>
   <!-- Notifications -->
   <?php if (isset($_SESSION['success'])) { ?>
      <script>
         Swal.fire({
            position: "top-end",
            icon: "success",
            title: "<?= $_SESSION['success'] ?>",
            showConfirmButton: false,
            timer: 2000
         });
      </script>
   <?php }
   unset($_SESSION['success']) ?>

   <?php if (isset($_SESSION['error'])) { ?>
      <script>
         Swal.fire({
            position: "top-end",
            icon: "error",
            title: "<?= $_SESSION['error'] ?>",
            showConfirmButton: false,
            timer: 2000
         });
      </script>
   <?php }
   unset($_SESSION['error']) ?>
</body>

</html>