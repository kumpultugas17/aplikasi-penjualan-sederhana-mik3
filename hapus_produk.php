<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_mik3_penjualan');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $id = $_POST['id_hapus'];
   $sql = $conn->query("DELETE FROM produk WHERE id_produk = '$id'");
   if ($sql) {
      $_SESSION['success'] = 'Produk berhasil dihapus.';
      header('location:produk.php');
   } else {
      $_SESSION['error'] = 'Produk gagal dihapus.';
      header('location:produk.php');
   }
} else {
   echo "<script>
      alert('Silahkan klik tombol hapus pada tabel jika ingin menghapus data');
      window.location.href='produk.php';
   </script>";
}
