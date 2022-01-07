<?php
    session_start();
    error_reporting(0);
    include("include/config.php");
    if (strlen($_SESSION['alogin']) == 0) {
        header('location:index.php');
    } else {
        date_default_timezone_set('Asia/Bangkok'); // change according timezone
        $currentTime = date('d-m-Y h:i:s A', time());

    //Statistik Pemasukkan Perbulan
    $labelPendapatan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    for($bulan = 1;$bulan < 13;$bulan++)
    {
        $query = mysqli_query($con,"SELECT sum(totalBelanja) as totalBelanja from orderhistory where MONTH(postingDate)='$bulan'");
        $row = $query->fetch_array();
        $total_pendapatan[] = $row['totalBelanja'];
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
    
    //Statistik PEmesanan Customer Terbanyak Query
    $cust = mysqli_query($con,"SELECT * FROM orders GROUP BY customer ORDER BY COUNT(customer) DESC limit 5");
    while($row = mysqli_fetch_array($cust)){
        $nama_cust[] = $row['customer'];
        
        $query = mysqli_query($con,"SELECT count(customer) as customer from orders where customer = '$row[customer]'");
        $row = $query->fetch_array();
        $jumlah_pesanan[] = $row['customer'];
    }
    
    ?>

    <?php include 'head.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <img src="../assets/images/img-nav.png" class="navbar-brand" style="width:100px;height:auto;">
        </div>
        <div class="col-md-5">
            <span class="text-align text-right">Tanggal Cetak <?= date('Y-m-d') ?></span>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-border table-striped" id="table_history">
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
                        <td colspan=3><b>Total Keseluruhan:</b></td>
                        <td colspan=2 align="right"><b><?php echo $data['total_belanja']; ?></b></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </table>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
                <canvas id="myChart" width="400px" height="100px"></canvas>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
                <canvas id="myChartBulan" width="400px" height="100px"></canvas>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
                <canvas id="myChartPendapatanBulan" width="400px" height="100px"></canvas>
            </div>
            <div class="col-md-12"><br><br><br></div>
            <div class="col-md-12">
                <canvas id="myChartCustomer" width="400px" height="100px"></canvas>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
<?php } ?>
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
    <!--Statistik Customer Terbanyak -->
    <script>
		var ctx = document.getElementById("myChartCustomer").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($nama_cust); ?>,
				datasets: [{
					label: 'Grafik Data Customer Terbanyak',
					data: <?php echo json_encode($jumlah_pesanan); ?>,
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
<script>
	window.print();
</script>