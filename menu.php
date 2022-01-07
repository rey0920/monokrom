<?php
session_start();
error_reporting(0);
include("koneksi.php");
if (strlen($_SESSION['klogin']) == 0) {
    header('location:index.php');
}

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $sql_p = "SELECT * FROM products WHERE id={$id}";
        $query_p = mysqli_query($con, $sql_p);
        if (mysqli_num_rows($query_p) != 0) {
            $row_p = mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
            header('Location:menu.php');
        } else {
            $message = "Product ID is invalid";
        }
    }
}

if (isset($_POST['update'])) {
	if (!empty($_SESSION['cart'])) {
	  foreach ($_POST['quantity'] as $key => $val) {
		if ($val == 0) {
		  unset($_SESSION['cart'][$key]);
		} else {
		  $_SESSION['cart'][$key]['quantity'] = $val;
		}
	  }
	  echo "<script>alert('Keranjang berhasil diperbarui');</script>";
	}
  }
  
  
  if (isset($_POST['remove_code'])) {
  
	if (!empty($_SESSION['cart'])) {
	  foreach ($_POST['remove_code'] as $key) {
  
		unset($_SESSION['cart'][$key]);
	  }
	}
  }
  
  
  if (isset($_POST['ordersubmit'])) {
  
	if (strlen($_SESSION['klogin']) == 0) {
	  header('location:index.php');
	} else {
  
	  $quantity = $_POST['quantity'];
	  $pdd = $_SESSION['pid'];
	  $value = array_combine($pdd, $quantity);
	  $date = date('d-m-Y');
  
	  foreach ($value as $qty => $val34) {
  
		mysqli_query($con, "INSERT into orders(userId,productId,quantity) values('" . $_SESSION['id'] . "','$qty','$val34')");
		header('location:metode-pembayaran.php');
	  }
	}
  }
  
  ?>
<?php include 'head.php'; ?>
<?php include 'navbar.php'; ?>

<div class="container-fluid">
<div class="row">
  <div class="col-md-8 bg-light">
	<div class="content" style="width:100%;height:auto;overflow-x:hidden;overflow-y: auto;">
		<div class="row">
		<?php $query = mysqli_query($con, "select * from products ORDERS");
		while ($row = mysqli_fetch_array($query)) {
		?>
			<div class="col-md-3 col-sm-6" style="padding-top:20px;">
			<a href="menu.php?page=product&action=add&id=<?php echo $row['id']; ?>" style="text-decoration: none; color: #000">
				<div class="card h-60 ">
					<img src="admin/productimages/<?php echo htmlentities($row['productImage']); ?>"
						class="card-img-top"
						alt="<?php echo htmlentities($row['productName']); ?>"/>
						<div class="card-body">
						<p class="card-text"><?php echo htmlentities($row['productName']); ?></p>
						<p class="card-text text-right text-primary">Rp. <?php echo htmlentities($row['productPrice']); ?></p>
					</div> 
				</div>
			</a>
			</div>
		<?php } ?>
		</div>
	</div> 
  </div>

  <!-----------------------------------------------Keranjang------------------------------->
  <div class="col-md-4">
	<div class="keranjang table-responsive-md" style="width:100%;height:400px;overflow-x:hidden;overflow-y: auto;">
		<form name="cart" method="POST">
			<?php
			if (!empty($_SESSION['cart'])) {
			?>
			<table class="table table-border table-striped">
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
						<th scope="row"><img src="admin/productimages/<?php echo $row['productImage']; ?>" alt="Gambar" class="mx-auto img-fluid" style="width:80px;height:auto;"></th>
						<td>
							<?php echo $row['productName']; ?>
							<br>
							Rp <?php echo $row['productPrice']; ?>
						</td>
						<td><input type="number" style="width:40px;" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]"></td>
						<td><p style="font-size:20px;">Rp. <?php echo $row['productPrice'] * $_SESSION['cart'][$row['id']]['quantity']; ?></p></td>
						<td><button type="submit" value="<?php echo htmlentities($row['id']); ?>" name="remove_code[]" class="btn btn-danger"><i class="fa fa-times"></i></button></td>
					</tr>
	
				<?php }
				}
				$_SESSION['pid'] = $pdtid;
				?>
				</tbody>
			</table>
	</div>
			<table class="table">
					<tr>
						<td align="left">
							<p class="font-weight-bolder">Harga Total : <?php echo $_SESSION['tp'] = "$totalprice"; ?></p>
							Uang Pelanggan : <input type="number" id="check" onkeyup="sum();"> <br>
							<input type="hidden" id="totalPrice" value="<?= $totalprice ?>" onkeyup="sum();">
							Kembalian : <input type="text" id="hasil" disabled>
						</td>
						<td> 
							<button type="submit" class="btn btn-success btn-lg" name="update"><i class="fa fa-refresh"></i></button>
							<button type="submit" class="btn btn-primary btn-lg" name="ordersubmit" id="add_data"><i class="fa fa-money"></i></button>
						</td>
					</tr>
			</table>
		</form>
	</div>
	<?php } else {
		  echo '<center style="color: grey;padding-top:50px;">Keranjang Kosong</center>';
		} ?>
  </div>
		<div class="col-md-1"></div>
  </div>

<?php include 'footer.php' ?>

<script>
$(function() {
    $('button#add_data').prop('disabled', true);
    $('#check').on('input', function(e) {
        if(this.value.length >= 4) {
            $('button#add_data').prop('disabled', false);
        } else {
            $('button#add_data').prop('disabled', true);
        }
    });
});
function sum() {
      var txtFirstNumberValue = document.getElementById('check').value;
      var txtSecondNumberValue = document.getElementById('totalPrice').value;
      var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('hasil').value = result;
      }
}
</script>