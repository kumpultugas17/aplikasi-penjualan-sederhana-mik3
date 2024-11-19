<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik3_penjualan');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $id = $_POST['id'];
   $nama_produk = $_POST['nama_produk'];
   $harga = $_POST['harga_produk'];
   $stok = $_POST['stok'];

   $sql = $conn->query("UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id_produk='$id'");

   if ($sql) {
      $_SESSION['success'] = 'Produk berhasil diupdate!';
      header('location:produk.php');
   } else {
      $_SESSION['error'] = 'Produk berhasil diupdate!';
      header('location:produk.php');
   }
} else {
   echo "<script>
      alert('Silahkan klik tombol edit pada tabel produk!');
      window.location.href='produk.php';
   </script>";
}
