<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $sql = mysqli_query($con, "INSERT into users(username,password) values('$username','$password')");
  $_SESSION['msg'] = "Users berhasil dibuat !!";
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

      <h5>Pegawai</h5>
    </div>
  </nav>

  <h5>Tambah Pegawai</h5><br>

<form method="POST">
<?php if (isset($_POST['submit'])) { ?>
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
    </div>
<?php } ?>

<div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label">Nama Pegawai</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
</div>
<input type="submit" name="submit" value="Tambah Pegawai" class="btn btn-primary float-right">
<a href="menu.php" class="btn btn-link float-right">Kembali</a>
</form>

  <br><br>
  <hr>
</div>

<?php include 'footer.php' ?>