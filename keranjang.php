<?php
session_start();
error_reporting(0);
include('koneksi.php');
if (strlen($_SESSION['klogin']) == 0) {
  header('location:index.php');
}



if (isset($_POST['remove_code'])) {

  if (!empty($_SESSION['cart'])) {
    foreach ($_POST['remove_code'] as $key) {

      unset($_SESSION['cart'][$key]);
    }
    echo "<script>alert('Keranjang berhasil dihapus');</script>";
  }
}

?>

<?php include 'head.php'; ?>

<div class="container" style="margin-bottom: 50px;">
<div class="row">
        <div class="col-md-5">
            <a href="riwayat-pembelian.php"><img src="assets/images/img-nav.png" class="navbar-brand" style="width:100px;height:auto;"></a>
        </div>
        <div class="col-md-5">
            <span class="text-align text-right">Tanggal Cetak <?= date('Y-m-d') ?></span>
        </div>
    </div>


<h3>Kwitansi</h3>
  <div class="keranjang table-responsive-md">
    <form name="cart" method="POST">
      <?php
      if (!empty($_SESSION['cart'])) {
      ?>
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col" width="30%">Nama Barang</th>
              <th scope="col" width="15%">Harga Satuan</th>
              <th scope="col" width="10%">Kuantitas</th>
              <th scope="col" width="15%">Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $pdtid = array();
            $sql = "SELECT * FROM products WHERE id IN(";
            foreach ($_SESSION['cart'] as $id => $value) {
              $sql .= $id . ",";
            }
            $sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
            $query = mysqli_query($con, $sql);
            $totalprice = 0;
            $totalqunty = 0;
            if (!empty($query)) {
              while ($row = mysqli_fetch_array($query)) {
                $quantity = $_SESSION['cart'][$row['id']]['quantity'];
                $subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'];
                $totalprice += $subtotal;
                $_SESSION['subtotal'] = $subtotal;
                $_SESSION['qnty'] = $totalqunty += $quantity;

                array_push($pdtid, $row['id']);
                //print_r($_SESSION['pid'])=$pdtid;exit;
            ?>
                <tr>
                  <td><?php echo $row['productName']; ?></td>
                  <td>Rp <?php echo $row['productPrice']; ?></td>
                  <td><?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></td>
                  <td><?php echo $row['productPrice'] * $_SESSION['cart'][$row['id']]['quantity']; ?></td>
                </tr>

            <?php }
            }
            $_SESSION['pid'] = $pdtid;
            ?>
            <tr align="right">
              <td colspan="3">
                <p class="font-weight-bolder">Harga Total : <?php echo $_SESSION['tp'] = "$totalprice"; ?></p>
              </td>
            </tr>
          </tbody>
        </table>
    </form>
  </div>
</div>

<?php } else {
        echo '<center style="color: red;">Keranjang Kosong</center>';
      } ?>


<?php include 'footer.php'; ?>
<script>
	window.print();
</script>

<?php 
unset($_SESSION['cart']); ?>
