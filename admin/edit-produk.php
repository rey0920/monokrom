<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $pid = intval($_GET['id']); // product id
    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productDescription = $_POST['productDescription'];
        $qty = $_POST['qty'];

        $sql = mysqli_query($con, "update  products set category='$category',productName='$productName',productPrice='$productPrice',productDescription='$productDescription',qty='$qty' where id='$pid' ");
        $_SESSION['msg'] = "Produk berhasil diperbarui !!";
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

                <h5>Tambah Produk</h5>
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

            $query = mysqli_query($con, "select products.*,category.categoryName as catname,category.id as cid from products join category on category.id=products.category where products.id='$pid'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($query)) {



            ?>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="category" id="category" class="form-control">
                            <option value="<?php echo htmlentities($row['cid']); ?>"><?php echo htmlentities($row['catname']); ?></option>
                            <?php $query = mysqli_query($con, "select * from category");
                            while ($rw = mysqli_fetch_array($query)) {
                                if ($row['catname'] == $rw['categoryName']) {
                                    continue;
                                } else {
                            ?>

                                    <option value="<?php echo $rw['id']; ?>"><?php echo $rw['categoryName']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="productName" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="productName" name="productName" value="<?php echo htmlentities($row['productName']); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="productPrice" class="col-sm-2 col-form-label">Harga Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?php echo htmlentities($row['productPrice']); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="productDescription" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="productDescription" rows="3" name="productDescription" required><?php echo htmlentities($row['productDescription']); ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="qty" class="col-sm-2 col-form-label">Kuantitas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="qty" name="qty" value="<?php echo htmlentities($row['qty']); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="productImage" class="col-sm-2 col-form-label">Gambar Produk</label>
                    <div class="col-sm-10">
                        <img src="productimages/<?php echo htmlentities($row['productImage']); ?>" width="150" height="150">
                        <a href="update-gambar.php?id=<?php echo $row['id']; ?>">Ganti Gambar</a>
                    </div>
                </div>

            <?php } ?>

            <input type="submit" name="submit" value="Edit Produk" class="btn btn-primary float-right">
            <a href="menu.php" class="btn btn-link float-right">Kembali</a>

        </form>



    </div>

    <?php include 'footer.php' ?>

<?php } ?>