<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['slogin']) == 0) {
    header('location:index.php');
} else {
    $pid = intval($_GET['id']); // product id
    if (isset($_POST['submit'])) {
        $productname = $_POST['productName'];
        $productImage = $_FILES["productImage"]["name"];
        //$dir="productimages";
        //unlink($dir.'/'.$pimage);


        move_uploaded_file($_FILES["productImage"]["tmp_name"], "productimages/" . $_FILES["productImage"]["name"]);
        $sql = mysqli_query($con, "update  products set productImage='$productImage' where id='$pid' ");
        $_SESSION['msg'] = "Gambar produk berhasil diperbarui !!";
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

                <h5>Update Gambar Produk</h5>
            </div>
        </nav>

        <?php if (isset($_POST['submit'])) { ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
            </div>
        <?php } ?>


        <form name="insertproduct" method="POST" enctype="multipart/form-data">

            <?php

            $query = mysqli_query($con, "select productName,productImage from products where id='$pid'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($query)) {

            ?>
                <div class="form-group row">
                    <label for="productName" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="productName" name="productName" value="<?php echo  htmlentities($row['productName']); ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Gambar Produk</label>
                    <div class="col-sm-10">
                        <img src="productimages/<?php echo htmlentities($row['productImage']); ?>" width="150" height="150">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="productImage" class="col-sm-2 col-form-label">Gambar Produk</label>
                    <div class="col-sm-10">
                        <input type="file" name="productImage" id="productImage" required>
                    </div>
                </div>

            <?php } ?>

            <input type="submit" name="submit" value="Edit Gambar" class="btn btn-primary float-right">
            <a href="menu.php" class="btn btn-link float-right">Kembali</a>
        </form>

    </div>

    <?php include 'footer.php' ?>

<?php } ?>