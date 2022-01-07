<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
}

if (isset($_GET['del'])) {
    mysqli_query($con, "delete from products where id = '" . $_GET['id'] . "'");
    $_SESSION['delmsg'] = "Product deleted !!";
}

?>

<?php include 'head.php' ?>

<?php include 'sidebar.php' ?>

<div id="content">

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-link">
                <i class="navbar-toggler-icon"></i>
            </button>

            <h5>Kelola Produk</h5>
        </div>
    </nav>

    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $query = mysqli_query($con, "select products.*,category.categoryName from products join category on category.id=products.category");
            $cnt = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <th scope="row"><?php echo htmlentities($cnt); ?></th>
                    <td><?php echo htmlentities($row['productName']); ?></td>
                    <td><?php echo htmlentities($row['categoryName']); ?></td>
                    <td><?php echo htmlentities($row['productPrice']); ?></td>
                    <td width=200px><img src="productimages/<?php echo htmlentities($row['productImage']); ?>" alt="<?php echo htmlentities($row['productName']); ?>" class="img-fluid img-thumbnail" ></td>
                    <td width="15%">
                        <a href="edit-produk.php?id=<?php echo $row['id'] ?>" class="btn btn-success btn-sm text-white">Edit</a>
                        <a href="kelola-produk.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm text-white">Hapus</a>
                    </td>
                </tr>
            <?php $cnt = $cnt + 1;
            } ?>
        </tbody>
    </table>
</div>

</body>

<?php include 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>