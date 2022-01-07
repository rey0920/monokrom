<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
}

if (isset($_POST['submit'])) {
  $category = $_POST['category'];
  $description = $_POST['description'];
  $sql = mysqli_query($con, "insert into category(categoryName,categoryDescription) values('$category','$description')");
  $_SESSION['msg'] = "Kategori berhasil dibuat !!";
}

if (isset($_GET['del'])) {
  mysqli_query($con, "delete from category where id = '" . $_GET['id'] . "'");
  $_SESSION['delmsg'] = "Kategori berhasil dihapus !!";
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

      <h5>Kategori</h5>
    </div>
  </nav>

  <h5>Tambah Kategori</h5><br>



  <form method="POST">
    <?php if (isset($_POST['submit'])) { ?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
      </div>
    <?php } ?>


    <?php if (isset($_GET['del'])) { ?>
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
      </div>
    <?php } ?>

    <div class="form-group row">
      <label for="category" class="col-sm-2 col-form-label">Nama Kategori</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="category" name="category" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Deskripsi Kategori</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
      </div>
    </div>
    <input type="submit" name="submit" value="Tambah Kategori" class="btn btn-primary float-right">
    <a href="menu.php" class="btn btn-link float-right">Kembali</a>
  </form>

  <br><br>
  <hr>

  <h5>Data Kategori</h5><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Kategori</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $query = mysqli_query($con, "SELECT * from category");
      $cnt = 1;
      while ($row = mysqli_fetch_array($query)) {
      ?>
        <tr>
          <th scope="row"><?php echo htmlentities($cnt); ?></th>
          <td><?php echo htmlentities($row['categoryName']); ?></td>
          <td><?php echo htmlentities($row['categoryDescription']); ?></td>
          <td width="15%">
            <a href="edit-kategori.php?id=<?php echo $row['id'] ?>" class="btn btn-success btn-sm text-white">Edit</a>
            <a href="kategori.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm text-white">Hapus</a>
          </td>
        </tr>
      <?php $cnt = $cnt + 1;
      } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php' ?>