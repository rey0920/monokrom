<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <a href="index.php" class="navbar-brand ml-4">Admin</a>
            <li>
                <a href="menu.php">Dashboard</a>
            </li>
            <span class="title">Menu Data Order</span>
            <li>
                <?php
                $f1 = "00:00:00";
                $from = date('Y-m-d') . " " . $f1;
                $t1 = "23:59:59";
                $to = date('Y-m-d') . " " . $t1;
                $result = mysqli_query($con, "SELECT * FROM orders where orderDate Between '$from' and '$to'");
                $num_rows1 = mysqli_num_rows($result); {
                ?>
                    <a href="order-hari-ini.php">Order Hari Ini <b class="badge badge-dark float-right"><?php echo htmlentities($num_rows1); ?></b></a>
                <?php } ?>
            </li>
            <li>
                <?php
                $status = 'Selesai';
                $ret = mysqli_query($con, "SELECT * FROM orders where orderStatus!='$status' || orderStatus is null ");
                $num = mysqli_num_rows($ret); { ?>

                    <a href="pending-order.php">Pending Order <b class="badge badge-dark float-right"><?php echo htmlentities($num); ?></b></a>
                <?php } ?>
            </li>
            <li>
                <?php
                $status = 'Selesai';
                $rt = mysqli_query($con, "SELECT * FROM orders where orderStatus='$status'");
                $num1 = mysqli_num_rows($rt); { ?>
                    <a href="order-selesai.php">Order Selesai <b class="badge badge-success float-right"><?php echo htmlentities($num1); ?></b></a>
                <?php } ?>
            </li> <br>
            <span class="title">Menu Produk</span>
            <li>
                <a href="kategori.php">Buat Kategori</a>
            </li>
            <li>
                <a href="tambah-produk.php">Tambah Produk</a>
            </li>
            <li>
                <a href="kelola-produk.php">Kelola Produk</a>
            </li> <br>
            <span class="title">Keuangan</span>
            <li>
                <a href="history-keuangan.php">History Keuangan</a> <br>
            </li>
            <span class="title">Manage Pegawai</span>
            <li>
                <a href="tambah-pegawai.php">Tambah Pegawai</a>
                <a href="pegawai.php">Kelola Pegawai</a> <br>
            </li>
            <span class="title">Pengaturan Akun</span>
            <li>
                <a href="ganti-password.php">Ganti Password</a>
            </li>
            <li>
                <a href="logout.php">Keluar</a>
            </li>
        </ul>
    </nav>