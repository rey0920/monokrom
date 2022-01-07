<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $sql = mysqli_query($con, "SELECT password FROM admin where password='" . md5($_POST['password']) . "' && username='" . $_SESSION['alogin'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
        $qry = mysqli_query($con, "update admin set password='" . md5($_POST['newpassword']) . "'where username='" . $_SESSION['alogin'] . "'");
        $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
        $_SESSION['msg'] = "Old Password not match !!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin - Backyard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/css/custom-sidebar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<body>

    <?php include 'sidebar.php' ?>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-link">
                    <i class="navbar-toggler-icon"></i>
                </button>

                <h5>Ganti Password</h5>
            </div>
        </nav>

        <form method="POST">
            <?php if (isset($_POST['submit'])) { ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                </div>
            <?php } ?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Password Lama</label>
                <div class="col-sm-10">
                    <input type="password" placeholder="Masukan password lama anda" name="password" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                    <input type="password" placeholder="Masukan password lama baru" name="newpassword" class="form-control" required>
                </div>
            </div>
            <input type="submit" name="submit" value="Ganti Password" class="btn btn-primary float-right">
            <a href="menu.php" class="btn btn-link float-right">Kembali</a>
        </form>

    </div>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>