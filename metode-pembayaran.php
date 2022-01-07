<?php
session_start();
error_reporting(0);
include('koneksi.php');
if (strlen($_SESSION['klogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {

        mysqli_query($con, "update orders set paymentMethod='" . $_POST['paymethod'] . "', customer='" . $_POST['customer'] . "' where userId='" . $_SESSION['id'] . "' and paymentMethod is null ");
        header('location:keranjang.php');
    }
?>

<?php include 'head.php' ?>

    <div class="container" style="margin-bottom: 50px;">
        <div class="breadcumb mb-5">
            <p>Beranda / Metode Pembayaran</p>
        </div>

        <form method="POST">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="2">Pilih Metode Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A/N <input type="text" name="customer" id=""></td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="paymethod" value="tunai" checked="checked"> Tunai </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Pilih Metode Pemayaran" name="submit" class="btn btn-primary btn-sm"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

<?php } ?>

<?php include 'head.php'; ?>