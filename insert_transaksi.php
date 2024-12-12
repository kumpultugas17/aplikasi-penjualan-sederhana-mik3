<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik3_penjualan');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $tanggal = $_POST['tanggal'];
   $pelanggan = $_POST['pelanggan'];
   $produk = $_POST['produk'];
   $jumlah = $_POST['jumlah'];

   $sql = $conn->query("INSERT INTO transaksi (tanggal, pelanggan_id, produk_id, jumlah) VALUES ('$tanggal', '$pelanggan', '$produk', '$jumlah')");

   if ($sql) {
      $_SESSION['success'] = 'Berhasil melakukan transaksi.';
      header('location:transaksi.php');
   } else {
      $_SESSION['error'] = 'Gagal melakukan transaksi.';
      header('location:transaksi.php');
   }
} else {
   echo "<script>
      alert('Silahkan isi melalui data form tambah!');
      window.location.href='transaksi.php';
   </script>";
}
