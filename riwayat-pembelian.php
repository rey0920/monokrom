<?php
session_start();
error_reporting(0);
include('koneksi.php');
if (strlen($_SESSION['klogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['konfirmasi'])) {
        $orderid = $_POST['orderid'];
        $status = $_POST['status'];
        $keterangan = $_POST['keterangan'];
        $tp = $_POST['totalBelanja'];

        $query = mysqli_query($con, "insert into orderhistory(orderId,status,keterangan,totalBelanja) values('$orderid','$status','$keterangan','$tp')");
        $sql = mysqli_query($con, "update orders set orderStatus='$status' where id='$orderid'");
        echo "<script>alert('Pesanan berhasil di konfirmasi');</script>";
    }

?>

<?php include 'head.php'; ?>
<?php include 'navbar.php'; ?>
    <div class="container">
        <div class="breadcumb">
            <p>Beranda / Riwayat Order</p>
        </div>



        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th scope="col" width="20%">Gambar</th>
                    <th scope="col" width="15%">Nama</th>
                    <th scope="col" width="10%">Harga</th>
                    <th scope="col" width="10%">Kuantitas</th>
                    <th scope="col" width="10%">Total</th>
                    <th scope="col" width="10%">Customer</th>
                    <th scope="col" width="10%">Tanggal Pembelian</th>
                    <th scope="col" width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $query = mysqli_query($con, "select products.productImage as pimg,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.customer as cust,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='" . $_SESSION['id'] . "' and orders.paymentMethod is not null and orders.orderStatus is null");
                $cnt = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <th scope="row"><img src="admin/productimages/<?php echo $row['pimg']; ?>" alt="Gambar" class="mx-auto img-fluid"></th>
                        <td><?php echo $row['pname']; ?></td>
                        <td>Rp <?php echo $price = $row['pprice']; ?></td>
                        <td><?php echo $qty = $row['qty']; ?></td>
                        <td><?php echo ($qty * $price); ?></td>
                        <td><?php echo $row['cust']; ?> </td>
                        <td><?php echo $row['odate']; ?> </td>
                        <td>    
                            <form method="POST">
                                <input type="hidden" name="orderid" value="<?php echo $row['orderid']; ?>">
                                <input type="hidden" name="status" value="Selesai">
                                <input type="hidden" name="keterangan" value="Orderan Telah Selesai">
                                <input type="hidden" name="totalBelanja" value="<?php echo ($qty * $price); ?>">
                                <button type="submit" class="btn btn-primary btn-lg" name="konfirmasi"><i class="fa fa-check"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>

<?php } ?>
<?php include 'footer.php' ?>