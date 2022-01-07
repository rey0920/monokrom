<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productDescription = $_POST['productDescription'];
        $qty = $_POST['qty'];
        $productImage = $_FILES["productImage"]["name"];

        $query = mysqli_query($con, "select max(id) as pid from products");
        $result = mysqli_fetch_array($query);

        move_uploaded_file($_FILES["productImage"]["tmp_name"], "productimages/" . $_FILES["productImage"]["name"]);

        $sql = mysqli_query($con, "insert into products(category,productName,productPrice,productDescription,qty,productImage) values('$category','$productName','$productPrice','$productDescription','$qty','$productImage')");
        $_SESSION['msg'] = "Produk berhasil ditambahkan!!";
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

            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select name="category" id="category" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php $query = mysqli_query($con, "select * from category");
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['categoryName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="productName" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="productName" name="productName" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="productPrice" class="col-sm-2 col-form-label">Harga Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="productPrice" name="productPrice" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="productDescription" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="productDescription" rows="3" name="productDescription" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="qty" class="col-sm-2 col-form-label">Kuantitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="qty" name="qty" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="productImage" class="col-sm-2 col-form-label">Gambar Produk</label>
                <div class="col-sm-10">
                    <input type="file" name="productImage" id="productImage" required>
                </div>
            </div>


            <input type="submit" name="submit" value="Tambah Produk" class="btn btn-primary float-right">
            <a href="menu.php" class="btn btn-link float-right">Kembali</a>
        </form>

    </div>

    <?php include 'footer.php' ?>

<?php } ?>