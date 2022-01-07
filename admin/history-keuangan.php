<?php
    session_start();
    error_reporting(0);
    include("include/config.php");
    if (strlen($_SESSION['alogin']) == 0) {
        header('location:index.php');
    } else {
        date_default_timezone_set('Asia/Bangkok'); // change according timezone
        $currentTime = date('d-m-Y h:i:s A', time());
    
    ?>

    <?php include 'head.php' ?>
    <?php include 'sidebar.php' ?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <br><br><br><br><br>
                        <form method="get" class="form-inline">
                            <div class="form-group">
                                <label for="dateClass"> PILIH TANGGAL : </label> &nbsp; 
                                Dari : <input type="date" name="tanggal_awal" id="dateClass" class="form-control"> &nbsp; 
                                Sampai : <input type="date" name="tanggal_akhir" id="dateClass" class="form-control">
                                <input type="submit" value="FILTER" class="btn btn-primary mb-2"> &nbsp;
                                <?php
                                if(isset($_GET['tanggal_awal'])){
                                    $tgl_Awal1 = $_GET['tanggal_awal'];
                                    $tgl_Akhir1 = $_GET['tanggal_akhir'];
                                }
                                ?>
                                <a href="cetak.php?tanggal_awal=<?= $tgl_Awal1 ;?>&&tanggal_akhir=<?= $tgl_Akhir1; ?>" target="_blank" class="btn btn-secondary mb-2"><span class="text-white">CETAK</span></a>
                            </div>
                        </form>

                <table class="table table-borderless table-striped" id="table_history">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Jumlah Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            if(isset($_GET['tanggal_awal'])){
                                $tgl_Awal = $_GET['tanggal_awal'];
                                $tgl_Akhir = $_GET['tanggal_akhir'];
                                $sql = mysqli_query($con,"SELECT t1.*,t2.* from orderhistory AS t1 JOIN orders AS t2 ON(t1.orderId = t2.id) WHERE postingDate BETWEEN '$tgl_Awal' AND '$tgl_Akhir'");
                                $sql2 = mysqli_query($con, "SELECT SUM(t1.totalBelanja) AS total_belanja FROM orderhistory AS t1 JOIN orders as t2 ON(t1.orderId=t2.id) WHERE postingDate BETWEEN '$tgl_Awal' AND '$tgl_Akhir'");
                            }else{
                                $sql = mysqli_query($con,"SELECT t1.*,t2.* from orderhistory AS t1 JOIN orders AS t2 ON(t1.orderId = t2.id)");
                                $sql2 = mysqli_query($con, "SELECT SUM(t1.totalBelanja) AS total_belanja FROM orderhistory AS t1 JOIN orders as t2 ON(t1.orderId=t2.id)");
                            }
                            while($data = mysqli_fetch_array($sql)){
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['postingDate']; ?></td>
                                <td><?php echo $data['customer']; ?></td>
                                <td><?php echo $data['status']; ?></td>
                                <td><?php echo $data['totalBelanja']; ?></td>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
                    <?php while($data = mysqli_fetch_array($sql2)){ ?>
                    <tr>
                        <td colspan=2><b>Total Keseluruhan:</b></td>
                        <td colspan=2 align="right"><b><?php echo $data['total_belanja']; ?></b></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>
<script>
    $(document).ready(function() {
        $('#table_history').DataTable();
    });
</script>

<?php } ?>