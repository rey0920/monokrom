<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
}

if (isset($_GET['del'])) {
    mysqli_query($con, "DELETE from users where id_user = '" . $_GET['id_user'] . "'");
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

            <h5>Kelola Pegawai</h5>
        </div>
    </nav>

    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $query = mysqli_query($con, "SELECT * FROM users");
            $cnt = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <th scope="row"><?php echo htmlentities($cnt); ?></th>
                    <td><?php echo htmlentities($row['username']); ?></td>
                    <td width="15%">
                        <a href="edit-pegawai.php?id_user=<?php echo $row['id_user'] ?>" class="btn btn-success btn-sm text-white">Edit</a>
                        <a href="pegawai.php?id_user=<?php echo $row['id_user'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm text-white">Hapus</a>
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