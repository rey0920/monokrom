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
    }

?>

<?php include 'head.php'; ?>
<?php include 'navbar.php'; ?>
    <div class="container">
        <div class="breadcumb">
            <p>Beranda / Riwayat Order</p>
        </div>
        <table class="table table-borderless table-striped" id="table_selesai">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                    <th>Customer</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = mysqli_query($con, "select products.productImage as pimg,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.customer as cust,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.paymentMethod is not null and orders.orderStatus is not null");
                $cnt = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td> <?= $cnt++;?></td>
                        <td><?php echo $row['pname']; ?></td>
                        <td>Rp <?php echo $price = $row['pprice']; ?></td>
                        <td><?php echo $qty = $row['qty']; ?></td>
                        <td><?php echo ($qty * $price); ?></td>
                        <td><?php echo $row['cust']; ?> </td>
                        <td><?php echo $row['odate']; ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php } ?>
<?php include 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#table_selesai').DataTable();
    });
</script>