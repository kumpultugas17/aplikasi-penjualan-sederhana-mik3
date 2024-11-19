<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik3_penjualan');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $nama_produk = $_POST['nama_produk'];
   $harga = $_POST['harga_produk'];
   $stok = $_POST['stok'];

   $sql = $conn->query("INSERT INTO produk (nama_produk, harga, stok) VALUES ('$nama_produk', '$harga', '$stok')");

   if ($sql) {
      $_SESSION['success'] = 'Produk baru berhasil ditambahkan.';
      header('location:produk.php');
   } else {
      $_SESSION['error'] = 'Gagal menambahkan produk baru.';
      header('location:produk.php');
   }
} else {
   echo "<script>
      alert('Silahkan isi melalui data form tambah!');
      window.location.href='produk-baru.php';
   </script>";
}
