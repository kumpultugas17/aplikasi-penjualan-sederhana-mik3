<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Aplikasi Menegement Sales">
   <meta name="author" content="M. Iqbal Adenan">
   <title>Aplikasi Management Sales | Customers</title>
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
                     <a href="pelanggan.php" class="nav-link text-nowrap me-3 active">
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
                  <h5 class="page-title">Customers</h5>
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
                           Customers
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>

            <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
               <div class="row">
                  <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                     <!-- button form add data -->
                     <a href="pelanggan-baru.php" class="btn btn-dark py-2 px-3">
                        <i class="ti ti-plus me-2"></i> Add Customer
                     </a>
                  </div>
                  <div class="col-lg-7 col-xl-6">
                     <!-- form pencarian -->
                     <form action="" method="GET">
                        <div class="input-group">
                           <input type="text" name="search" class="form-control form-search py-2" placeholder="Search category ..." autocomplete="off">
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
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">E-Mail</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Actions</th>
                     </thead>
                     <tbody>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'db_mik3_penjualan');
                        $no = 1;
                        $query = $conn->query("SELECT * FROM pelanggan");
                        foreach ($query as $data) :
                        ?>
                           <tr>
                              <td width="30" class="text-center"><?= $no++ ?></td>
                              <td width="200"><?= $data['nama_pelanggan'] ?></td>
                              <td width="150"><?= $data['email'] ?></td>
                              <td class="text-center" width="150"><?= $data['telepon'] ?></td>
                              <td width="70" class="text-center">
                                 <a href="" class="btn btn-primary btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Edit">
                                    <i class="ti ti-edit"></i>
                                 </a>
                                 <!-- button modal hapus data -->
                                 <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="" data-bs-tooltip="tooltip" data-bs-title="Delete">
                                    <i class="ti ti-trash"></i>
                                 </button>
                              </td>
                           </tr>
                        <?php endforeach ?>

                        <!-- Modal hapus data -->
                        <div class="modal fade" id="" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                       <i class="ti ti-trash me-2"></i> Delete Category
                                    </h1>
                                 </div>
                                 <div class="modal-body">
                                    <p class="mb-2">
                                       Are you sure to delete <span class="fw-bold mb-2">$category->name</span>?
                                    </p>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary py-2 px-3" data-bs-dismiss="modal">Cancel</button>
                                    <form action="" method="POST">
                                       <button type="submit" class="btn btn-danger py-2 px-3"> Yes, delete it! </button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </tbody>
                  </table>
               </div>

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