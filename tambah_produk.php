<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Form Tambah Produk</title>
</head>

<body>
   <h3>FORM TAMBAH PRODUK</h3>
   <form action="insert_produk.php" method="post">
      <label for="nama_produk">Nama Produk</label>
      <input type="text" name="nama_produk" id="nama_produk" required>
      <br>
      <label for="harga">Harga</label>
      <input type="number" name="harga" id="harga" required>
      <br>
      <label for="stok">Stok</label>
      <input type="number" name="stok" id="stok" required>
      <br>
      <button type="submit">Submit</button>
   </form>
</body>

</html>