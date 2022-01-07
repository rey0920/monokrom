<?php

session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Bangkok');
    $currentTime = date('d-m-Y h:i:s A', time());
}

//Statistik Pemesanan Menu Query
$produk = mysqli_query($con,"SELECT * FROM products");
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['productName'];
	
	$query = mysqli_query($con,"SELECT sum(quantity) as quantity from orders where productId='".$row['id']."'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['quantity'];
}

//Statistik Penjualan Perbulan Query
$labelBulanan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
for($bulan = 1;$bulan < 13;$bulan++)
{
	$query = mysqli_query($con,"SELECT sum(quantity) as quantity from orders where MONTH(orderDate)='$bulan'");
	$row = $query->fetch_array();
	$jumlah_produk_bulan[] = $row['quantity'];
}

//Statistik Pemasukkan Perbulan
$labelPendapatan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
for($bulan = 1;$bulan < 13;$bulan++)
{
	$query = mysqli_query($con,"SELECT sum(totalBelanja) as totalBelanja from orderhistory where MONTH(postingDate)='$bulan'");
	$row = $query->fetch_array();
	$total_pendapatan[] = $row['totalBelanja'];
}
?>


<?php include 'head.php' ?>
<?php include 'sidebar.php' ?>

<!-- Page Content  -->
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-link">
                <i class="navbar-toggler-icon"></i>
            </button>

            <h5>Dashboard Admin</h5>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-primary ">
                        <h5 class="card-title text-white text-right">Order Hari Ini</h5>
                        <?php
                        $f1 = "00:00:00";
                        $from = date('Y-m-d') . " " . $f1;
                        $t1 = "23:59:59";
                        $to = date('Y-m-d') . " " . $t1;
                        $result = mysqli_query($con, "SELECT * FROM orders where orderDate Between '$from' and '$to'");
                        $sql2 = mysqli_query($con, "SELECT SUM(totalBelanja) AS total_belanja FROM orderhistory WHERE postingDate BETWEEN '$from' AND '$to'");
                        $num_rows1 = mysqli_num_rows($result); {
                        ?>
                            <h3 class="text-white text-right"><b><?php echo htmlentities($num_rows1); ?></b></h3>
                        <?php } 
                            while ($row = mysqli_fetch_array($sql2)) { ?>
                                <span class="text-white">Pendapatan Hari ini : <?php echo $row['total_belanja'] ?></span>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-danger">
                        <h5 class="card-title text-white text-right">Pending Order</h5>
                        <?php
                        $status = 'Selesai';
                        $fromDate = date('Y-m-d');
                        $date = date_create($fromDate);
                        date_modify($date,"-7 days");
                        $from = date_format($date,"Y-m-d");
                        $to = date('Y-m-d');
                        $ret = mysqli_query($con, "SELECT * FROM Orders where orderStatus!='$status' || orderStatus is null ");
                        $week = mysqli_query($con, "SELECT SUM(totalBelanja) AS total_belanja FROM orderhistory WHERE postingDate BETWEEN '$from' AND '$to'");
                        $num = mysqli_num_rows($ret); { ?>
                            <h3 class="text-white text-right"><b><?php echo htmlentities($num); ?></b></h3>
                        <?php } 
                        while ($row = mysqli_fetch_array($week)) { ?>
                                <span class="text-white">Pendapatan Minggu ini : <?php echo $row['total_belanja'] ?></span>
                        <?php } ?>
                        <br>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-success">
                        <h5 class="card-title text-white text-right">Order Selesai</h5>
                        <?php
                            $status = 'Selesai';
                            $from = date('Y-m-01');
                            $to = date('Y-m-d');
                            $month = mysqli_query($con, "SELECT SUM(totalBelanja) AS total_belanja FROM orderhistory WHERE postingDate BETWEEN '$from' AND '$to' ");
                            $rt = mysqli_query($con, "SELECT * FROM Orders where orderStatus='$status'");
                            $num1 = mysqli_num_rows($rt); { ?>
                            <h3 class="text-white text-right"><b><?php echo htmlentities($num1); ?></b></h3>
                        <?php } 
                        while ($row = mysqli_fetch_array($month)) { ?>
                        
                            <span class="text-white">Pendapatan Bulan ini : <?php echo $row['total_belanja'] ?></span>
                        <?php } ?>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
            <h3>Data Pemesanan Barang</h3>
                <canvas id="myChart" width="400px" height="100px"></canvas>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
            <h3>Data Total Pemesanan Menu Perbulan</h3>
                <canvas id="myChartBulan" width="400px" height="100px"></canvas>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
            <h3>Pendapatan Perbulan</h3>
                <canvas id="myChartPendapatanBulan" width="400px" height="100px"></canvas>
            </div>
        </div>
        <br>
<!-- STATISTIK -->
    <!--Statistik Barang Pemesanan -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nama_produk);?>,
                datasets: [{
                    label: 'Grafik Data Pemesanan Barang',
                    data: <?php echo json_encode($jumlah_produk);?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!--Statistik Pemesanan Bulanan -->
    <script>
		var ctx = document.getElementById("myChartBulan").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labelBulanan); ?>,
				datasets: [{
					label: 'Grafik data Pemesanan Per Bulan',
					data: <?php echo json_encode($jumlah_produk_bulan); ?>,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
    <!--Statistik Pemasukkan Bulanan -->
    <script>
		var ctx = document.getElementById("myChartPendapatanBulan").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labelPendapatan); ?>,
				datasets: [{
					label: 'Grafik Data Pemasukkan Per Bulan',
					data: <?php echo json_encode($total_pendapatan); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],  
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</div>
    <?php include 'footer.php' ?>
</body>
</html>