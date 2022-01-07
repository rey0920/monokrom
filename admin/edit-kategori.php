<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $id = intval($_GET['id']);
    $sql = mysqli_query($con, "update category set categoryName='$category',categoryDescription='$description' where id='$id'");
    $_SESSION['msg'] = "Ketegori berhasil diperbarui !!";
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

                <h5>Edit Kategori</h5>
            </div>
        </nav>

        <?php if (isset($_POST['submit'])) { ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
            </div>
        <?php } ?>


        <form method="POST">

            <?php
            $id = intval($_GET['id']);
            $query = mysqli_query($con, "select * from category where id='$id'");
            while ($row = mysqli_fetch_array($query)) { ?>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category" name="category" value="<?php echo  htmlentities($row['categoryName']); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi Kategori</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" rows="3" name="description" required><?php echo  htmlentities($row['categoryDescription']); ?></textarea>
                    </div>
                </div>

            <?php } ?>

            <input type="submit" name="submit" value="Edit Kategori" class="btn btn-primary float-right">
            <a href="kategori.php" class="btn btn-link float-right">Kembali</a>
        </form>

    </div>

    <?php include 'footer.php' ?>